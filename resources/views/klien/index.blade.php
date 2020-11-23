@extends('layouts.home')
@section('title')
    Data Klien
@endsection
@section('content')
    <form action="{{route('klien.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Klien" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('klien.create')}}">Add Klien</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Operator</th>
                    <th>Email</th>
                    <th>No Telpon</th>
                    <th>Alamat</th>
                    {{-- <th>Level</th> --}}
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($klien as $kly)
                <tr>
                    <td>{{$loop->iteration + ($klien->perPage()) * ($klien->currentPage() - 1)}}</td>
                    <td>{{$kly->nama_perusahaan}}</td>
                    <td>{{$kly->operator->nama_operator}}</td>
                    <td>{{$kly->email}}</td>
                    <td>{{$kly->no_telpon}}</td>
                    <td>{{$kly->alamat}}</td>
                    {{-- <td>{{$kly->user->level->level}}</td> --}}
                    <td>
                        <form action="{{route('klien.destroy',[$kly->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                            @csrf
                            {{ method_field('DELETE') }}

                            <a href="{{route('klien.edit',[$kly->id])}}" class="btn btn-sm btn-warning ">
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
         {{$klien->links()}}
        </div>
    </div>
@endsection