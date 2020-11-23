@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="{{route('pegawai.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text"  name="nama_pegawai"class="form-control
                             @error('nama_pegawai') is-invalid @enderror" value="{{old('nama_pegawai')}}">
                            <br>
                            @error('nama_pegawai')
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
                            <label>No Handphone</label>
                            <input type="text"  name="no_handphone"class="form-control 
                            @error('no_handphone') is-invalid @enderror" value="{{old('no_handphone')}}">
                            <br>
                            @error('no_handphone')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                         <div class="form-group">
                            <label>Divisi</label>
                                <select name="divisi_id" id="divisi_id" class="form-control ">
                                <option value="">-- Select Divisi --</option>
                                    @foreach ($divisi as $item)
                                    <option value="{{$item->id}}">{{ucfirst($item->nama_divisi)}}</option>
                                    @endforeach
                                </select>
                                <br>
                                @error('divisi')
                                    <span class="badge badge-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                                <select name="jabatan_id" id="jabatan" class="form-control ">
                                </select>
                                <br>
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