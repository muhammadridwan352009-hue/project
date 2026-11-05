<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StudentLoginProfileTest extends TestCase
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
            $table->string('nis')->nullable()->unique();
            $table->string('kelas')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function test_student_login_data_matches_the_profile(): void
    {
        User::create([
            'name' => 'Muhammad Ridwan Arrosyid',
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'kelas' => 'XII RPL A',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        $this->post(route('login.siswa.proses'), [
            'login' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'password' => 'password123',
        ])->assertRedirect(route('siswa.beranda'));

        $this->get(route('siswa.profil'))
            ->assertOk()
            ->assertSee('2232001')
            ->assertSee('XII RPL A')
            ->assertSee('muhammad.ridwan.arrosyid@smkn5surakarta.id');
    }

    public function test_student_login_form_offers_grade_and_major_selectors(): void
    {
        $this->get(route('login.siswa'))
            ->assertOk()
            ->assertSee('name="tingkat_kelas"', false)
            ->assertSee('name="jurusan"', false)
            ->assertSee('(TKRO) Teknik Kendaraan Ringan Otomotif');
    }

    public function test_failed_student_login_preserves_form_data_except_password(): void
    {
        $this->from(route('login.siswa'))->post(route('login.siswa.proses'), [
            'login' => 'siswa@smkn5surakarta.id',
            'nis' => '12345',
            'tingkat_kelas' => 'XI',
            'jurusan' => 'RPL',
            'password' => 'wrong-password',
        ])->assertRedirect(route('login.siswa'))
            ->assertSessionHasErrors('login')
            ->assertSessionHas('_old_input.login', 'siswa@smkn5surakarta.id')
            ->assertSessionHas('_old_input.nis', '12345')
            ->assertSessionHas('_old_input.tingkat_kelas', 'XI')
            ->assertSessionHas('_old_input.jurusan', 'RPL')
            ->assertSessionMissing('_old_input.password');
    }

    public function test_student_login_updates_nis_and_class_in_the_profile(): void
    {
        User::create([
            'name' => 'Muhammad Ridwan Arrosyid',
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'kelas' => 'XII RPL A',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        $this->from(route('login.siswa'))->post(route('login.siswa.proses'), [
            'login' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '53428',
            'tingkat_kelas' => 'XII',
            'jurusan' => 'TKRO',
            'password' => 'password123',
        ])->assertRedirect(route('siswa.beranda'));

        $this->get(route('siswa.profil'))
            ->assertOk()
            ->assertSee('53428')
            ->assertSee('XII TKRO');

        $this->assertDatabaseHas('users', [
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '53428',
            'kelas' => 'XII TKRO',
        ]);
    }

    public function test_student_login_rejects_a_nis_used_by_another_student(): void
    {
        User::create([
            'name' => 'Muhammad Ridwan Arrosyid',
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'kelas' => 'XII RPL A',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);
        User::create([
            'name' => 'Siswa Lain',
            'email' => 'siswa.lain@smkn5surakarta.id',
            'nis' => '53428',
            'kelas' => 'XII TKR A',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        $this->from(route('login.siswa'))->post(route('login.siswa.proses'), [
            'login' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '53428',
            'tingkat_kelas' => 'XII',
            'jurusan' => 'TKRO',
            'password' => 'password123',
        ])->assertRedirect(route('login.siswa'))
            ->assertSessionHasErrors('nis');

        $this->assertGuest();
        $this->assertDatabaseHas('users', [
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'kelas' => 'XII RPL A',
        ]);
    }

    public function test_student_login_rejects_unsupported_or_incomplete_class_selections(): void
    {
        User::create([
            'name' => 'Muhammad Ridwan Arrosyid',
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'kelas' => 'XII RPL A',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        $invalidSelections = [
            [['tingkat_kelas' => 'XIII', 'jurusan' => 'RPL'], ['tingkat_kelas']],
            [['tingkat_kelas' => 'XI', 'jurusan' => 'ABC'], ['jurusan']],
            [['tingkat_kelas' => 'XI'], ['jurusan']],
            [['jurusan' => 'RPL'], ['tingkat_kelas']],
        ];

        foreach ($invalidSelections as [$selection, $errors]) {
            $this->from(route('login.siswa'))->post(route('login.siswa.proses'), array_merge([
                'login' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
                'password' => 'password123',
            ], $selection))->assertRedirect(route('login.siswa'))
                ->assertSessionHasErrors($errors);

            $this->assertGuest();
            $this->assertDatabaseHas('users', [
                'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
                'kelas' => 'XII RPL A',
            ]);
        }
    }

    public function test_student_can_log_out_from_the_profile_page(): void
    {
        $student = User::create([
            'name' => 'Muhammad Ridwan Arrosyid',
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'nis' => '2232001',
            'kelas' => 'XII RPL A',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        $this->actingAs($student)
            ->get(route('siswa.profil'))
            ->assertOk()
            ->assertSee('Keluar');

        $this->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
