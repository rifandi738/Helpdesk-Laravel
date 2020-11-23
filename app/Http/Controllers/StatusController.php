<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Pengaduan;
Use Alert;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //Nampilkan Data Status Yang Ada
        $status = Status::paginate(5);
        $cari = $request->get('keyword');

        if ($cari) {
            $status = Status::where('nama_status', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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
            'id' => 'required',
            'nama_status' => 'required'
        ]);

        $status = Status::create($validateData);

        return redirect()->route('status.index')->withSuccess('Data Status Berhasil Disimpan');
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
        $status = Status::findOrFail($id);

        return view('status.edit', compact('status'));
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
        $status = Status::findOrFail($id);
        $validateData = $request->validate([
            'id' => 'required',
            'nama_status' => 'required'
        ]); 
        $status->update($validateData);

        return redirect()->route('status.index')->withSuccess('Data Status Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
       
        $row = Pengaduan::where('status_id', $status->id)->count();
        if ($row < 1) {
            $status->delete();
            Alert::success('Data Status Berhasil Dihapus');
            return redirect()->route('status.index');
        } else {
            Alert::warning('Data Status Tidak Bisa Dihapus');
            return redirect()->route('status.index');
        }
    }
}
