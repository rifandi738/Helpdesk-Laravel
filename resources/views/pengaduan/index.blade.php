@extends('layouts.home')
@section('title')
    Data Pengaduan
@endsection
@section('content')
   @if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
    <div class="row">
          <div class="col-12 col-md-3 col-lg-3">
            <form action="{{route('getPengaduan')}}" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-md-9">
                        <label>Search By Name</label>
                        <input type="text" class="form-control" name="keyword" value="{{Request::get('keyword')}}">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Filter</button>
                    </div>
                </div>
            </form>
        </div>
         <div class="col-12 col-md-3 col-lg-3">
            <form action="{{route('getPengaduan')}}" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-md-9">
                        <label>Seach By Status</label>
                        <input type="text" class="form-control" name="status" value="{{Request::get('status')}}">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Filter</button>
                    </div>
                </div>
            </form>
        </div>
         <div class="col-12 col-md-6 col-lg-6">
            <form action="{{route('getPengaduan')}}" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-md-5">
                        <label>Tanggal Awal</label>
                        <input type="date" id="" class="form-control" name="start_date" value="{{Request::get('start_date')}}">
                    </div>
                    <div class="col-md-5">
                        <label>Tanggal Akhir</label>
                        <input type="date" id="" class="form-control" name="end_date" value="{{Request::get('end_date')}}">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    <br>

    @if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 4)
        <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('getCreate')}}">Add Pengaduan</a>    
        </div>
    </div>
    @endif
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Klien</th>
                    <th>Aplikasi</th>
                    <th>Modul Aplikasi</th>
                    <th>Image</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach($pengaduan as $p)
                 <tr>
                    <td>{{$loop->iteration + ($pengaduan->perPage()) * ($pengaduan->currentPage() - 1)}}</td>
                    <td>{{$p->klien->nama_perusahaan}}</td>
                    <td>{{$p->aplikasi->nama_aplikasi}}</td>
                    <td>{{$p->modul->nama_modul}}</td>
                    <td><img src="{{asset('/images/pengaduan/'.$p->image)}}" width="100px"/></td>
                        <td>{!!$p->keterangan!!}</td>
                        <td>
                             @if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
                                @switch($p->status->id)
                                    @case(1)
                                        <a href="/pengaduan/{{$p->id}}/responStatus"><span class="badge badge-danger">{{$p->status->nama_status}}</span></a>
                                        @break
                                    @case(2)
                                        <a href="/pengaduan/{{$p->id}}/responStatus"><span class="badge badge-warning">{{$p->status->nama_status}}</span></a>
                                        @break
                                    @case(3)
                                        <a href="/pengaduan/{{$p->id}}/responStatus"><span class="badge badge-primary">{{$p->status->nama_status}}</span></a>
                                        @break
                                    @case(4)
                                        <span class="badge badge-success">{{$p->status->nama_status}}</span>
                                        @break                                        
                                @endswitch
                             @elseif(Auth::user()->level_id == 3)
                                @switch($p->status->id)
                                    @case(1)
                                        <span class="badge badge-danger"></span>
                                        @break
                                    @case(2)
                                        <a href="/pengaduan/{{$p->id}}/responStatus"><span class="badge badge-warning">{{$p->status->nama_status}}</span></a>
                                        @break
                                    @case(3)
                                        <a href="/pengaduan/{{$p->id}}/responStatus"><span class="badge badge-primary">{{$p->status->nama_status}}</span></a>
                                        @break
                                    @case(4)
                                        <span class="badge badge-success">{{$p->status->nama_status}}</span>
                                        @break                                        
                                @endswitch
                             @elseif(Auth::user()->level_id == 4)
                                @switch($p->status->id)
                                    @case(1)
                                        <span class="badge badge-warning">Wait</span>
                                        @break
                                    @case(2)
                                        <span class="badge badge-warning">Approve</span>
                                        @break
                                    @case(3)
                                        <span class="badge badge-primary">{{$p->status->nama_status}}</span>
                                        @break
                                    @case(4)
                                        <span class="badge badge-success">{{($p->status->nama_status)}}</span>
                                        @break                                        
                                @endswitch
                            @endif
                        </td>
                        {{-- <td>{{$pdg->created_at->format('d M Y')}}</td> --}}
                        @if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
                            <td>
                                <form action="{{route('pengaduan.destroy',[$p->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}

                                    <a href="{{ route('showDetail',[$p->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-info"></i>
                                    </a>

                                    <a href="{{route('pengaduan.editPengaduan',[$p->id])}}" class="btn btn-sm btn-warning ion-edit">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </form>
                            </td>
                        @elseif(Auth::user()->level_id == 3)
                            <td>
                                <a href="{{ route('showDetail',[$p->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>

                                 @if($p->status_id == 3)

                                    <a href="{{route('pengaduan.editPengaduan',[$p->id])}}" class="btn btn-sm btn-warning ion-edit" style="height:30px;"><i class="far fa-edit"></i></a>

                                 @endif
                            </td>
                        @elseif(Auth::user()->level_id == 4)
                            <td>                           
                                @if($p->status_id == 1)
                                    <a href="{{route('pengaduan.editPengaduan',[$p->id])}}" class="btn btn-sm btn-warning ion-edit" style="height:30px;"><i class="far fa-edit"></i></a>
                                @elseif($p->status_id == 4)
                                    <a href="{{ route('showDetail',[$p->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-info"></i>
                                    </a>
                                @endif
                            </td>
                        @endif
                 </tr>
                @endforeach
            </tbody>
        </table>
         <div class="box-footer">
            {{$pengaduan->links()}}
        </div>
    </div>
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() {
            location.reload();
        }, 10000);
    })
</script> -->