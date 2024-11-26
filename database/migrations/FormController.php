<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Model untuk menyimpan data ke tabel

class FormController extends Controller
{
    public function submitForm(Request $request)
{
    // Validasi form data
    $validated = $request->validate([
        'name' => 'required|regex:/^[a-zA-Z\s]+$/',
        'nrp' => 'required|digits:10', // Pastikan NRP memiliki 10 digit
    ]);

    // Jika validasi berhasil, lanjutkan dengan logika
    // Simpan data atau proses lainnya
    return response()->json(['message' => 'Data berhasil dikirim!']);
}
}
