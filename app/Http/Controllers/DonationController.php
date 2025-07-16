<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('donaturs')->latest()->get();
        return view('admin.donations.index', compact('donations'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'message' => 'nullable|string',
        'target' => 'required|integer|min:1',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $gambarName = null;
if ($request->hasFile('gambar')) {
    $gambarName = time().'_'.$request->file('gambar')->getClientOriginalName();
    $request->file('gambar')->move(public_path('uploads'), $gambarName);
}


    Donation::create([
    'name' => $request->name,
    'message' => $request->message,
    'target' => $request->target,
    'gambar' => $gambarName,
]);


    return redirect()->route('donations.index')->with('success', 'Donasi berhasil ditambahkan!');
}

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        return view('admin.donations.edit', compact('donation'));
    }

  public function update(Request $request, Donation $donation)
{
    $request->validate([
        'name' => 'required|string',
        'message' => 'nullable|string',
        'target' => 'required|integer|min:1',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $gambarName = $donation->gambar;
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama kalau ada
        if ($gambarName && file_exists(public_path('uploads/' . $gambarName))) {
            unlink(public_path('uploads/' . $gambarName));
        }

        $gambarName = time().'_'.$request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move(public_path('uploads'), $gambarName);
    }

    $donation->update([
        'name' => $request->name,
        'message' => $request->message,
        'target' => $request->target,
        'gambar' => $gambarName
    ]);

    return redirect()->route('donations.index')->with('success', 'Donasi berhasil diupdate!');
}


public function destroy(Donation $donation)
{
    if ($donation->gambar && file_exists(public_path('uploads/' . $donation->gambar))) {
        unlink(public_path('uploads/' . $donation->gambar));
    }

    $donation->delete();
    return redirect()->route('donations.index')->with('success', 'Donasi berhasil dihapus!');
}

}

