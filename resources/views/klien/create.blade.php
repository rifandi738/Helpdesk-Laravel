@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('klien.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Klien</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Klien</label>
                            <input type="text"  name="nama_perusahaan"class="form-control
                             @error('nama_perusahaan') is-invalid @enderror" value="{{old('nama_perusahaan')}}">
                            <br>
                            @error('nama_perusahaan')
                                <span class="badge badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"  name="email"class="form-control
                             @error('email') is-invalid @enderror" value="{{old('email')}}">
                            <br>
                            @error('email')
                                <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label>No Telpon</label>
                            <input type="text"  name="no_telpon"class="form-control 
                            @error('no_telpon') is-invalid @enderror" value="{{old('no_telpon')}}">
                            <br>
                            @error('no_telpon')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                       <div class="form-group">
                            <label>Nama Operator</label>
                            <input type="text"  name="nama_operator"class="form-control 
                            @error('nama_operator') is-invalid @enderror" value="{{old('nama_operator')}}">
                            <br>
                            @error('nama_operator')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password"class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">
                            <br>
                            @error('password')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                                <select name="level_id" id="level_id" class="form-control ">
                                    @foreach ($level as $item)
                                        <option value="{{$item->id}}" {{old('level_id')=="$item->level" ? 'selected': ''}}>{{$item->level}}</option>
                                    @endforeach
                                </select>
                                <br>
                                @error('level_id')
                                    <span class="badge badge-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"class="form-control @error('alamat') is-invalid @enderror" value="">{{old('alamat')}}</textarea>
                            <br>
                            @error('alamat')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('klien.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection