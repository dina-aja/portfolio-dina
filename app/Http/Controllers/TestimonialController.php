<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Form testimoni dari pengunjung.
     *
     * Testimoni yang masuk belum langsung tampil di beranda — admin harus
     * menyetujuinya lewat dashboard terlebih dahulu. Error memakai error bag
     * tersendiri agar tidak bentrok dengan form Kesan & Pesan di halaman sama.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'testimonial_name' => 'required|max:100',
            'testimonial_role' => 'nullable|max:150',
            'testimonial_category' => 'required|in:Guru Pembimbing,Teman,Pengguna,Tempat PLK,Lainnya',
            'testimonial_rating' => 'required|integer|min:1|max:5',
            // Isi testimoni bebas panjangnya: tidak ada batas minimal maupun maksimal.
            'testimonial_message' => 'required',
        ], [
            'testimonial_name.required' => 'Nama wajib diisi.',
            'testimonial_category.required' => 'Kategori wajib dipilih.',
            'testimonial_rating.required' => 'Penilaian bintang wajib dipilih.',
            'testimonial_rating.min' => 'Penilaian minimal 1 bintang.',
            'testimonial_rating.max' => 'Penilaian maksimal 5 bintang.',
            'testimonial_message.required' => 'Isi testimoni wajib ditulis.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'testimonial')->withInput();
        }

        $data = $validator->validated();

        Testimonial::create([
            'name' => $data['testimonial_name'],
            'role' => $data['testimonial_role'] ?? null,
            'category' => $data['testimonial_category'],
            'rating' => $data['testimonial_rating'],
            'message' => $data['testimonial_message'],
            'is_approved' => false,
        ]);

        return back()->with(
            'testimonial_success',
            'Terima kasih! Testimoni kamu sudah terkirim dan akan tampil setelah disetujui admin.'
        );
    }

    /**
     * Setujui / sembunyikan testimoni dari dashboard admin.
     */
    public function toggleApproval(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => ! $testimonial->is_approved]);

        return back()->with(
            'success',
            $testimonial->is_approved
                ? 'Testimoni disetujui dan sekarang tampil di beranda.'
                : 'Testimoni disembunyikan dari beranda.'
        );
    }
}
