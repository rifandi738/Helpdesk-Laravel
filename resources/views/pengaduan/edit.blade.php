@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-4 col-lg-8">
            <form  action="{{route('pengaduan.updatePengaduan',[$pengaduan->id])}}" method="POST" enctype="multipart/form-data">
                 @csrf
                {{ method_field('PUT') }}
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->level_id == 4)
                            <div class="form-group">
                                <input type="hidden" name="klien_id" value="{{auth()->user()->klien->id}}">
                                <label>Nama Klien</label>
                                    <input type="text" name="nama_perusahaan" value="{{auth()->user()->klien->nama_perusahaan}}" disabled="disabled" class="form-control">
                            </div>
                        @elseif(Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
                            <div class="form-group">
                            <label for="aplikasi_id">Nama Klien</label>
                                <select name="klien_id" id="klien_id" class="form-control" >
                                   @foreach ($klien as $kly)
                                        <option value="{{$kly->id}}" @if($pengaduan->klien_id == $kly->id) selected @endif>
                                            {{$kly->nama_perusahaan}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('klien_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        @elseif (Auth::user()->level_id == 3)
                            <div class="form-group">
                                <input type="hidden" name="klien_id" value="{{$pengaduan->klien_id}}">
                                <label>Nama Klien</label>
                                    <input type="text" name="nama_perusahaan" value="{{$pengaduan->klien->nama_perusahaan}}" disabled="disabled" class="form-control">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="tanggal_pengaduan">Tanggal Pengaduan</label>
                            <input type="date"  name="tanggal_pengaduan" class="form-control
                             @error('tanggal_pengaduan') is-invalid @enderror" value="{{$pengaduan->tanggal_pengaduan}}">
                            <br>
                            @error('tanggal_pengaduan')
                                <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label>Capture</label>
                            <br>
                            <img src="{{asset('images/pengaduan/'. $pengaduan->image)}}" alt="" class="img-thumbnail" width="100px" height="100px">
                            <br>
                            <br>
                            <input type="file"  name="image"class="form-control 
                            @error('image') is-invalid @enderror" value="{{$pengaduan->image}}">
                            <br>
                            @error('image')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label for="aplikasi_id">Aplikasi</label>
                                <select name="aplikasi_id" id="aplikasi_id" class="form-control" >
                                   @foreach ($aplikasi as $apk)
                                        <option value="{{$apk->id}}" @if($pengaduan->aplikasi_id == $apk->id) selected @endif>
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
                            <label for="modul_aplikasi_id">Modul Aplikasi</label>
                                <select name="modul_aplikasi_id" id="modul_aplikasi_id" class="form-control" >
                                     @foreach ($modul as $mdl)
                                        <option value="{{$mdl->id}}" @if($pengaduan->modul_aplikasi_id == $mdl->id) selected @endif>
                                            {{$mdl->nama_modul}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('modul_aplikasi_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        @if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
                            <div class="form-group">
                            <label for="status_id">Status</label>
                                <select name="status_id" id="status_id" class="form-control">
                                     @foreach ($status as $sts)
                                        <option value="{{$sts->id}}" @if($pengaduan->status_id == $sts->id) selected @endif>
                                            {{$sts->nama_status}}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @error('status_id')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @elseif(Auth::user()->level_id == 4)
                             <input type="hidden" name="status_id" value="1">
                        @endif

                        @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" class="form-control" >{{old('keterangan')}} {{$pengaduan->keterangan}}</textarea>
                                <br>
                                @error('keterangan')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @elseif(Auth::user()->level_id == 3)
                           <div class="form-group">
                                <label>Image Noted</label>
                                <br>
                                <img src="{{asset('images/pengaduan/'. $pengaduan->image_noted)}}" alt="" class="img-thumbnail" width="100px" height="100px">
                                
                                <input type="file"  name="image_noted" class="form-control
                                @error('image_noted') is-invalid @enderror" value="{{$pengaduan->image_noted}}">
                                <br>
                                @error('image_noted')
                                        <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                           </div>

                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control" id="noted" name="noted" class="form-control @error('noted') is-invalid @enderror" value="">{{old('noted')}}</textarea>
                                <br>
                                @error('noted')
                                    <div class="badge badge-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        @if(Auth::user()->level_id == 3  && $pengaduan->status_id == 3)
                            <input type="hidden" name="status_id" value="4">
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="{{route('pengaduan.index')}}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
         </div>
    </div>    
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('keterangan');
    </script>

    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('noted');
    </script>
    @section('script')
        <script src="{{asset('backend/assets/modules/jquery.min.js')}}"></script>
            <script>
                $(function() {
                    $('select[name="aplikasi_id"]').on('change', function () {
                        var aplikasiID = $(this).val();

                        if (aplikasiID) {
                            $.get('/getModul/' + aplikasiID, function(data) {
                                $('select[name="modul_aplikasi_id"]').empty();
                                $('select[name="modul_aplikasi_id"]').append('<option value="">-- Select Modul--</option>');
                                $.each(data,function(key, value) {
                                    $('select[name="modul_aplikasi_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }, 'json');
                        } else {
                            $('select[name="modul_aplikasi_id"]').empty();
                        }
                    });
                });
        </script>
    @endsection
@endsection