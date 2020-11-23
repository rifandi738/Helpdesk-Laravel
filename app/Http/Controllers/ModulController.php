<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modul;
use App\Aplikasi;
use App\Pengaduan;
use Alert;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modul = Modul::paginate(5);
        $cari = $request->get('keyword');

        if ($cari) {
            $modul = Modul::where('nama_modul', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('modul.index', compact('modul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aplikasi = Aplikasi::all();

        return view('modul.create', compact('aplikasi'));
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
            'nama_modul' => 'required|unique:tbl_modul_aplikasi',
            'aplikasi_id' => 'required'

        ]);
        
        $modul = Modul::create($validateData);

        return redirect()->route('modul.index')->withSuccess('Data Modul Aplikasi Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aplikasi = Aplikasi::all();
        $modul = Modul::findOrFail($id);
        return view('modul.edit', compact('modul','aplikasi'));
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
        $modul = Modul::findOrFail($id);
        $validateData = $request->validate([
            'nama_modul' => 'required|unique:tbl_modul_aplikasi,nama_modul,'. $id,
            'aplikasi_id' => 'required'

        ]); 
        $modul->update($validateData);

        return redirect()->route('modul.index')->withSuccess('Data Modul Aplikasi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modul $modul)
    {
     
        $row2 = Pengaduan::where('modul_aplikasi_id', $modul->id)->count();
        
        if($row2 < 1) {
            $modul->delete();
            Alert::success('Data Modul Aplikasi Berhasil Dihapus');
            return redirect()->route('modul.index');
        }else{
            Alert::warning('Data Modul Aplikasi Tidak Bisa Dihapus');
            return redirect()->route('modul.index');
        }
    }
}
