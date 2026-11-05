<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StudentRegistrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('siswa');
            $table->string('nis', 20)->nullable()->unique();
            $table->string('kelas', 30)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function test_student_can_register_with_a_hashed_password_and_server_assigned_role(): void
    {
        $this->get(route('register.siswa'))
            ->assertOk()
            ->assertSee('Nama Lengkap')
            ->assertSee('NIS')
            ->assertSee('Tingkat Kelas')
            ->assertSee('Jurusan')
            ->assertSee('(DPIB) Desain Pemodelan dan Informasi Bangunan')
            ->assertSee('Email Sekolah')
            ->assertSee('Kata Sandi')
            ->assertSee('Konfirmasi Kata Sandi');

        $this->post(route('register.siswa.proses'), [
            'name' => 'Alya Putri',
            'nis' => '1234567890',
            'tingkat_kelas' => 'XI',
            'jurusan' => 'RPL',
            'email' => 'alya@smkn5surakarta.id',
            'password' => 'sandi6',
            'password_confirmation' => 'sandi6',
            'role' => 'petugas',
        ])->assertRedirect(route('login.siswa'))
            ->assertSessionHas('status');

        $this->get(route('login.siswa'))
            ->assertOk()
            ->assertSee('Pendaftaran berhasil. Silakan masuk dengan akun siswa Anda.')
            ->assertSee('Daftar sebagai siswa');

        $student = User::where('email', 'alya@smkn5surakarta.id')->firstOrFail();

        $this->assertSame('Alya Putri', $student->name);
        $this->assertSame('1234567890', $student->nis);
        $this->assertSame('XI RPL', $student->kelas);
        $this->assertSame('siswa', $student->role);
        $this->assertNotSame('sandi6', $student->password);
        $this->assertTrue(Hash::check('sandi6', $student->password));
    }

    public function test_registered_student_can_sign_in_with_their_nis(): void
    {
        $this->post(route('register.siswa.proses'), [
            'name' => 'Alya Putri',
            'nis' => '1234567890',
            'tingkat_kelas' => 'XI',
            'jurusan' => 'RPL',
            'email' => 'alya@smkn5surakarta.id',
            'password' => 'sandi6',
            'password_confirmation' => 'sandi6',
        ])->assertRedirect(route('login.siswa'));

        $this->post(route('login.siswa.proses'), [
            'login' => '1234567890',
            'password' => 'sandi6',
        ])->assertRedirect(route('siswa.beranda'));

        $this->assertAuthenticatedAs(User::where('nis', '1234567890')->firstOrFail());
    }

    public function test_registration_rejects_duplicate_values_and_invalid_or_overlong_fields(): void
    {
        User::create([
            'name' => 'Siswa Lama',
            'email' => 'lama@smkn5surakarta.id',
            'nis' => '111',
            'kelas' => 'X RPL 1',
            'password' => 'password123',
            'role' => 'siswa',
        ]);

        $this->from(route('register.siswa'))->post(route('register.siswa.proses'), [
            'name' => 'Siswa Baru',
            'nis' => '111',
            'tingkat_kelas' => 'XI',
            'jurusan' => 'RPL',
            'email' => 'lama@smkn5surakarta.id',
            'password' => 'sandi6',
            'password_confirmation' => 'does-not-match',
        ])->assertRedirect(route('register.siswa'))
            ->assertSessionHasErrors(['nis', 'email', 'password']);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_registration_rejects_invalid_email_and_values_over_schema_limits(): void
    {
        $this->from(route('register.siswa'))->post(route('register.siswa.proses'), [
            'name' => 'Siswa Baru',
            'nis' => str_repeat('2', 21),
            'tingkat_kelas' => 'XI',
            'jurusan' => 'RPL',
            'email' => 'bukan-email',
            'password' => 'sandi6',
            'password_confirmation' => 'sandi6',
        ])->assertRedirect(route('register.siswa'))
            ->assertSessionHasErrors(['nis', 'email']);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_registration_rejects_nis_under_five_digits_or_non_numeric_values(): void
    {
        foreach (['1234', '12A45'] as $nis) {
            $this->from(route('register.siswa'))->post(route('register.siswa.proses'), [
                'name' => 'Siswa Baru',
                'nis' => $nis,
                'tingkat_kelas' => 'XI',
                'jurusan' => 'RPL',
                'email' => 'siswa'.$nis.'@smkn5surakarta.id',
                'password' => 'sandi6',
                'password_confirmation' => 'sandi6',
            ])->assertRedirect(route('register.siswa'))
                ->assertSessionHasErrors('nis');
        }

        $this->assertDatabaseCount('users', 0);
    }

    public function test_registration_rejects_unsupported_grade_or_major_and_short_password(): void
    {
        $this->from(route('register.siswa'))->post(route('register.siswa.proses'), [
            'name' => 'Siswa Baru',
            'nis' => '12345',
            'tingkat_kelas' => 'XIII',
            'jurusan' => 'ABC',
            'email' => 'siswa@smkn5surakarta.id',
            'password' => '12345',
            'password_confirmation' => '12345',
        ])->assertRedirect(route('register.siswa'))
            ->assertSessionHasErrors(['tingkat_kelas', 'jurusan', 'password']);

        $this->assertDatabaseCount('users', 0);
    }
}
