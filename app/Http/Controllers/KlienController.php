<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Klien;
use App\User;
use App\level;
use App\Operator;
use App\Pengaduan;
Use Alert;

class KlienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Nampilin Data Klien Yang Ada
        $klien = Klien::paginate(5);

        $cari = $request->get('keyword');

        if ($cari) {
            $klien = Klien::where('nama_perusahaan', 'LIKE', "%$cari%")->paginate(5);
        }
        return view('klien.index', compact('klien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $klien = Klien::all();
        $level = Level::all();
        $user = User::all();
        $operator = Operator::all();

        return view('klien.create', compact('klien', 'user' ,'level', 'operator'));
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
            'nama_perusahaan' => 'required',
            'email' => 'required|unique:tbl_klien',
            'no_telpon' => 'required|numeric',
            'alamat' => 'required',
            'level_id' => 'required',
            'nama_operator' => 'required',
            'password' => 'required'
        ]); 

        $user = new User;
        $user->username = $request->email;
        $user->level_id = $request->level_id;
        $user->password = bcrypt($request['password']);
        $user->save();


        $validateData = $request->request->add(['user_id' => $user->id]);
        $klien = Klien::create($request->all('nama_perusahaan','email','no_telpon','alamat','user_id'));

        
        $operator = new Operator;
        $operator->nama_operator = $request->nama_operator;
        $klien->operator()->save($operator);
       

        return redirect()->route('klien.index')->withSuccess('Data Klien Berhasil Disimpan');
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
        $user = User::all();
        $level = level::all();
        $operator = Operator::all();
        $klien = Klien::findOrFail($id);

        return view('klien.edit', compact('user', 'level', 'operator', 'klien'));
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
      
        $klien = Klien::findOrFail($id);
        $validateData = $request->validate([
            'nama_perusahaan' => 'required',
            'email' => 'required|unique:tbl_klien,email,' . $id,
            'no_telpon' => 'required|numeric',
            'alamat' => 'required',
            'level_id' => 'required',
            'nama_operator' => 'required',
            'password' => 'sometimes|nullable'
        ]); 
        
        // $klien->user->update($request->only('email', 'level_id', bcrypt('password')));

        $dataUser = [
            'username' => request('email'),
            'level_id' => request('level_id'),
            'password' => bcrypt(request('password')),
        ];
        $klien->user->update($dataUser);
       

        $validateData = $request->request->add(['user_id' => $klien->user->id]);
        $klien->update($request->all('nama_perusahaan','email','no_telpon','alamat','user_id'));


        $operator = $klien->operator;
        $operator->nama_operator = $request->nama_operator;
        $klien->operator()->save($operator);
       
        return redirect()->route('klien.index')->withSuccess('Data Klien Berhasil Diupdate');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klien $klien)
    {
        $row = Pengaduan::where('klien_id',$klien->id)->count();
        if ($row < 1) {
            $klien->user()->delete();
            Alert::success('Data Klien Berhasil Dihapus');
            return redirect()->route('klien.index');
        } else {
            Alert::warning('Data Klien Tidak Bisa Dihapus');
            return redirect()->route('klien.index');
        }

    }
}
