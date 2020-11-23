@extends('layouts.home')
@section('title')
    Data Pegawai
@endsection
@section('content')
    <form action="{{route('pegawai.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Pegawai" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('pegawai.create')}}">Add Pegawai</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>No Handphone</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($pegawai as $pgw)
                <tr>
                    <td>{{$loop->iteration + ($pegawai->perPage()) * ($pegawai->currentPage() - 1)}}</td>
                    <td>{{$pgw->nama_pegawai}}</td>
                    <td>{{$pgw->email}}</td>
                    <td>{{$pgw->no_handphone}}</td>
                    <td>{{$pgw->divisi->nama_divisi}}</td>
                    <td>{{$pgw->jabatan->nama_jabatan}}</td>
                    <td>{{$pgw->user->level->level}}</td>
                    <td>
                        <form action="{{route('pegawai.destroy',[$pgw->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                @csrf
                                {{ method_field('DELETE') }}

                                <a href="{{route('pegawai.edit',[$pgw->id])}}" class="btn btn-sm btn-warning ">
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
         {{$pegawai->links()}}
        </div>
    </div>
@endsection