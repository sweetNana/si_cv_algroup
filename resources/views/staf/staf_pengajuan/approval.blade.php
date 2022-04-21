@extends('main')

@section('title', 'Approvement')

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
    @if($data_diris->status_pengajuan == 3)
        <div class="alert text-center" role="alert" style="color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb;">
            <i class="fas fa-check-square fa-lg"></i> <strong>Pengajuan diTerima</strong>

            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span>
            </button>
        </div>
    @else
        <div class="alert text-center" role="alert" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <i class="fas fa-window-close fa-lg"></i> <strong>Pengajuan diTolak</strong>

            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span>
            </button>
        </div>
    @endif
    

    <div class="card card-primary card-outline">
        
        <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-file-alt"></i> - Data Pengajuan</h3>
        </div>
        <div class="card-body">
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Data: </h5>
                <table class="table table-striped">
                    <thead>
                        <tr class="font-weight-bold">
                            <td>#</td>
                            <td>Id Barang</td>
                            <td>Barang</td>
                            <td>Jumlah</td>
                            <td>File Pengajuan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pengajuans as $item)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$item->id_barang}}</td>
                            <td>{{$item->nama_barang}}</td>
                            <td>{{$item->jumlah}}</td>
                            <td>{{$item->file_pengajuan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> AdminINV 
                      <small class="float-right text-md">Tanggal Pengajuan: <strong>{{$data_diris->tgl_pengajuan}}</strong></small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-6">
                        <p class="lead">Informasi Pengajuan</p>

                        <div class="table-responsive">
                            <table class="table">
                            <tr>
                                <th style="width:30%">Judul</th>
                                <td>{{$data_diris->judul}}</td>
                            </tr>
                            <tr>
                                <th>Id Pengajuan</th>
                                <td>{{$data_diris->id_pengajuan}}</td>
                            </tr>
                            <tr>
                                <th>Nama Pengaju</th>
                                <td>{{$data_diris->name}}</td>
                            </tr>
                            {{-- <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>{{$data_diris->tgl_pengajuan}}</td>
                            </tr> --}}
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        @if($data_diris->status_pengajuan == 3)
                            <label for="">Alasan diSetujui</label>
                        @else
                            <label for="">Alasan diTolak</label>
                        @endif
                        <textarea name="keterangan" class="form-control" value="{{ old('keterangan') }}" rows="3" readonly>{{$data_diris->keterangan}}</textarea><br>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url('staf/staf_pengajuan/staf_cek_file/' .$data_diris->id_pengajuan ) }}" class="btn btn-primary btnsave btn-block" target="_blank"><i class="far fa-file-alt fa-lg"></i> Cek File Pengajuan</a>
                            </div>
                            @if($data_diris->status_pengajuan == 3)
                                <div class="col-md-6">
                                    <a href="{{ url('staf/staf_pengajuan/staf_cek_file_balasan/' .$data_diris->id_pengajuan ) }}" class="btn btn-success btnsave btn-block" target="_blank"><i class="fas fa-file-contract fa-lg"></i> Cek File Balasan</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    
@endsection
