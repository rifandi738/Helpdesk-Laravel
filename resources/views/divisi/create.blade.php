@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('divisi.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Divisi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Masukan Kode Divisi</label>
                            <input type="text"  name="kode_divisi"class="form-control" @error('kode_divisi') is-invalid @enderror" value="{{old('kode_divisi')}}">
                            <br>
                            @error('kode_divisi')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Masukan Nama Divisi</label>
                            <input type="text"  name="nama_divisi"class="form-control" @error('nama_divisi') is-invalid @enderror" value="{{old('nama_divisi')}}">
                            <br>
                            @error('nama_divisi')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('divisi.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection