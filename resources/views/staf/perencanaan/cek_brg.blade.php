@extends('main')

@section('title', 'Perencanaan')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Informasi Perencanaan</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Informasi Perencanaan</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">

    <div class="card card-default">
        
        <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-file-alt"></i> - Data Perencanaan</h3>

            <div class="card-tools">
                <a href="{{ url('staf/perencanaan') }}" class="btn bg-gradient-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                        <strong class="text-secondary">{{$data_diris->id_perencanaan}}</strong>
                        <div class="float-right text-lg">
                            {{-- <h3> --}}
                                @if($data_diris->status_perencana == 2)
                                    <div class="btn" role="alert" style="color: #0f5132; background-color: #d1e7dd; border-color: #badbcc;">
                                        <i class="fas fa-check-circle fa-lg"></i> Perencanaan diTerima
                                    </div>
                                @elseif($data_diris->status_perencana == 3)
                                    <div class="btn" role="alert" style="color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">
                                        <i class="fas fa-times-circle fa-lg"></i> Perencanaan diTolak
                                    </div>
                                @else
                                    <div class="btn" role="alert" style="color: #004085; background-color: #cce5ff; border-color: #b8daff;">
                                        <i class="fas fa-paper-plane fa-lg"></i> Perencanaan diAjukan
                                    </div>
                                @endif
                            {{-- </h3> --}}
                        </div>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <h4><strong class="text-secondary">{{$data_diris->judul_perencanaan}}</strong></h4>
                <div class="row">
                    <div class="col-8 border-right">
                        <table class="table table-striped">
                            <thead>
                                <tr class="font-weight-bold text-primary" style="border-top-style: solid; border-top-color: #007bff">
                                    <td>#</td>
                                    <td>Kode Barang</td>
                                    <td>Nama Barang</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_perancanaans as $item)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$item->id_barang}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->jumlah_p}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4 border-left">
                        <table class="table table-striped">
                            <tbody>
                                <tr style="border-top-style: solid; border-top-color: #007bff">
                                    <th>Perencana: </th>
                                    <td>{{$data_diris->name}}</td>
                                </tr>
                                <tr>
                                    <th>Tgl Perencanaan: </th>
                                    <td>{{$data_diris->tgl_perencanaan}}</td>
                                </tr>
                                <tr>
                                    <th>File Perencanaan: </th>
                                    <td>
                                        <a href="{{ url('staf/perencanaan/cek_file/' .$item->id_perencanaan ) }}" class="btn btn-secondary btn-sm" title="Cek File" target="_blank">
                                            <i class="far fa-file-alt fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-8 border-right">
                        @if($data_diris->status_perencana == 2)
                            {{-- Diterima --}}
                            <h5 class="font-weight-bold">Alasan diTerima</h5>
                            <textarea name="ket_balasan" class="form-control" value="{{ old('ket_balasan') }}" rows="2" readonly>{{$data_diris->keterangan}}</textarea>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <a href="{{ url('staf/perencanaan/cek_file_balasan/' .$item->id_perencanaan ) }}" class="btn bg-gradient-success btnsave btn-block" target="_blank"><i class="fas fa-file-contract fa-lg"></i> Cek File Balasan</a>
                                </div>
                            </div>
                        @elseif($data_diris->status_perencana == 3)
                            {{-- Ditolak --}}
                            <h5 class="font-weight-bold">Alasan diTolak</h5>
                            <textarea name="ket_balasan" class="form-control" value="{{ old('ket_balasan') }}" rows="2" readonly>{{$data_diris->keterangan}}</textarea>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <a href="{{ url('staf/perencanaan/cek_file_balasan/' .$item->id_perencanaan ) }}" class="btn bg-gradient-success btnsave btn-block" target="_blank"><i class="fas fa-file-contract fa-lg"></i> Cek File Balasan</a>
                                </div>
                            </div>
                        @else
                            {{-- Kosong Aja --}}
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    
</script>

@endsection