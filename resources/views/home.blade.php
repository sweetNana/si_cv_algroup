@extends('main')

@section('title', 'Dashboard')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Welcome - {{ Auth::user()->name }}</h3>
            <div class="card-tools">
              {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </button> --}}
            </div>
          </div>
          <form id="quickForm">
            <div class="card-body">
              <!-- Small boxes (Stat box) -->
              {{-- <div class="row">

                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                      <span class="info-box-icon bg-success"><i class="fas fa-paper-plane"></i></span>
        
                      <div class="info-box-content">
                        <div class="ribbon-wrapper">
                          <div class="ribbon bg-success">
                            -
                          </div>
                        </div>
                        <span class="info-box-text">Perencanaan</span>
                        <span class="info-box-number">{{$perencanaans}}</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                      <span class="info-box-icon bg-info"><i class="fas fa-archive"></i></span>
        
                      <div class="info-box-content">
                        <div class="ribbon-wrapper">
                          <div class="ribbon bg-info">
                            -
                          </div>
                        </div>
                        <span class="info-box-text">Barang</span>
                        <span class="info-box-number">{{$barangs}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                      <span class="info-box-icon bg-danger"><i class="fas fa-truck"></i></span>
        
                      <div class="info-box-content">
                        <div class="ribbon-wrapper">
                          <div class="ribbon bg-danger">
                            -
                          </div>
                        </div>
                        <span class="info-box-text">Supplier</span>
                        <span class="info-box-number">{{$suppliers}}</span>
                      </div>
                    </div>
                  </div>
                  
              </div> --}}

              <!-- Small Box (Stat card) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small card -->
                  <div class="small-box bg-gradient-info">
                    <div class="inner">
                      <h3>{{$perencanaans}}</h3>

                      <h5>Perencanaan</h5>
                    </div>
                    <div class="icon">
                      <i class="fas fa-paper-plane"></i>
                    </div>
                    <a href="{{url('staf/perencanaan')}}" class="small-box-footer">
                      Data Perencanaan <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small card -->
                  <div class="small-box bg-gradient-success">
                    <div class="inner">
                      <h3>{{$barangs}}</h3>

                      <h5>Barang</h5>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('staf/barang')}}" class="small-box-footer">
                      Data Barang <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small card -->
                  <div class="small-box bg-gradient-warning">
                    <div class="inner">
                      <h3>{{$suppliers}}</h3>

                      <h5>Supplier</h5>
                    </div>
                    <div class="icon">
                      <i class="fas fa-truck"></i>
                    </div>
                    <a href="{{url('staf/supplier')}}" class="small-box-footer">
                      Data Supplier <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- ./col -->

              </div>
              <!-- /.row -->

              <!-- Profile Image -->
            
          </form>
        </div>
      </div>
    </div>
  </div>
    
@endsection