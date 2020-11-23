@extends('layouts.home')
@section('content')
      @if (Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
           <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-danger">
                  <i class="fas fa-sticky-note"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Open Ticket</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$openticket}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-warning">
                  <i class="far fa-clock"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Wait</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$wait}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                  <i class="fas fa-sync-alt"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Proses</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$proses}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-success">
                  <i class="fas fa-check"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Close</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$close}}</h4>
                  </div>
               </div>
              </div>
            </div>
          </div>
      @elseif(Auth::user()->level_id == 4)
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-danger">
                  <i class="fas fa-sticky-note"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Wait</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$openticket}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-warning">
                  <i class="far fa-clock"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Approve</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$wait}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                  <i class="fas fa-sync-alt"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Proses</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$proses}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-success">
                  <i class="fas fa-check"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Close</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$close}}</h4>
                  </div>
               </div>
              </div>
            </div>
       @elseif(Auth::user()->level_id == 3)
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-warning">
                  <i class="far fa-clock"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Wait</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$wait}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-primary">
                  <i class="fas fa-sync-alt"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Proses</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$proses}}</h4>
                  </div>
               </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-1">
               <div class="card-icon bg-success">
                  <i class="fas fa-check"></i>
               </div>
               <div class="card-wrap">
                  <div class="card-header">
                      <h4>Close</h4>
                  </div>
                  <div class="card-body">
                      <h4>{{$close}}</h4>
                  </div>
               </div>
              </div>
            </div>
      @endif     
@endsection
