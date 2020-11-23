<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
use App\Klien;
use App\Status;
use App\Aplikasi;
use App\Modul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function responStatus($id)
    {
        $status_update = Pengaduan::find($id);

        if ($status_update->status_id == 1) {
            $status_update->status_id = 2;
        } elseif ($status_update->status_id == 2) {
            $status_update->status_id = 3;
        } elseif ($status_update->status_id = 3) {
            $status_update->status_id = 4;
        } else {
            $status_update->status_id = 1;
        }

        // dd(statusupdate);
        $status_update->save();

        return redirect('getPengaduan')->withSuccess('Status Berhasil Diupdate');
    }


    public function index(Request $request)
    {
        $cari = $request->get('keyword');

        if ($cari) {
            $pengaduan = Pengaduan::with(['klien'])->whereHas('klien', function ($query) use ($cari) {
                $query->where('nama_perusahaan', 'LIKE', '%' . $cari . '%');
            })->paginate();
        } else {
            $pengaduan = Pengaduan::paginate();
        }

        return view('pengaduan.index', compact('pengaduan'));
    }

    public function getModul($id)
    {
        $modul = Modul::where('aplikasi_id', $id)->pluck('nama_modul', 'id');
        return json_encode($modul);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $pengaduan = Pengaduan::all();
        $aplikasi = Aplikasi::all();
        $modul = Modul::all();
        $status  = Status::all();
        $klien = Klien::all();


        return view('pengaduan.create', compact('pengaduan', 'aplikasi', 'status', 'klien', 'aplikasi', 'modul'));
    }


    public function getPengaduan(Request $request)
    {
        // $cari = $request->get('keyword');
        // $cariStatus = $request->get('name');
        $start = $request->get('start_date');
        $end = $request->get('end_date');
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $pengaduan = Pengaduan::with(['klien.operator'])->whereBetween('tanggal_pengaduan', [$start, $end])->paginate();
        }elseif (request('status')) {
           $pengaduan = Pengaduan::with(['status'])->whereHas('status', function ($query) use ($request) {
                $query->where('nama_status', 'LIKE', '%' . request('status') . '%');
            })->paginate();
        }elseif (request('keyword')) {
            $pengaduan = Pengaduan::with(['klien'])->whereHas('klien', function ($query) use ($request) {
                $query->where('nama_perusahaan', 'LIKE', '%' . request('keyword') . '%');
            })->paginate();
        }elseif (Auth::user()->klien) {
            $user = Auth::user()->klien;
            $pengaduan = Pengaduan::where('klien_id', '=', $user->id)->orderBy('status_id', 'asc')->paginate();
        }elseif (Auth::user()->level_id == 3) {
            $pengaduan = Pengaduan::where('status_id', '!=', 1)->orderBy('status_id', 'asc')->paginate();
        }else {
            $pengaduan = Pengaduan::orderBy('status_id', 'asc')->paginate();
        }


        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {

        $pengaduan = $request->all();

        $validasi = Validator::make($pengaduan, [
            'tanggal_pengaduan' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'aplikasi_id' => 'required',
            'keterangan' => 'required',
            'klien_id' => 'required',
            'status_id' => 'required',
            'modul_aplikasi_id' => 'required'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('getCreate')->withErrors($validasi)->withInput();
        }

        if ($request->file('image')->isValid()) {
            $foto = $request->file('image');
            $extention = $foto->getClientOriginalExtension();

            $namaFoto = date('YmdHis') . "." . $extention;
            $upload_path = 'images/pengaduan/';
            $request->file('image')->move($upload_path, $namaFoto);

            $pengaduan['image'] = $namaFoto;
        }
        Pengaduan::create($pengaduan);


        return redirect()->route('getPengaduan')->withSuccess('Data Pengaduan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetail($id)
    {
        if (Auth::user()->level_id == 3) {
            $detail = Pengaduan::where('id', $id)->where('status_id', '!=', 1)->first();
            if (!$detail) {
                return redirect()->route('getPengaduan');
            }
        }elseif(Auth::user()->klien){
            $user = Auth::user()->klien;
            $detail = Pengaduan::where('id', $id)->where('klien_id', '=', $user->id)->first();
            if (!$detail) {
                return redirect()->route('getPengaduan');
            }
        }else{
            $detail = Pengaduan::findOrFail($id);
        }

        return view('pengaduan.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPengaduan($id)
    {
        $aplikasi = Aplikasi::all();
        $modul = Modul::all();
        $status  = Status::all();
        $klien = Klien::all();

        if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2) {
            $pengaduan = Pengaduan::findOrFail($id);
        } elseif(Auth::user()->level_id == 3) {
            $pengaduan = Pengaduan::where('id', $id)->where('status_id', '=', 3)->first();
            if(!$pengaduan){
                return redirect()->route('getPengaduan');
            }
        }else{
            $pengaduan = Pengaduan::where('id', $id)->where('klien_id', Auth::user()->level_id)->first();
            if (!$pengaduan) {
                return redirect()->route('getPengaduan');
            }
        }

        return view('pengaduan.edit', compact('pengaduan', 'aplikasi', 'modul', 'status', 'klien'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $update_pengaduan = $request->all();

        $validasi = Validator::make($update_pengaduan, [
            'tanggal_pengaduan' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png',
            'keterangan' => 'nullable',
            'klien_id' => 'required',
            'status_id' => 'required',
            'aplikasi_id' => 'required',
            'modul_aplikasi_id' => 'required',
            'noted' => 'nullable',
            'image_noted' => 'nullable'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('pengaduan.editPengaduan', [$id])->withErrors($validasi)->withInput();
        }

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {

                $foto = $request->file('image');
                $extention = $foto->getClientOriginalExtension();

                $namaFoto = date('YmdHis') . "." . $extention;
                $upload_path = 'images/pengaduan/';
                $request->file('image')->move($upload_path, $namaFoto);

                $update_pengaduan['image'] = $namaFoto;
            }
        }

        if ($request->hasFile('image_noted')) {
            if ($request->file('image_noted')->isValid()) {

                $gambar = $request->file('image_noted');
                $extention = $gambar->getClientOriginalExtension();

                $namaGambar = date('YmdHis') . "." . $extention;
                $upload_path = 'images/pengaduan/';
                $request->file('image_noted')->move($upload_path, $namaGambar);

                $update_pengaduan['image_noted'] = $namaGambar;
            }
        }
        // dd($request);

        $pengaduan->update($update_pengaduan);
        return redirect()->route('getPengaduan')->withSuccess('Data Pengaduan Berhasil di Update');
    }

    public function historyPengaduan(Request $request)
    {
        $start = $request->get('start_date');
        $end = $request->get('end_date');

        if ($request->has('start_date') && $request->has('end_date')) {
            $historyPengaduan = Pengaduan::with(['klien.operator'])->whereBetween('tanggal_pengaduan', [$start, $end])->paginate();
        } elseif (Auth::user()->klien) {
            $user = Auth::user()->klien;
            $historyPengaduan = Pengaduan::where('klien_id', '=', $user->id)->where('status_id', '=', 4)->paginate();
        }
        return view('pengaduan.historyPengaduan', compact('historyPengaduan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->withSuccess('Data Pengaduan Berhasil di Hapus');;
    }
}
