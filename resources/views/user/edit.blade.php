@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('user.update',[$user->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="card">
                    <div class="card-header">
                        <h4>Edit User</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Masukan Username</label>
                            <input type="text"  name="username"class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}">
                            <br>
                            @error('username')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                       <div class="form-group">
                            <label>Masukan Password</label>
                            <input type="text"  name="password"class="form-control @error('password') is-invalid @enderror" value="">
                            <br>
                            @error('password')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label for="level_id">Level</label>
                                <select name="level_id" id="level_id" class="form-control">
                                    @foreach ($level as $lvl)
                                        <option value="{{$lvl->id}}" @if($user->level_id == $lvl->id) selected @endif>
                                            {{$lvl->level}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('level_id')
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