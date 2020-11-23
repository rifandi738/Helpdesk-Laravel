@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('jabatan.update',[$jabatan->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Jabatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                                <label>Masukan Kode Jabtan</label>
                                <input type="text"  name="kode_jabatan"class="form-control @error('kode_jabatan') is-invalid @enderror" value="{{$jabatan->kode_jabatan}}">
                                <br>
                                @error('kode_jabatan')
                                        <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Masukan Nama Jabtan</label>
                            <input type="text"  name="nama_jabatan"class="form-control @error('nama_jabatan') is-invalid @enderror" value="{{$jabatan->nama_jabatan}}">
                            <br>
                            @error('nama_jabatan')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="divisi_id">Divisi</label>
                                <select name="divisi_id" id="divisi_id" class="form-control">
                                    @foreach ($divisi as $dvs)
                                        <option value="{{$dvs->id}}" @if($jabatan->divisi_id == $dvs->id) selected @endif>
                                            {{$dvs->nama_divisi}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('divisi_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('jabatan.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection