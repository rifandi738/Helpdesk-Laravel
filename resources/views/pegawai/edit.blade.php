@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('pegawai.update',[$pegawai->id])}}" method="POST" enctype="multipart/form-data">
                 @csrf
                {{ method_field('PUT') }}

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text"  name="nama_pegawai"class="form-control
                             @error('nama_pegawai') is-invalid @enderror" value="{{$pegawai->nama_pegawai}}">
                            <br>
                            @error('nama_pegawai')
                                <span class="badge badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"  name="email"class="form-control
                             @error('email') is-invalid @enderror" value="{{$pegawai->email}}">
                            <br>
                            @error('email')
                                <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label>No Handphone</label>
                            <input type="text"  name="no_handphone"class="form-control 
                            @error('no_handphone') is-invalid @enderror" value="{{$pegawai->no_handphone}}">
                            <br>
                            @error('no_handphone')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label for="divis_id">Divisi</label>
                                <select name="divisi_id" id="divisi_id" class="form-control">
                                   @foreach ($divisi as $dvs)
                                        <option value="{{$dvs->id}}" @if($pegawai->divisi_id == $dvs->id) selected @endif>
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
                            <label for="jabatan_id">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control">
                                     @foreach ($jabatan as $jbt)
                                        <option value="{{$jbt->id}}" @if($pegawai->jabatan_id == $jbt->id) selected @endif>
                                            {{$jbt->nama_jabatan}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('jabatan_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password"class="form-control @error('password') is-invalid @enderror" value="">
                            <br>
                            @error('password')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       <div class="form-group">
                            <label for="level_id">Level</label>
                                <select name="level_id" id="level_id" class="form-control">
                                     @foreach ($level as $lvl)
                                        <option value="{{$lvl->id}}" @if($pegawai->user->level_id == $lvl->id) selected @endif>
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
                            <a href="{{route('pegawai.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>
    @section('script')
        <script src="{{asset('backend/assets/modules/jquery.min.js')}}"></script>
            <script>
                $(function() {
                    $('select[name="divisi_id"]').on('change', function () {
                        var divisiID = $(this).val();

                        if (divisiID) {
                            $.get('/getJabatan/' + divisiID, function(data) {
                                $('select[name="jabatan_id"]').empty();
                                $('select[name="jabatan_id"]').append('<option value="">-- Select Jabatan--</option>');
                                $.each(data,function(key, value) {
                                    $('select[name="jabatan_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }, 'json');
                        } else {
                            $('select[name="jabatan_id"]').empty();
                        }
                    });
                });
        </script>
    @endsection     
@endsection