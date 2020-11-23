@extends('layouts.home')
@section('title')
    History Data Pengaduan
@endsection
@section('content')
    <form action="{{route('pengaduan-history')}}">
        <div class="form-row align-items-center">
            <div class="col-md-3">
                <label>Tanggal Awal</label>
                <input type="date" id="created_at" class="form-control" name="start_date">
            </div>
            <div class="col-md-3">
                <label>Tanggal Akhir</label>
                <input type="date" id="created_at" class="form-control" name="end_date">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Filter</button>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Nama Klien</th>
                    {{-- <th>Nama Operator</th> --}}
                    <th>Aplikasi</th>
                    <th>Modul Aplikasi</th>
                    {{-- <th>Status</th> --}}
                    <th>Keterangan</th>
                  </tr>
            </thead>
            <tbody>
            @foreach($historyPengaduan as $hsr)
                     <tr>
                        <td>{{$loop->iteration + ($historyPengaduan->perPage()) * ($historyPengaduan->currentPage() - 1)}}</td>
                        <td>{{ Carbon\Carbon::parse($hsr->tanggal_pengaduan)->format('d M Y')}}</td>
                        <td>{{$hsr->klien->nama_perusahaan}}</td>
                        {{-- <td>{{$lpr->klien->operator->nama_operator}}</td> --}}
                        <td>{{$hsr->aplikasi->nama_aplikasi}}</td>
                        <td>{{$hsr->modul->nama_modul}}</td>
                        {{-- <td>{{$lpr->status->nama_status}}</td> --}}
                        <td>{!!$hsr->keterangan!!}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        <div class="box-footer">
         {{$historyPengaduan->links()}}
        </div>
    </div>
@endsection