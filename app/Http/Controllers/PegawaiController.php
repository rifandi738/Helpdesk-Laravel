<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Divisi;
use App\Jabatan;
use App\level;
use App\User;
use Illuminate\Support\Arr;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Nampilkan Data Pegawai Yang Ada
        $pegawai = Pegawai::paginate(5);
        $cari = $request->get('keyword');

        if ($cari) {
            $pegawai = Pegawai::where('nama_pegawai', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('pegawai.index', compact('pegawai'));
    }


    public function getJabatan($id)
    {
        $jabatan = Jabatan::where('divisi_id', $id)->pluck('nama_jabatan', 'id');
        return json_encode($jabatan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $level = level::all();
        $user = User::all();
        $pegawai = Pegawai::all();
        return view('pegawai.create', compact('divisi','jabatan','level' ,'user', 'pegawai'));
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
            'nama_pegawai' => 'required',
            'email' => 'required|unique:tbl_pegawai',
            'no_handphone' => 'required|numeric',
            'divisi_id' => 'required',
            'jabatan_id' => 'required',
            'level_id' => 'required',
            'password' => 'required'
        ]); 

        $user = new User;
        $user->username = $request->email;
        $user->level_id = $request->level_id;
        $user->password = bcrypt($request['password']);
        $user->save();

        $validateData = $request->request->add(['user_id' => $user->id]);
        $pegawai = Pegawai::create($request->all('nama_pegawai','email','no_handphone','divisi_id','jabatan_id','user_id'));

        return redirect()->route('pegawai.index')->withSuccess('Data Pegawai Berhasil Disimpan');

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
        $pegawai = Pegawai::findOrFail($id);
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $level = level::all();
        $user = User::all();

        return view('pegawai.edit', compact('divisi', 'jabatan','level','user','pegawai'));
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
        $pegawai = Pegawai::findOrFail($id);
        $validateData = $request->validate([
            'nama_pegawai' => 'required',
            'email' => 'required|unique:tbl_pegawai,email,' . $id,
            'no_handphone' => 'required|numeric',
            'divisi_id' => 'required',
            'jabatan_id' => 'required',
            'level_id' => 'required',
            'password' => 'sometimes|nullable'
        ]); 
       
        // $pegawai->user->update($request->only('username', 'level_id', bcrypt('password')));
        
        // dd(request('email'));

        $dataPegawai = [
            'username' => request('email'),
            'level_id' => request('level_id'),
            'password' => bcrypt(request('password')),
        ];
        $pegawai->user->update($dataPegawai);

        // dd($pegawai);

        $validateData = $request->request->add(['user_id' => $pegawai->user->id]);
    
        $pegawai->update($request->all('nama_pegawai','email','no_handphone','divisi_id','jabatan_id','user_id'));

        
        return redirect()->route('pegawai.index')->withSuccess('Data Pegawai Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->user()->delete();

        return redirect()->route('pegawai.index')->withSuccess('Data Pegawai Berhasil Dihapus');
    }
}
