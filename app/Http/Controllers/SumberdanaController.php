<?php

namespace App\Http\Controllers;

use App\Models\Sumberdana;
use Illuminate\Http\Request;

class SumberdanaController extends Controller
{
    public function index()
    {
        $sumberdana = Sumberdana::latest()->paginate(10);
        return view('sumberdana.index', compact('sumberdana'));
    }

    public function create()
    {
        return view('sumberdana.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no' => 'nullable|string|max:255',
            'kd_skpd' => 'nullable|string|max:50',
            'nm_skpd' => 'nullable|string|max:255',
            'kd_subunit' => 'nullable|string|max:50',
            'nm_subunit' => 'nullable|string|max:255',
            'kd_kegiatan' => 'nullable|string|max:50',
            'nm_kegiatan' => 'nullable|string|max:255',
            'kd_subkegiatan' => 'nullable|string|max:50',
            'nm_subkegiatan' => 'nullable|string|max:255',
            'kd_rek' => 'nullable|string|max:100',
            'nm_rek' => 'nullable|string|max:255',
            'pagu' => 'nullable|numeric|min:0',
            'sumberdana' => 'nullable|string|max:255',
        ]);

        Sumberdana::create($validated);

        return redirect()->route('sumberdana.index')
            ->with('success', 'Data Sumberdana created successfully.');
    }

    public function edit(Sumberdana $sumberdana)
    {
        return view('sumberdana.edit', compact('sumberdana'));
    }

    public function update(Request $request, Sumberdana $sumberdana)
    {
        $validated = $request->validate([
            'no' => 'nullable|string|max:255',
            'kd_skpd' => 'nullable|string|max:50',
            'nm_skpd' => 'nullable|string|max:255',
            'kd_subunit' => 'nullable|string|max:50',
            'nm_subunit' => 'nullable|string|max:255',
            'kd_kegiatan' => 'nullable|string|max:50',
            'nm_kegiatan' => 'nullable|string|max:255',
            'kd_subkegiatan' => 'nullable|string|max:50',
            'nm_subkegiatan' => 'nullable|string|max:255',
            'kd_rek' => 'nullable|string|max:100',
            'nm_rek' => 'nullable|string|max:255',
            'pagu' => 'nullable|numeric|min:0',
            'sumberdana' => 'nullable|string|max:255',
        ]);

        $sumberdana->update($validated);

        return redirect()->route('sumberdana.index')
            ->with('success', 'Data Sumberdana updated successfully.');
    }

    public function destroy(Sumberdana $sumberdana)
    {
        $sumberdana->delete();

        return redirect()->route('sumberdana.index')
            ->with('success', 'Data Sumberdana deleted successfully.');
    }
}
