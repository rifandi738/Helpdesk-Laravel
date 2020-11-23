<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\level;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Nampilkan Data User Yang  Ada
        $user = User::paginate(5);
        $cari = $request->get('keyword');

        if ($cari) {
            $user = User::where('username', 'LIKE', "$cari")->paginate(5);
        }
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $level = level::all();

        return view('user.create', compact('user', 'level'));
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
            'username' => 'required|unique:tbl_user',
            'password' => 'required',
            'level_id' => 'required'

        ]);
        
        $validateData ['password'] = bcrypt($request['password']);
        $user = User::create($validateData);

        return redirect()->route('user.index')->withSuccess('Data User Berhasil Disimpan');
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
        $level = level::all();
        $user = User::findOrFail($id);   
        return view('user.edit', compact('user','level'));
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
        $user = User::findOrFail($id);
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level_id' => 'required'

        ]);
        
        $validateData ['password'] = bcrypt($request['password']);
        $user->update($validateData);

        return redirect()->route('user.index')->withSuccess('Data User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->withSuccess('Data User Berhasil Dihapus');
    }
}
