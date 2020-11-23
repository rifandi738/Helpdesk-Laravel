@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('modul.update',[$modul->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Modul Aplikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Masukan Nama Modul</label>
                            <input type="text"  name="nama_modul"class="form-control @error('nama_modul') is-invalid @enderror" value="{{$modul->nama_modul}}">
                            <br>
                            @error('nama_modul')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label for="aplikasi_id">Aplikasi</label>
                                <select name="aplikasi_id" id="aplikasi_id" class="form-control">
                                    @foreach ($aplikasi as $apk)
                                        <option value="{{$apk->id}}" @if($modul->aplikasi_id == $apk->id) selected @endif>
                                            {{$apk->nama_aplikasi}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('aplikasi_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('modul.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection