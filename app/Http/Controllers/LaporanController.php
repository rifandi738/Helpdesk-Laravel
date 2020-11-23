<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request){
       
        $start = $request->get('start_date');
        $end = $request->get('end_date');
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $laporan = Pengaduan::with(['klien.operator'])->whereBetween('tanggal_pengaduan', [$start, $end])->paginate();
        }else{
            $laporan = Pengaduan::where('status_id', '=', 4)->paginate();
        }
         
        return view('laporan.index', compact('laporan'));
    }


    public function cetakLaporan(Request $request){
        $start = $request->get('start_date');
        $end = $request->get('end_date');
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $laporan = Pengaduan::with(['klien.operator'])->whereBetween('tanggal_pengaduan', [$start, $end])->where('status_id', '=', 4)->get();
        }else{
            $laporan = Pengaduan::where('status_id', '=', 4)->paginate();
        }
        return view('laporan.pengaduan_pdf', compact('laporan'));
    }

}
