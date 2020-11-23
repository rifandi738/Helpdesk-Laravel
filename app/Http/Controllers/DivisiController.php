<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Divisi;
use App\Pegawai;
use App\Jabatan;
use Alert;
use Illuminate\Support\Facades\Validator;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Nampilin Data Divisi Yang Ada
       
        $divisi = Divisi::paginate(5);

        $cari = $request->get('keyword');

        if ($cari) {
            $divisi = Divisi::where('kode_divisi', 'LIKE', "%$cari%")->orWhere('nama_divisi', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('divisi.index',compact('divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisi.create');
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
            'kode_divisi' => 'required|unique:tbl_divisi',
            'nama_divisi' => 'required'
        ]);

        $divisi = Divisi::create($validateData);

        return redirect()->route('divisi.index')->withSuccess('Data Divisi Berhasil Disimpan');
       
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
        $divisi = Divisi::findOrFail($id);

        return view('divisi.edit', compact('divisi'));
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
        $divisi = Divisi::findOrFail($id);
        $validateData = $request->validate([
            'kode_divisi' => 'required|unique:tbl_divisi,kode_divisi,'.$id,
            'nama_divisi' => 'required'
        ]);

        $divisi->update($validateData);

        return redirect()->route('divisi.index')->withSuccess('Data Divisi Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divisi $divisi)
    {
        $row1 = Pegawai::where('divisi_id', $divisi->id)->count();
        $row2 = Jabatan::where('divisi_id', $divisi->id)->count();

        if($row1 < 1 && $row2 < 1) {
            $divisi->delete();
            Alert::success('Data Divisi Berhasil Dihapus');
            return redirect()->route('divisi.index');
        }else{
            Alert::warning('Data Divisi Tidak Bisa Dihapus');
            return redirect()->route('divisi.index');
        }
    }
}
