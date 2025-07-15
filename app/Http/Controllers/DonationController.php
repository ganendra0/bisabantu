<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->get();
        return view('donation.index', compact('donations'));
    }

    public function create()
    {
        return view('donation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'message' => 'nullable|string',
            'target' => 'required|integer|min:1',
        ]);

        Donation::create([
            'name' => $request->name,
            'message' => $request->message,
            'target' => $request->target,
        ]);

        return redirect()->route('donations.index')->with('success', 'Donasi berhasil ditambahkan!');
    }

    public function show(Donation $donation)
    {
        return view('donation.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        return view('donation.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'name' => 'required|string',
            'message' => 'nullable|string',
            'target' => 'required|integer|min:1',
        ]);

        $donation->update([
            'name' => $request->name,
            'message' => $request->message,
            'target' => $request->target,
        ]);

        return redirect()->route('donations.index')->with('success', 'Donasi berhasil diupdate!');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donasi berhasil dihapus!');
    }
}

