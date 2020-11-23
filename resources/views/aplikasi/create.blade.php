@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('aplikasi.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Aplikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Masukan Nama Aplikasi</label>
                            <input type="text"  name="nama_aplikasi"class="form-control" @error('nama_aplikasi') is-invalid @enderror" value="{{old('nama_aplikasi')}}">
                            <br>
                            @error('nama_aplikasi')
                                <span class="badge badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('aplikasi.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection