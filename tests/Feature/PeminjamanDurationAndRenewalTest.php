<?php

namespace Tests\Feature;

use App\Models\Alat;
use App\Models\LaporanKondisiAlat;
use App\Models\Peminjaman;
use App\Models\PeminjamanPerpanjangan;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PeminjamanDurationAndRenewalTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('laporan_kondisi_alats');
        Schema::dropIfExists('peminjaman_perpanjangans');
        Schema::dropIfExists('peminjamans');
        Schema::dropIfExists('alats');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('siswa');
            $table->string('nis')->nullable();
            $table->string('kelas')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->unique();
            $table->string('nama_alat');
            $table->string('kategori');
            $table->integer('stok')->default(0);
            $table->timestamps();
        });

        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('alat_id');
            $table->string('kategori');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('keperluan');
            $table->string('lokasi_penggunaan');
            $table->text('keterangan')->nullable();
            $table->string('status')->default('menunggu');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('kondisi_kembali')->nullable();
            $table->text('catatan_kondisi')->nullable();
            $table->timestamps();
        });

        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('peminjaman_id')->nullable();
            $table->string('jenis');
            $table->string('judul');
            $table->text('pesan');
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
        });

        Schema::create('peminjaman_perpanjangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id');
            $table->date('tanggal_kembali_lama');
            $table->date('tanggal_kembali_baru');
            $table->string('status')->default('menunggu');
            $table->foreignId('disetujui_oleh')->nullable();
            $table->timestamps();
        });

        Schema::create('laporan_kondisi_alats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->unique();
            $table->string('nama_peminjam');
            $table->string('kode_inventaris');
            $table->string('kategori');
            $table->string('lokasi_kegiatan');
            $table->string('tanggal_pengembalian')->nullable();
            $table->string('kondisi_terima');
            $table->text('deskripsi_kerusakan')->nullable();
            $table->boolean('kirim_dengan_foto')->default(false);
            $table->timestamps();
        });
    }

    public function test_new_borrowing_is_limited_to_seven_days(): void
    {
        $siswa = $this->createUser('siswa');
        $alat = $this->createAlat();
        $this->actingAs($siswa);
        $this->get(route('siswa.peminjaman.create'))
            ->assertOk()
            ->assertSee('Lama peminjaman maksimal 7 hari');

        $this->post(route('siswa.peminjaman.store'), [
            'alat_id' => $alat->id,
            'kategori' => 'multimedia',
            'tanggal_pinjam' => today()->toDateString(),
            'tanggal_kembali' => today()->addDays(8)->toDateString(),
            'keperluan' => 'Dokumentasi kegiatan sekolah',
            'lokasi_penggunaan' => 'Aula sekolah',
        ])->assertSessionHasErrors('tanggal_kembali');

        $this->assertDatabaseCount('peminjamans', 0);

        $this->post(route('siswa.peminjaman.store'), [
            'alat_id' => $alat->id,
            'kategori' => 'multimedia',
            'tanggal_pinjam' => today()->toDateString(),
            'tanggal_kembali' => today()->addDays(7)->toDateString(),
            'keperluan' => 'Dokumentasi kegiatan sekolah',
            'lokasi_penggunaan' => 'Aula sekolah',
        ])->assertRedirect(route('siswa.peminjaman.index'));

        $this->assertDatabaseCount('peminjamans', 1);
    }

    public function test_student_home_displays_the_name_of_the_account_that_logged_in(): void
    {
        app(\Database\Seeders\DatabaseSeeder::class)->run();

        $this->assertDatabaseHas('users', [
            'name' => 'Muhammad Ridwan Arrosyid',
            'email' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'role' => 'siswa',
            'nis' => '2232001',
        ]);

        $this->post(route('login.siswa.proses'), [
            'login' => 'muhammad.ridwan.arrosyid@smkn5surakarta.id',
            'password' => 'password123',
        ])->assertRedirect(route('siswa.beranda'));

        $this->get(route('siswa.beranda'))
            ->assertOk()
            ->assertSee('Muhammad Ridwan Arrosyid')
            ->assertSee('Selamat siang, Muhammad!');
    }

    public function test_student_can_log_out_from_the_home_page(): void
    {
        $siswa = $this->createUser('siswa');

        $this->actingAs($siswa)
            ->get(route('siswa.beranda'))
            ->assertOk()
            ->assertSee('Keluar');

        $this->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->get(route('siswa.beranda'))
            ->assertRedirect(route('login'));
    }

    public function test_student_can_create_and_edit_condition_report_for_their_borrowing(): void
    {
        $siswa = $this->createUser('siswa');
        $peminjaman = $this->createActivePeminjaman($siswa);

        $this->actingAs($siswa)
            ->post(route('siswa.laporan-kondisi.store'), [
                'peminjaman_id' => $peminjaman->id,
                'lokasi_kegiatan' => 'Aula sekolah',
                'tanggal_pengembalian' => today()->toDateString(),
                'kondisi_terima' => 'rusak_ringan',
                'deskripsi_kerusakan' => 'Kabel sedikit terkelupas',
                'kirim_dengan_foto' => 1,
            ])
            ->assertRedirect(route('siswa.laporan-kondisi', ['peminjaman_id' => $peminjaman->id]));

        $laporan = LaporanKondisiAlat::firstOrFail();
        $this->assertSame($siswa->name, $laporan->nama_peminjam);
        $this->assertSame($peminjaman->alat->kode_alat, $laporan->kode_inventaris);

        $this->post(route('siswa.laporan-kondisi.store'), [
            'peminjaman_id' => $peminjaman->id,
            'lokasi_kegiatan' => 'Laboratorium',
            'tanggal_pengembalian' => today()->toDateString(),
            'kondisi_terima' => 'baik',
            'deskripsi_kerusakan' => 'Kondisi alat baik.',
        ])->assertRedirect(route('siswa.laporan-kondisi', ['peminjaman_id' => $peminjaman->id]));

        $this->assertDatabaseCount('laporan_kondisi_alats', 1);
        $this->assertDatabaseHas('laporan_kondisi_alats', [
            'id' => $laporan->id,
            'lokasi_kegiatan' => 'Laboratorium',
            'kondisi_terima' => 'baik',
            'deskripsi_kerusakan' => 'Kondisi alat baik.',
            'kirim_dengan_foto' => false,
        ]);

        $this->get(route('siswa.laporan-kondisi', ['peminjaman_id' => $peminjaman->id]))
            ->assertOk()
            ->assertSee('Edit laporan kondisi alat')
            ->assertSee('Kondisi alat baik.');
    }

    public function test_student_cannot_create_a_condition_report_for_another_students_borrowing(): void
    {
        $pemilik = $this->createUser('siswa');
        $siswaLain = $this->createUser('siswa');
        $peminjaman = $this->createActivePeminjaman($pemilik);

        $this->actingAs($siswaLain)
            ->post(route('siswa.laporan-kondisi.store'), [
                'peminjaman_id' => $peminjaman->id,
                'lokasi_kegiatan' => 'Aula sekolah',
                'tanggal_pengembalian' => today()->toDateString(),
                'kondisi_terima' => 'baik',
                'deskripsi_kerusakan' => 'Kondisi baik.',
            ])
            ->assertNotFound();

        $this->assertDatabaseCount('laporan_kondisi_alats', 0);
    }

    public function test_petugas_can_view_and_export_student_condition_reports(): void
    {
        $siswa = $this->createUser('siswa');
        $petugas = $this->createUser('petugas');
        $peminjaman = $this->createActivePeminjaman($siswa);
        LaporanKondisiAlat::create([
            'peminjaman_id' => $peminjaman->id,
            'nama_peminjam' => $siswa->name,
            'kode_inventaris' => $peminjaman->alat->kode_alat,
            'kategori' => $peminjaman->kategori,
            'lokasi_kegiatan' => 'Aula sekolah',
            'tanggal_pengembalian' => today()->toDateString(),
            'kondisi_terima' => 'rusak_ringan',
            'deskripsi_kerusakan' => 'Kabel sedikit terkelupas',
            'kirim_dengan_foto' => true,
        ]);

        $this->actingAs($petugas)
            ->get(route('petugas.laporan'))
            ->assertOk()
            ->assertSee('Laporan kondisi alat dari siswa')
            ->assertSee($siswa->name)
            ->assertSee('Kabel sedikit terkelupas')
            ->assertSee('Rusak ringan');

        $export = $this->actingAs($petugas)
            ->get(route('petugas.laporan.kondisi.export'))
            ->assertDownload('laporan-kondisi-alat.csv');

        $csv = $export->streamedContent();
        $this->assertStringContainsString('Kabel sedikit terkelupas', $csv);
        $this->assertStringContainsString($siswa->email, $csv);
    }

    public function test_return_confirmation_is_saved_and_shown_in_returned_history(): void
    {
        $siswa = $this->createUser('siswa');
        $petugas = $this->createUser('petugas');
        $peminjaman = $this->createActivePeminjaman($siswa);

        $this->actingAs($petugas)
            ->get(route('petugas.pengembalian'))
            ->assertOk()
            ->assertSee($siswa->name);

        $this->actingAs($petugas)
            ->post(route('petugas.pengembalian.konfirmasi', $peminjaman->id), [
                'kondisi_kembali' => 'baik',
                'catatan_kondisi' => '',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('peminjamans', [
            'id' => $peminjaman->id,
            'status' => 'dikembalikan',
            'tanggal_pengembalian' => today()->startOfDay()->toDateTimeString(),
            'kondisi_kembali' => 'baik',
        ]);
        $this->assertSame(2, $peminjaman->alat->refresh()->stok);

        $this->get(route('petugas.pengembalian'))
            ->assertOk()
            ->assertSee($siswa->name)
            ->assertSee('Data tersimpan');
    }

    public function test_marking_borrowing_returned_from_approval_shows_name_in_return_history(): void
    {
        $siswa = $this->createUser('siswa');
        $petugas = $this->createUser('petugas');
        $peminjaman = $this->createActivePeminjaman($siswa);

        $this->actingAs($petugas)
            ->put(route('petugas.persetujuan.update', $peminjaman->id), [
                'status' => 'dikembalikan',
            ])
            ->assertRedirect(route('petugas.persetujuan'));

        $this->assertDatabaseHas('peminjamans', [
            'id' => $peminjaman->id,
            'status' => 'dikembalikan',
            'tanggal_pengembalian' => today()->startOfDay()->toDateTimeString(),
        ]);

        $this->get(route('petugas.pengembalian'))
            ->assertOk()
            ->assertSee($siswa->name)
            ->assertSee('id="view-sudah" class="tab-view active-view"', false);
    }

    public function test_return_details_migration_adds_columns_to_peminjamans(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_pengembalian', 'kondisi_kembali', 'catatan_kondisi']);
        });

        $migration = require database_path('migrations/2026_10_21_000000_add_return_details_to_peminjamans_table.php');
        $migration->up();

        $this->assertTrue(Schema::hasColumns('peminjamans', [
            'tanggal_pengembalian',
            'kondisi_kembali',
            'catatan_kondisi',
        ]));
    }

    public function test_student_can_request_repeated_seven_day_extensions_after_approval(): void
    {
        $siswa = $this->createUser('siswa');
        $petugas = $this->createUser('petugas');
        $peminjaman = $this->createActivePeminjaman($siswa);

        $this->actingAs($siswa)
            ->post(route('siswa.peminjaman.perpanjangan', $peminjaman->id))
            ->assertRedirect(route('siswa.peminjaman.index'));

        $this->assertDatabaseHas('peminjaman_perpanjangans', [
            'peminjaman_id' => $peminjaman->id,
            'status' => 'menunggu',
        ]);
        $perpanjangan = PeminjamanPerpanjangan::firstOrFail();
        $this->assertSame(today()->addDays(7)->toDateString(), $perpanjangan->tanggal_kembali_lama->toDateString());
        $this->assertSame(today()->addDays(14)->toDateString(), $perpanjangan->tanggal_kembali_baru->toDateString());

        $this->actingAs($siswa)
            ->post(route('siswa.peminjaman.perpanjangan', $peminjaman->id))
            ->assertSessionHasErrors('perpanjangan');
        $this->assertDatabaseCount('peminjaman_perpanjangans', 1);

        $this->assertSame(
            today()->addDays(7)->toDateString(),
            $peminjaman->refresh()->tanggal_kembali->toDateString()
        );
        $this->get(route('siswa.peminjaman.index'))
            ->assertOk()
            ->assertSee('Permintaan perpanjangan sedang menunggu');

        $this->actingAs($petugas)
            ->get(route('petugas.persetujuan'))
            ->assertOk()
            ->assertSee('Permintaan perpanjangan')
            ->assertSee('Kamera');

        $this->actingAs($petugas)
            ->put(route('petugas.perpanjangan.update', $perpanjangan->id), [
                'status' => 'disetujui',
            ])
            ->assertRedirect(route('petugas.persetujuan'));

        $this->assertDatabaseHas('peminjaman_perpanjangans', [
            'id' => $perpanjangan->id,
            'status' => 'disetujui',
            'disetujui_oleh' => $petugas->id,
        ]);
        $this->assertSame(
            today()->addDays(14)->toDateString(),
            $peminjaman->refresh()->tanggal_kembali->toDateString()
        );

        $this->actingAs($siswa)
            ->post(route('siswa.peminjaman.perpanjangan', $peminjaman->id))
            ->assertRedirect(route('siswa.peminjaman.index'));

        $perpanjanganBerikutnya = PeminjamanPerpanjangan::latest('id')->firstOrFail();
        $this->assertDatabaseHas('peminjaman_perpanjangans', [
            'id' => $perpanjanganBerikutnya->id,
            'peminjaman_id' => $peminjaman->id,
            'status' => 'menunggu',
        ]);
        $this->assertSame(today()->addDays(14)->toDateString(), $perpanjanganBerikutnya->tanggal_kembali_lama->toDateString());
        $this->assertSame(today()->addDays(21)->toDateString(), $perpanjanganBerikutnya->tanggal_kembali_baru->toDateString());
    }

    public function test_student_cannot_request_another_students_extension(): void
    {
        $owner = $this->createUser('siswa');
        $otherSiswa = $this->createUser('siswa');
        $peminjaman = $this->createActivePeminjaman($owner);

        $this->actingAs($otherSiswa)
            ->post(route('siswa.peminjaman.perpanjangan', $peminjaman->id))
            ->assertNotFound();
    }

    private function createAlat(): Alat
    {
        return Alat::create([
            'kode_alat' => 'CAM-001',
            'nama_alat' => 'Kamera',
            'kategori' => 'multimedia',
            'stok' => 1,
        ]);
    }

    private function createUser(string $role): User
    {
        $user = User::factory()->create();
        $user->role = $role;
        $user->save();

        return $user;
    }

    private function createActivePeminjaman(User $siswa): Peminjaman
    {
        $alat = $this->createAlat();

        return Peminjaman::create([
            'user_id' => $siswa->id,
            'alat_id' => $alat->id,
            'kategori' => 'multimedia',
            'tanggal_pinjam' => today()->toDateString(),
            'tanggal_kembali' => today()->addDays(7)->toDateString(),
            'keperluan' => 'Dokumentasi kegiatan sekolah',
            'lokasi_penggunaan' => 'Aula sekolah',
            'status' => 'dipinjam',
        ]);
    }
}
