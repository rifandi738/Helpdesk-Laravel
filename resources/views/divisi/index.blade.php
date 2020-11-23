@extends('layouts.home')
@section('title')
    Data Divisi
@endsection
@section('content')
    <form action="{{route('divisi.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode Divisi" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('divisi.create')}}">Add Divisi</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Divisi</th>
                    <th>Nama Divisi</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($divisi as $dvs)
                <tr>
                    <td>{{$loop->iteration + ($divisi->perPage()) * ($divisi->currentPage() - 1)}}</td>
                    <td>{{$dvs->kode_divisi}}</td>
                    <td>{{$dvs->nama_divisi}}</td>
                    <td>
                        <form action="{{route('divisi.destroy',[$dvs->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                            @csrf
                            {{ method_field('DELETE') }}

                            <a href="{{route('divisi.edit',[$dvs->id])}}" class="btn btn-sm btn-warning ">
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
            {{$divisi->links()}}
        </div>
    </div>
@endsection