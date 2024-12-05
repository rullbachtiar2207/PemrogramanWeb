<?php

// Sebelumnya
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;  // Error di sini, Controller tidak ditemukan

// Perbaiki menjadi
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;  // Menggunakan Controller dari app/Http/Controllers

class PortofolioController extends BaseController
{
    // controller logic
}


use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua layanan dari database
        $layanans = Layanan::all();

        // Mengembalikan response JSON
        return response()->json($layanans, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);

        // Jika validasi gagal, kirimkan error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Membuat layanan baru di database
        $layanan = Layanan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        // Mengembalikan response JSON setelah data berhasil ditambahkan
        return response()->json($layanan, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mencari layanan berdasarkan ID
        $layanan = Layanan::find($id);

        // Jika data tidak ditemukan, kembalikan response error
        if (!$layanan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Mengembalikan layanan yang ditemukan dalam response JSON
        return response()->json($layanan, 200);
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
        // Mencari layanan berdasarkan ID
        $layanan = Layanan::find($id);

        // Jika layanan tidak ditemukan, kembalikan response error
        if (!$layanan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Memperbarui data layanan dengan input baru
        $layanan->update($request->all());

        // Mengembalikan data layanan yang telah diperbarui
        return response()->json($layanan, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mencari layanan berdasarkan ID
        $layanan = Layanan::find($id);

        // Jika layanan tidak ditemukan, kembalikan response error
        if (!$layanan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Menghapus layanan
        $layanan->delete();

        // Mengembalikan response setelah data dihapus
        return response()->json(['message' => 'Deleted'], 200);
    }
}
