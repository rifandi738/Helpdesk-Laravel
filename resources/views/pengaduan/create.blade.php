@extends('layouts.home')
@section('content')
 <div class="row">
        <div class="col-12 col-md-4 col-lg-8">
            <form  action="{{route('postStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->level_id == 4)
                            <div class="form-group">
                                <input type="hidden" name="klien_id" value="{{auth()->user()->klien->id}}">
                                <input type="hidden" name="status_id" value="1">
                                
                                <label>Nama Klien</label>
                                    <input type="text" name="nama_perusahaan" value="{{auth()->user()->klien->nama_perusahaan}}" disabled="disabled" class="form-control">
                            </div>
                        @elseif(Auth::user()->level_id == 1)
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                    <select name="klien_id" id="klien_id" class="form-control ">
                                        @foreach ($klien as $item)
                                            <option value="{{$item->id}}" {{old('klien_id')=="$item->nama_perusahaan" ? 'selected': ''}}>{{$item->nama_perusahaan}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    @error('klien_id')
                                        <span class="badge badge-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        @elseif(Auth::user()->level_id == 2)
                           <div class="form-group">
                                <label>Nama Perusahaan</label>
                                    <select name="klien_id" id="klien_id" class="form-control ">
                                        @foreach ($klien as $item)
                                            <option value="{{$item->id}}" {{old('klien_id')=="$item->nama_perusahaan" ? 'selected': ''}}>{{$item->nama_perusahaan}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    @error('klien_id')
                                        <span class="badge badge-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        @endif
                         <div class="form-group">
                            <label>Tanggal Pengaduan</label>
                            <input type="date"  name="tanggal_pengaduan"class="form-control 
                            @error('tanggal_pengaduan') is-invalid @enderror" value="{{old('tanggal_pengaduan')}}">
                            <br>
                            @error('tanggal_pengaduan')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                       <div class="form-group">
                            <label>Capture</label>
                            <input type="file"  name="image"class="form-control 
                            @error('image') is-invalid @enderror" value="{{old('image')}}">
                            <br>
                            @error('image')
                                    <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-group">
                            <label>Aplikasi</label>
                                <select name="aplikasi_id" id="aplikasi_id" class="form-control ">
                                <option value="">-- Select Aplikasi --</option>
                                    @foreach ($aplikasi as $item)
                                    <option value="{{$item->id}}">{{ucfirst($item->nama_aplikasi)}}</option>
                                    @endforeach
                                </select>
                                <br>
                                @error('aplikasi')
                                    <span class="badge badge-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Modul Aplikasi</label>
                                <select name="modul_aplikasi_id" id="modul" class="form-control ">
                                </select>
                                <br>
                        </div>
                        @if (Auth::user()->level_id == 1)
                            <div class="form-group">
                                <label>Status</label>
                                    <select name="status_id" id="status_id" class="form-control ">
                                        @foreach ($status as $item)
                                            <option value="{{$item->id}}" {{old('status_id')=="$item->nama_status" ? 'selected': ''}}>{{$item->nama_status}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    @error('status_id')
                                        <span class="badge badge-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        @elseif(Auth::user()->level_id == 2)
                            <div class="form-group">
                                <label>Status</label>
                                    <select name="status_id" id="status_id" class="form-control ">
                                        @foreach ($status as $item)
                                            <option value="{{$item->id}}" {{old('status_id')=="$item->nama_status" ? 'selected': ''}}>{{$item->nama_status}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    @error('status_id')
                                        <span class="badge badge-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        @endif
                          <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="">{{old('keterangan')}}</textarea>
                            <br>
                            @error('keterangan')
                                <div class="badge badge-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

