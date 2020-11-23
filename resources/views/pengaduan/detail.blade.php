@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <form  action="" method="" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-light">
                        <h4>Detail Pengaduan</h4>
                    </div>
                    <div class="card-body row justify-content-center mb-4">
                      <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><strong>Nama Perusahaan</strong></td>
                            <td>{{$detail->klien->nama_perusahaan}} </td>
                        </tr>
                        <tr>
                            <td><strong>Nama Operator</strong></td>
                            <td>{{$detail->klien->operator->nama_operator}} </td>
                        </tr>
                        <tr>
                            <td><strong>No Telpon</strong></td>
                            <td>{{$detail->klien->no_telpon}} </td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{$detail->klien->email}} </td>
                        </tr>
                        <tr>
                            <td><strong>Aplikasi</strong></td>
                            <td>{{$detail->aplikasi->nama_aplikasi}} </td>
                        </tr>
                        <tr>
                            <td><strong> Modul Aplikasi</strong></td>
                            <td>{{$detail->modul->nama_modul}} </td>
                        </tr>
                        <br>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td>
                                <div class="chocolat-parent">
                                        <a href="{{asset('images/pengaduan/' . $detail->image)}}" class="chocolat-image" title="Just an example">
                                           <div data-crop-image="">
                                             <img alt="image" src="{{asset('images/pengaduan/' . $detail->image)}}" class="img-fluid" style="height: 100px;">
                                            </div>
                                        </a>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Keretangan</strong></td>
                            <td>{!!$detail->keterangan!!} </td>
                        </tr>
                        <tr>
                            <td><strong>Status Pengaduan</strong></td>
                            <td>{{$detail->status->nama_status}} </td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Pengaduan</strong></td>
                            <td>{{Carbon\Carbon::parse($detail->created_at)->format('d M Y H:i:s')}} </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </form>
        </div>
         @if($detail->status_id == 4)
             <div class="col-12 col-md-6 col-lg-6">
                <form  action="" method="" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4>Tanggapan Penyelesaian</h4>
                        </div>
                        <div class="card-body row justify-content-center mb-4">
                          <table class="table table-striped">
                            <tbody>
                            <br>
                            <tr>
                                <td><strong>Image Noted</strong></td>
                                <td>
                                    <div class="chocolat-parent">
                                            <a href="{{asset('images/pengaduan/' . $detail->image_noted)}}" class="chocolat-image" title="Just an example">
                                               <div data-crop-image="">
                                                 <img alt="image" src="{{asset('images/pengaduan/' . $detail->image_noted)}}" class="img-fluid" style="height: 100px;">
                                                </div>
                                            </a>
                                        </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Catatan Penyelesaian</strong></td>
                                <td>{!!$detail->noted!!} </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Penyelesaian</strong></td>
                                <td>{{Carbon\Carbon::parse($detail->updated_at)->format('d M Y H:i:s')}} </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </form>
             </div>
         @endif
    </div>    
@endsection