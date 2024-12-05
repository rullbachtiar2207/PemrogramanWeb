<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data portofolio
        $portofolios = Portofolio::all();
        
        // Mengembalikan data dalam format JSON
        return response()->json($portofolios, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Menyimpan gambar
        $file = $request->file('gambar')->store('public/portofolios');
        
        // Menyimpan data portofolio ke database
        $data = Portofolio::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => basename($file),
        ]);

        // Mengembalikan data yang disimpan sebagai response
        return response()->json($data, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Mencari portofolio berdasarkan ID
        $portofolio = Portofolio::find($id);

        if (!$portofolio) {
            return response()->json(['message' => 'Portofolio not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Perbarui data yang ada
        $portofolio->judul = $request->judul;
        $portofolio->deskripsi = $request->deskripsi;

        // Jika ada gambar baru, simpan gambar dan perbarui data
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->store('public/portofolios');
            $portofolio->gambar = basename($file);
        }

        // Simpan perubahan
        $portofolio->save();

        // Mengembalikan data yang diperbarui
        return response()->json($portofolio, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mencari portofolio berdasarkan ID
        $portofolio = Portofolio::find($id);

        if (!$portofolio) {
            return response()->json(['message' => 'Portofolio not found'], 404);
        }

        // Menghapus portofolio
        $portofolio->delete();

        // Mengembalikan response setelah data dihapus
        return response()->json(['message' => 'Portofolio deleted'], 200);
    }
}
