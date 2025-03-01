<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use App\Http\Requests\WargaRequest;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $warga = Warga::when($search, function ($query, $search) {
                return $query->where('nama', 'LIKE', "%$search%")
                             ->orWhere('nik', 'LIKE', "%$search%");
            })
            ->paginate(10);

        return response()->json($warga);
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'nik' => 'required|string|unique:wargas,nik',
        'alamat' => 'required|string',
        'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $ktpPath = $request->hasFile('ktp')
        ? $request->file('ktp')->store('ktp', 'public')
        : null;

    $warga = Warga::create([
        'nama' => $request->nama,
        'nik' => $request->nik,
        'alamat' => $request->alamat,
        'ktp_path' => $ktpPath,
    ]);

    return response()->json([
        'message' => 'Warga berhasil didaftarkan',
        'data' => $warga
    ], 201);
}

    public function show(Warga $warga)
    {
        return response()->json($warga);
    }

    public function update(WargaRequest $request, Warga $warga)
    {
        if ($request->hasFile('ktp')) {
            Storage::disk('public')->delete($warga->ktp_path);
            $ktpPath = $request->file('ktp')->store('ktp', 'public');
        } else {
            $ktpPath = $warga->ktp_path;
        }

        $warga->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'ktp_path' => $ktpPath,
        ]);

        return response()->json(['message' => 'Warga berhasil diperbarui', 'data' => $warga]);
    }

    public function destroy($id)
{
    $warga = Warga::findOrFail($id);

    if ($warga->ktp_path) {
        Storage::disk('public')->delete($warga->ktp_path);
    }

    $warga->delete();

    return response()->json(['message' => 'Warga berhasil dihapus']);
}

}
