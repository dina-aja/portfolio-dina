<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_publik_muat_dengan_semua_bagian(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Beranda');
        $response->assertSee('Keahlian');
        $response->assertSee('Proyek Saya');
        $response->assertSee('Sertifikat & Prestasi', false);
        $response->assertSee('Kesan & Pesan', false);
        $response->assertSee('Catatan Ngoding');
    }

    public function test_form_kesan_pesan_dapat_dikirim(): void
    {
        $this->post('/kontak/pesan', [
            'name' => 'Uji Coba',
            'email' => 'uji@example.com',
            'subject' => 'Halo',
            'message' => 'Pesan pengujian singkat.',
        ])->assertRedirect();

        $this->assertDatabaseHas('messages', ['email' => 'uji@example.com']);
    }

    public function test_admin_dapat_mengakses_semua_halaman_cms(): void
    {
        $user = User::factory()->create();

        foreach (['projects', 'certificates', 'experiences', 'skills', 'testimonials', 'blog-posts'] as $resource) {
            $this->actingAs($user)
                ->get('/admin/' . $resource)
                ->assertOk();
        }

        $this->actingAs($user)->get('/dashboard')->assertOk();
        $this->actingAs($user)->get('/admin/settings')->assertOk();
        $this->actingAs($user)->get('/admin/messages')->assertOk();
    }

    public function test_admin_dapat_menambah_proyek(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/admin/projects', [
            'title' => 'Proyek Uji Coba',
            'category' => 'Website',
            'description' => 'Deskripsi proyek uji coba yang cukup panjang.',
            'problem' => 'Masalah contoh',
            'goal' => 'Tujuan contoh',
            'technologies' => 'Laravel, Tailwind',
            'role' => 'Developer',
        ])->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', ['title' => 'Proyek Uji Coba']);
    }
}
