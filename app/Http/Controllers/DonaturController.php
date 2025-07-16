<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DonaturController extends Controller
{
    public function index(): View
    {
        $donaturs = Donatur::latest()->get();
        return view('donaturs.index', compact('donaturs'));
    }

    public function tampilDonatur(Request $request): View
{
    $donationId = $request->query('donation_id');

    $query = Donatur::latest();

    if ($donationId) {
        $query->where('donation_id', $donationId);
        $donationSelected = \App\Models\Donation::find($donationId); // Tambahkan ini
    } else {
        $donationSelected = null;
    }

    $donaturs = $query->get();
    $donations = \App\Models\Donation::all();

    $leaderboard = DB::table('donaturs')
        ->select('nama', DB::raw('SUM(total_donasi) as total_donasi'))
        ->groupBy('nama')
        ->orderByDesc('total_donasi')
        ->limit(5)
        ->get();

    return view('donaturs.donaturPublic', compact(
        'donaturs',
        'donations',
        'donationId',
        'donationSelected',
        'leaderboard'
    ));
}

    public function create(): View
    {
        $donationId = request('donation_id');
        $donation = null;

        if ($donationId) {
            $donation = \App\Models\Donation::find($donationId);
        }

        return view('donaturs.create', compact('donation'));
    }

    public function donasi(): View
    {
        $donations = \App\Models\Donation::with('donaturs')->latest()->get();
        return view('donasi', compact('donations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'         => 'required|string|min:1',
            'pesan'        => 'required|string|min:1',
            'total_donasi' => 'required|string|min:1',
            'tipe_bayar'   => 'required|string|min:1',
        ]);

        $total_donasi = str_replace(['Rp. ', '.', ','], '', $request->total_donasi);

        if (!is_numeric($total_donasi) || $total_donasi < 1) {
            return redirect()->back()->withErrors(['total_donasi' => 'Total donasi harus berupa angka dan minimal 1'])->withInput();
        }

        Donatur::create([
            'nama'         => $request->nama,
            'pesan'        => $request->pesan,
            'total_donasi' => $total_donasi,
            'tipe_bayar'   => $request->tipe_bayar,
            'donation_id'  => $request->donation_id
        ]);

        return redirect('/donatur')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $donatur = Donatur::findOrFail($id);
        return view('donaturs.edit', compact('donatur'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama'         => 'required|string|min:1',
            'pesan'        => 'required|string|min:1',
            'total_donasi' => 'required|string|min:1',
            'tipe_bayar'   => 'required|string|min:1',
        ]);

        $total_donasi = str_replace(['Rp. ', '.', ','], '', $request->total_donasi);

        if (!is_numeric($total_donasi) || $total_donasi < 1) {
            return redirect()->back()->withErrors(['total_donasi' => 'Total donasi harus berupa angka dan minimal 1'])->withInput();
        }

        $donatur = Donatur::findOrFail($id);

        $donatur->update([
            'nama'         => $request->nama,
            'pesan'        => $request->pesan,
            'total_donasi' => $total_donasi,
            'tipe_bayar'   => $request->tipe_bayar,
        ]);

        return redirect()->route('donaturs.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->delete();

        return redirect()->route('donaturs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
