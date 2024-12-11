<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function create()
    {
        return view('form.create'); // Menampilkan form
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255', // Sesuaikan key dengan input di form
            'nrp' => 'required|string|size:10', // Validasi NRP harus unik
        ]);

        // Simpan data ke database
        Form::create([
            'nama' => $request->nama, // Mapping input nama ke field database
            'nrp' => $request->nrp,  // Mapping input nrp ke field database
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('book.index')->with('success', 'Data berhasil disimpan!');
    }
}
