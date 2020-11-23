@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('status.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Masukan Id Status</label>
                            <input type="text"  name="id"class="form-control" @error('id') is-invalid @enderror" value="{{old('id')}}">
                            <br>
                            @error('kode_jabatan')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Masukan Nama Status</label>
                            <input type="text"  name="nama_status" class="form-control" @error('nama_status') is-invalid @enderror" value="{{old('nama_status')}}">
                            <br>
                            @error('nama_status')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('status.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection