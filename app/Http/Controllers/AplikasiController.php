<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplikasi;
use App\Modul;
use App\Pengaduan;
Use Alert;

class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Nampilkaan Data Aplikasi Yang Ada
        $aplikasi = Aplikasi::paginate(5);

        $cari = $request->get('keyword');

        if ($cari) {
            $aplikasi = Aplikasi::where('nama_aplikasi', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('aplikasi.index', compact('aplikasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aplikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_aplikasi' => 'required|unique:tbl_aplikasi'
        ]);

        $aplikasi = Aplikasi::create($validateData);

        return redirect()->route('aplikasi.index')->withSuccess('Data Aplikasi Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aplikasi = Aplikasi::findOrfail($id);
        return view('aplikasi.edit', compact('aplikasi'));
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
        $aplikasi = Aplikasi::findOrFail($id);
        $validateData = $request->validate([
            'nama_aplikasi' => 'required|unique:tbl_aplikasi,nama_aplikasi,'. $id,
        ]); 
        $aplikasi->update($validateData);

        return redirect()->route('aplikasi.index')->withSuccess('Data Aplikasi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplikasi $aplikasi)
    {
       


        $row1 = Modul::where('aplikasi_id', $aplikasi->id)->count();
        $row2 = Pengaduan::where('aplikasi_id', $aplikasi->id)->count();

        
        if($row1 < 1 && $row2 < 1) {
            $aplikasi->delete();
            Alert::success('Data Aplikasi Berhasil Dihapus');
            return redirect()->route('aplikasi.index');
        }else{
            Alert::warning('Data Aplikasi Tidak Bisa Dihapus');
            return redirect()->route('aplikasi.index');
        }
    }
}
