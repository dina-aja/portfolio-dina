<?php

namespace Tests\Feature;

use App\Models\Testimonial;
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

    public function test_section_testimoni_menjadi_bagian_terakhir(): void
    {
        $html = $this->get('/')->getContent();

        $kontak = strpos($html, 'id="contact"');
        $testimoni = strpos($html, 'id="testimonials"');
        $footer = strpos($html, '<footer');

        $this->assertNotFalse($kontak);
        $this->assertNotFalse($testimoni);
        $this->assertLessThan($testimoni, $kontak);
        $this->assertLessThan($footer, $testimoni);
    }

    public function test_pengunjung_dapat_mengirim_testimoni_yang_menunggu_persetujuan(): void
    {
        $this->post('/testimoni', [
            'testimonial_name' => 'Uji Testimoni',
            'testimonial_role' => 'Siswa',
            'testimonial_category' => 'Teman',
            'testimonial_message' => 'Portfolio ini sangat rapi dan mudah dipahami.',
        ])->assertRedirect();

        $this->assertDatabaseHas('testimonials', [
            'name' => 'Uji Testimoni',
            'is_approved' => false,
        ]);

        $this->get('/')->assertDontSee('Uji Testimoni');
    }

    public function test_validasi_form_testimoni_menggunakan_error_bag_tersendiri(): void
    {
        $response = $this->from('/')->post('/testimoni', [
            'testimonial_name' => '',
            'testimonial_category' => '',
            'testimonial_message' => 'pendek',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['testimonial_name', 'testimonial_category', 'testimonial_message'], null, 'testimonial');
        $this->assertDatabaseCount('testimonials', 0);
    }

    public function test_admin_dapat_menyetujui_dan_menyembunyikan_testimoni(): void
    {
        $testimonial = Testimonial::create([
            'name' => 'Testimoni Menunggu',
            'category' => 'Teman',
            'message' => 'Testimoni yang menunggu persetujuan admin.',
            'is_approved' => false,
        ]);

        $this->get('/')->assertDontSee('Testimoni Menunggu');

        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch('/admin/testimonials/' . $testimonial->id . '/approval')
            ->assertRedirect();

        $this->assertTrue($testimonial->fresh()->is_approved);
        $this->get('/')->assertSee('Testimoni Menunggu');

        $this->actingAs($user)
            ->patch('/admin/testimonials/' . $testimonial->id . '/approval')
            ->assertRedirect();

        $this->assertFalse($testimonial->fresh()->is_approved);
        $this->get('/')->assertDontSee('Testimoni Menunggu');
    }
}
