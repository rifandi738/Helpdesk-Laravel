<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
use Carbon\Carbon;
use Auth;

class HistoryController extends Controller
{
    // public function history(Request $request){
    //     $start = $request->get('start_date');
    //     $end = $request->get('end_date');
        
    //     if ($request->has('start_date') && $request->has('end_date')) {
    //         $historyPengaduan = Pengaduan::with(['klien.operator'])->whereBetween('tanggal_pengaduan', [$start, $end])->paginate();
    //     }elseif(Auth::user()->klien){
    //         $user = Auth::user()->klien;
    //         $historyPengaduan = Pengaduan::where('klien_id', '=', $user->id)->paginate();
    //     }
    //     return view('history.index', compact('historyPengaduan'));
    // }
}
