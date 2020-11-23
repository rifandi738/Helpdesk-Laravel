<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
// use Status;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if (Auth::user()->klien) {
            $user = Auth::user()->klien;
            $openticket = Pengaduan::where('klien_id', '=', $user->id)->where('status_id', '=', 1)->count();
            $wait = Pengaduan::where('klien_id', '=', $user->id)->where('status_id', '=', 2)->count();
            $proses = Pengaduan::where('klien_id', '=', $user->id)->where('status_id', '=', 3)->count();
            $close = Pengaduan::where('klien_id', '=', $user->id)->where('status_id', '=', 4)->count();
        }else{
            $openticket = Pengaduan::where('status_id', 1)->count();
            $wait = Pengaduan::where('status_id', 2)->count();
            $proses = Pengaduan::where('status_id', 3)->count();
            $close = Pengaduan::where('status_id', 4)->count();
        }
        
        return view('dashboard.index',compact('openticket','wait','proses','close'));
    }
}
