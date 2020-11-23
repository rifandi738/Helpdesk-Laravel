<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use App\Divisi;
use App\Pegawai;
use Alert;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Nampilin Data Jabatan Yang Ada
        $jabatan = Jabatan::paginate(5);
        $cari = $request->get('keyword');

        if ($cari) {
            $jabatan = Jabatan::where('kode_jabatan', 'LIKE', "%$cari%")->orWhere('nama_jabatan', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi = Divisi::all();
        return view('jabatan.create', compact('divisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_jabatan' => 'required|min:4|max:6|unique:tbl_jabatan',
            'nama_jabatan' => 'required',
            'divisi_id' => 'required'

        ]);

        $jabatan = Jabatan::create($validatedData);

        return redirect()->route('jabatan.index')->withSuccess('Data Jabatan Berhasil Disimpan');
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
        $divisi = Divisi::all();
        $jabatan = Jabatan::findOrFail($id);

        return view('jabatan.edit', compact('jabatan', 'divisi'));
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
        $jabatan = Jabatan::findOrFail($id);
        $validatedData = $request->validate([
            'kode_jabatan' => 'required|unique:tbl_jabatan,kode_jabatan,'.$id,
            'nama_jabatan' => 'required',
            'divisi_id' => 'required'

        ]);

        $jabatan->update($validatedData);

        return redirect()->route('jabatan.index')->withSuccess('Data Jabatan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        $row2 = Pegawai::where('jabatan_id', $jabatan->id)->count();

        if($row2 < 1) {
            $jabatan->delete();
            Alert::success('Data Jabatan Berhasil Dihapus');
            return redirect()->route('jabatan.index');
        }else{
            Alert::warning('Data Jabatan Tidak Bisa Dihapus');
            return redirect()->route('jabatan.index');
        }
    }
}
