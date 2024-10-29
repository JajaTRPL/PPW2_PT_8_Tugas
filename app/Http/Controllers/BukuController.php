<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $data_buku = Buku::all();

        $jumlah_buku = $data_buku->count();

        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }
    public function admin()
    {
        $data_buku = Buku::all();

        $jumlah_buku = $data_buku->count();

        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:10000|max:50000',  
            'tgl_terbit' => 'required|date',
        ],  [
            'judul.required' => 'Judul tidak boleh kosong.',
            'penulis.required' => 'Penulis tidak boleh kosong.',
            'harga.required' => 'Harga tidak boleh kosong.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga minimum adalah 10.000.',
            'harga.max' => 'Harga maksimum adalah 50.000.',
            'tgl_terbit.required' => 'Tanggal terbit tidak boleh kosong.',
            'tgl_terbit.date' => 'Tanggal terbit harus merupakan tanggal yang valid.',
        ]
        );

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect('/buku')->with('success', 'Buku berhasil dihapus');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:10000|max:50000',  
            'tgl_terbit' => 'required|date',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "$".$cari."%")->orwhere('penulis','like', "$".$cari."%")
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('buku.search', compact('jumlah_buku', 'data_buku', 'no', 'cari'));
    }
}
