@extends('layouts.home')
@section('title')
    Data Jabatan
@endsection
@section('content')
    <form action="{{route('jabatan.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode Jabatan" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('jabatan.create')}}">Add Jabatan</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jabatan</th>
                    <th>Nama Nama Jabatan</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($jabatan as $jbt)
                <tr>
                    <td>{{$loop->iteration + ($jabatan->perPage()) * ($jabatan->currentPage() - 1)}}</td>
                    <td>{{$jbt->kode_jabatan}}</td>
                    <td>{{$jbt->nama_jabatan}}</td>
                    <td>
                        <form action="{{route('jabatan.destroy',[$jbt->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                            @csrf
                            {{ method_field('DELETE') }}

                            <a href="{{route('jabatan.edit',[$jbt->id])}}" class="btn btn-sm btn-warning ">
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
            {{$jabatan->links()}}
        </div>
    </div>
@endsection