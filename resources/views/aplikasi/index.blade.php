@extends('layouts.home')
@section('title')
    Data Aplikasi
@endsection
@section('content')
    <form action="{{route('aplikasi.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Aplikasi" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('aplikasi.create')}}">Add Aplikasi</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th style="width:10px">No</th>
                    <th>Nama Aplikasi</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($aplikasi as $apk)
                <tr>
                    <td>{{$loop->iteration + ($aplikasi->perPage()) * ($aplikasi->currentPage() - 1)}}</td>
                    <td>{{$apk->nama_aplikasi}}</td>
                    <td>
                    <form action="{{route('aplikasi.destroy',[$apk->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                        @csrf
                        {{ method_field('DELETE') }}

                        <a href="{{ route('aplikasi.edit',[$apk->id]) }}" class="btn btn-warning btn-sm">
                            <i class="far fa-edit"></i>
                        </a>

                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                    </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
         <div class="box-footer">
         {{$aplikasi->links()}}
        </div>
    </div>
@endsection