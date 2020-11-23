@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Create User</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text"  name="username"class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}">
                            <br>
                            @error('username')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                       <div class="form-group">
                            <label>Password</label>
                            <input type="password"  name="password"class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">
                            <br>
                            @error('password')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label for="level_id">Level</label>
                                <select name="level_id" id="level_id" class="form-control @error('level_id') is-invalid @enderror" value="{{old('level')}}">
                                    @foreach ($level as $lvl)
                                        <option value="{{$lvl->id}}" {{old('level_id') == "$lvl->level" ? 'selected': ''}}>{{$lvl->level}}</option>
                                    @endforeach
                                </select>
                                <br>
                                @error('level_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('user.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
@endsection