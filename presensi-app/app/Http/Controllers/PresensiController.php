<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $presensis = Presensi::with('user')->latest()->paginate(10);
        } else {
            $presensis = Presensi::where('user_id', $user->id)->latest()->paginate(10);
        }
        
        return view('presensi.index', compact('presensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presensi.create');
    }

    /**
     * Store a newly created resource in storage.
     */    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Presensi::create($data);

        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        return view('presensi.show', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        return view('presensi.edit', compact('presensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i'
        ]);

        $presensi->update($request->all());

        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        $presensi->delete();
        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil dihapus!');
    }
}
