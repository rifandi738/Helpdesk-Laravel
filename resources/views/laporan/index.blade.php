@extends('layouts.home')
@section('title')
    Laporan Data Pengaduan
@endsection
@section('content')
    <form action="{{url('cetak-laporan')}}">
        <div class="form-row align-items-center">
            <div class="col-md-3">
                <label>Tanggal Awal</label>
                <input type="date" id="" class="form-control" name="start_date" value="{{Request::get('start_date')}}">
            </div>
            <div class="col-md-3">
                <label>Tanggal Akhir</label>
                <input type="date" id="" class="form-control" name="end_date" value="{{Request::get('end_date')}}">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Filter</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
        <a href="{{url('/cetak-laporan')}}" class="btn btn-primary text-white" id="">Cetak</a>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Nama Klien</th>
                    <th>Nama Operator</th>
                    <th>Aplikasi</th>
                    <th>Modul Aplikasi</th>
                    {{-- <th>Status</th> --}}
                    <th>Keterangan</th>
                  </tr>
            </thead>
            <tbody>
            @foreach($laporan as $lpr)
                     <tr>
                        <td>{{$loop->iteration + ($laporan->perPage()) * ($laporan->currentPage() - 1)}}</td>
                        <td>{{ Carbon\Carbon::parse($lpr->tanggal_pengaduan)->format('d M Y')}}</td>
                        <td>{{$lpr->klien->nama_perusahaan}}</td>
                        <td>{{$lpr->klien->operator->nama_operator}}</td>
                        <td>{{$lpr->aplikasi->nama_aplikasi}}</td>
                        <td>{{$lpr->modul->nama_modul}}</td>
                        {{-- <td>{{$lpr->status->nama_status}}</td> --}}
                        <td>{!!$lpr->keterangan!!}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        <div class="box-footer">
         {{$laporan->links()}}
        </div>
    </div>
@endsection