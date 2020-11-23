<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  {{-- <title>{{asset('backend/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle')}}</title> --}}

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap-social/bootstrap-social.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/css/components.css')}}">
  <body>
    <h5 class="text-center">Laporan Pengaduan Periode </h5>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Nama Klien</th>
                    <th>Nama Operator</th>
                    <th>Aplikasi</th>
                    <th>Modul Aplikasi</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
            </thead>
            <tbody>
            @foreach($laporan as $lpr)
                     <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$lpr->tanggal_pengaduan}}</td>
                        <td>{{$lpr->klien->nama_perusahaan}}</td>
                        <td>{{$lpr->klien->operator->nama_operator}}</td>
                        <td>{{$lpr->aplikasi->nama_aplikasi}}</td>
                        <td>{{$lpr->modul->nama_modul}}</td>
                        <td>{{$lpr->status->nama_status}}</td>
                        <td>{!!$lpr->keterangan!!}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
     <script type="text/javascript">
            window.print();
        </script>
    </div>
   <!-- General JS Scripts -->
   <script src="{{asset('backend/assets/modules/jquery.min.js')}}"></script>
   <script src="{{asset('backend/assets/modules/popper.js')}}"></script>
   <script src="{{asset('backend/assets/modules/tooltip.js')}}"></script>
   <script src="{{asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
   <script src="{{asset('backend/assets/modules/moment.min.js')}}"></script>
   <script src="{{asset('backend/assets/js/stisla.js')}}"></script>

   <!-- JS Libraies -->

   <!-- Page Specific JS File -->

   <!-- Template JS File -->
   <script src="{{asset('backend/assets/js/scripts.js')}}"></script>
   <script src="{{asset('backend/assets/js/custom.js')}}"></script>
 </body>
 </html>