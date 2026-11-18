<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $definitions = config('portfolio.settings');
        $groups = collect($definitions)->groupBy('group')->all();
        $settings = Setting::values();

        return view('admin.settings', compact('groups', 'settings'));
    }

    public function update(Request $request)
    {
        $definitions = config('portfolio.settings');
        $rules = [];
        $attributes = [];

        foreach ($definitions as $key => $definition) {
            $type = $definition['type'] ?? 'text';
            $rules[$key] = ($type === 'textarea' ? 'nullable|string' : ($type === 'email' ? 'nullable|email' : ($type === 'url' ? 'nullable|url' : 'nullable|string')));
            $attributes[$key] = $definition['label'] ?? $key;
        }

        $validated = $request->validate($rules, [], $attributes);

        foreach ($validated as $key => $value) {
            $validated[$key] = $value ?? '';
        }

        Setting::saveValues($validated);

        return redirect()
            ->route('settings.edit')
            ->with('success', 'Profil & konten berhasil disimpan. Perubahan langsung tampil di website.');
    }
}
