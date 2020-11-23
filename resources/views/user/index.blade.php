@extends('layouts.home')
@section('title')
    Data User
@endsection
@section('content')
    <form action="{{route('user.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Klien" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('user.create')}}">Add User</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th style="width:10px">No</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <?php 
              $i =1;
            ?>
            <tbody>
                @foreach($user as $usr)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$usr->username}}</td>
                    <td>{{$usr->level->level}}</td>
                     <td>
                      <a href="{{route('user.edit',[$usr->id])}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                      <a href="#" class="btn btn-sm btn-danger swal-confirm" data-id="{{$usr->id}}"><i class="fas fa-trash-alt"></i></a>
                       <form action="{{route('user.destroy',[$usr->id])}}" id="DELETE{{$usr->id}}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        </form>
                    </td>
                  </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Yakin?',
            text: "Apakah Anda Ingin Menghapus Data User Dengan Id " +id+ " ?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
            // swal("Data Dengan Id " +id+ " Berhasil Dihapus", {
            //     icon: 'success',
            // });
                $(`#DELETE${id}`).submit();
            } else {
        }
    });
});
</script>
@endsection
