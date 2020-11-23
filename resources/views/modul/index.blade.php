@extends('layouts.home')
@section('title')
    Data Modul Aplikasi
@endsection
@section('content')
    <form action="{{route('modul.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Modul" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('modul.create')}}">Add Modul</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th style="width:10px">No</th>
                    <th>Modul Aplikasi</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($modul as $mdl)
                <tr>
                    <td>{{$loop->iteration + ($modul->perPage()) * ($modul->currentPage() - 1)}}</td>
                    <td>{{$mdl->nama_modul}}</td>
                    <td>
                        <form action="{{route('modul.destroy',[$mdl->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                @csrf
                                {{ method_field('DELETE') }}

                                <a href="{{route('modul.edit',[$mdl->id])}}" class="btn btn-sm btn-warning ">
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
         {{$modul->links()}}
        </div>
    </div>
@endsection