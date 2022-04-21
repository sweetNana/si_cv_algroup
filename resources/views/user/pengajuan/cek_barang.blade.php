@extends('main')

@section('title', 'Pengajuan')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Pengajuan</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengajuan</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Cek Barang Pengajuan</h3>
                    <div class="card-tools">
                        <a href="{{ url('user/pengajuan') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-reply"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Judul Pengajuan</label>
                            <input type="text" name="judul" class="form-control" value="{{ $juduls->judul }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Id Pengajuan</label>
                            <input type="text" name="id_pengajuan" class="form-control" value="{{ $id_pengajuan }}" readonly>
                        </div>
                        <hr style="border: 1px solid;" class="text-danger">
                        <table id="bootstrap-data-table2" class="table table-bordered table-striped">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td>#</td>
                                    <td>Barang</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuanss as $item)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->jumlah}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
      </div>
  </div>
    
@endsection
