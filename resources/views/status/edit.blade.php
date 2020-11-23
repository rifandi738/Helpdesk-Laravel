@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('status.update',[$status->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$status->id}}">
                        </div>
                        <div class="form-group">
                            <label>Masukan Nama Status</label>
                            <input type="text"  name="nama_status"class="form-control @error('nama_status') is-invalid @enderror" value="{{$status->nama_status}}">
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