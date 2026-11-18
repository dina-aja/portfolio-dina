<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    /**
     * Ambil konfigurasi resource yang sedang dibuka.
     */
    protected function config(string $resource): array
    {
        $config = config('portfolio.crud.' . $resource);

        abort_unless(is_array($config), 404, 'Resource tidak ditemukan.');

        return $config;
    }

    public function index(string $resource)
    {
        $config = $this->config($resource);
        $model = $config['model'];
        $items = $model::latest()->get();

        return view('admin.index', compact('config', 'items', 'resource'));
    }

    public function create(string $resource)
    {
        $config = $this->config($resource);

        return view('admin.form', [
            'config' => $config,
            'resource' => $resource,
            'item' => null,
        ]);
    }

    public function store(Request $request, string $resource)
    {
        $config = $this->config($resource);
        $data = $this->validateAndCollect($request, $config);

        $config['model']::create($data);

        return redirect()
            ->route('admin.index', ['resource' => $resource])
            ->with('success', $config['singular'] . ' berhasil ditambahkan.');
    }

    public function edit(string $resource, int $item)
    {
        $config = $this->config($resource);
        $model = $config['model'];
        $item = $model::findOrFail($item);

        return view('admin.form', compact('config', 'resource', 'item'));
    }

    public function update(Request $request, string $resource, int $item)
    {
        $config = $this->config($resource);
        $model = $config['model'];
        $item = $model::findOrFail($item);
        $data = $this->validateAndCollect($request, $config, $item);

        $item->update($data);

        return redirect()
            ->route('admin.index', ['resource' => $resource])
            ->with('success', $config['singular'] . ' berhasil diperbarui.');
    }

    public function destroy(string $resource, int $item)
    {
        $config = $this->config($resource);
        $model = $config['model'];
        $item = $model::findOrFail($item);

        foreach ($config['fields'] as $name => $field) {
            if (($field['type'] ?? '') === 'image' && $item->{$name}) {
                Storage::disk('public')->delete($item->{$name});
            }
        }

        $item->delete();

        return redirect()
            ->route('admin.index', ['resource' => $resource])
            ->with('success', $config['singular'] . ' berhasil dihapus.');
    }

    /**
     * Validasi input dan kumpulkan data yang akan disimpan.
     */
    protected function validateAndCollect(Request $request, array $config, ?object $item = null): array
    {
        $rules = [];
        $attributes = [];

        foreach ($config['fields'] as $name => $field) {
            $type = $field['type'] ?? 'text';

            $rules[$name] = $field['rules'] ?? 'nullable';
            $attributes[$name] = $field['label'] ?? $name;
        }

        $validated = $request->validate($rules, [], $attributes);
        $data = [];

        foreach ($config['fields'] as $name => $field) {
            $type = $field['type'] ?? 'text';

            if ($type === 'checkbox') {
                $data[$name] = $request->has($name);
                continue;
            }

            if ($type === 'image') {
                if ($request->hasFile($name)) {
                    $data[$name] = $request->file($name)->store('uploads/' . $config['route'], 'public');
                }
                continue;
            }

            if ($type === 'datetime-local' && ! empty($validated[$name])) {
                $data[$name] = str_replace('T', ' ', $validated[$name]) . ':00';
                continue;
            }

            if (array_key_exists($name, $validated)) {
                $data[$name] = $validated[$name] ?: null;
            }
        }

        return $data;
    }
}
