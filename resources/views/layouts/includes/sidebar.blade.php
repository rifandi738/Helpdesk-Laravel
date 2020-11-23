<div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="">SISTEM HELPDESK</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="">SH</a>
          </div>
          <ul class="sidebar-menu">
            @if (auth()->user()->level_id == 1)
                <li><a href="{{route('dashboard.index')}}" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                {{-- <li class=""><a class="nav-link" href="{{route('user.index')}}"><i class="fas fa-user-plus"></i> <span>Kelola User</span></a></li> --}}
                <li class=""><a class="nav-link" href="{{route('pegawai.index')}}"><i class="fas fa-address-card"></i> <span>Data Pegawai</span></a></li>
                <li class=""><a class="nav-link" href="{{route('klien.index')}}"><i class="fas fa-building"></i><span>Data Klien</span></a></li>
                <li class=""><a class="nav-link" href="{{route('pengaduan.index')}}"><i class="fas fa fa-list-alt"></i> <span>Pengaduan</span></a></li>
                <li class=""><a class="nav-link" href="{{route('aplikasi.index')}}"><i class="fas fa fa-file"></i> <span>Aplikasi</span></a></li>
                <li class=""><a class="nav-link" href="{{route('modul.index')}}"><i class="fas fa fa-file-alt"></i> <span>Modul Aplikasi</span></a></li>
                <li class=""><a class="nav-link" href="{{route('divisi.index')}}"><i class="fas fa-landmark"></i> <span>Divisi</span></a></li>
                <li class=""><a class="nav-link" href="{{route('jabatan.index')}}"><i class="fas fa-user-tie"></i> <span>Jabatan</span></a></li>
                <!-- <li class=""><a class="nav-link" href="{{route('status.index')}}"><i class="fas fa-info"></i> <span>Status</span></a></li> -->
                <li class=""><a class="nav-link" href="{{route('laporan-pengaduan')}}"><i class="fas fa-book-open"></i> <span>Laporan</span></a></li>
            @elseif(auth()->user()->level_id == 2)
                <li><a href="{{route('dashboard.index')}}" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a class="nav-link" href="{{route('klien.index')}}"><i class="fas fa-building"></i><span>Data Klien</span></a></li>
                <li class=""><a class="nav-link" href="{{route('pengaduan.index')}}"><i class="fas fa fa-list-alt"></i> <span>Pengaduan</span></a></li>
                <li class=""><a class="nav-link" href="{{route('aplikasi.index')}}"><i class="fas fa fa-file"></i> <span>Aplikasi</span></a></li>
                <li class=""><a class="nav-link" href="{{route('modul.index')}}"><i class="fas fa fa-file-alt"></i> <span>Modul Aplikasi</span></a></li>
                <li class=""><a class="nav-link" href="{{route('status.index')}}"><i class="fas fa-info"></i> <span>Status</span></a></li>
                <li class=""><a class="nav-link" href="{{route('laporan-pengaduan')}}"><i class="fas fa-book-open"></i> <span>Laporan</span></a></li>
            @elseif(auth()->user()->level_id == 3)
                <li><a href="{{route('dashboard.index')}}" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a class="nav-link" href="{{route('getPengaduan')}}"><i class="fas fa fa-list-alt"></i> <span>Pengaduan</span></a></li>
            @elseif(auth()->user()->level_id == 4)
                <li><a href="{{route('dashboard.index')}}" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a class="nav-link" href="{{route('getPengaduan')}}"><i class="fas fa fa-list-alt"></i> <span>Pengaduan</span></a></li>
                <li><a href="{{route('pengaduan-history')}}" class="active"><i class="fas fa-history"></i> <span>History Pengaduan</span></a></li>
            @endif
          </ul>
        </aside>
</div>


