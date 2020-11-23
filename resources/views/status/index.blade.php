@extends('layouts.home')
@section('title')
    Data Status
@endsection
@section('content')
    <form action="{{route('status.index')}}">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Status" name="keyword" value="{{Request::get('keyword')}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary text-white" href="{{route('status.create')}}">Add Status</a>    
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th style="width:10px">No</th>
                    <th>Nama Status</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <?php 
              $i =1;
            ?>
            <tbody>
                @foreach($status as $sts)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$sts->nama_status}}</td>
                    <td>
                        <form action="{{route('status.destroy',[$sts->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                            @csrf
                            {{ method_field('DELETE') }}

                            <a href="{{route('status.edit',[$sts->id])}}" class="btn btn-sm btn-warning ">
                                <i class="far fa-edit"></i>
                            </a>

                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </form>
                    </td>
                  </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
