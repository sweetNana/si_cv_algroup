@extends('main')

@section('title', 'Perencanaan')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Laporan Perencanaan</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perencanaan</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{-- <a href="{{ url('staf/laporan/brgmasuk/brgmasuk_excel') }}" class="btn btn-outline-secondary" title="Cetak Data Barang Masuk" target="_blank">
                <i class="fas fa-print"></i> Excel
            </a> --}}
            <form action="{{url('staf/laporan/perencanaan/perencanaan_aksi')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <!-- Date range -->
                        <div class="form-group">
                            {{-- <label>Date range:</label> --}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right @error('periode') is-invalid @enderror" id="reservation" name="periode" placeholder="Cari Tanggal . . .">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-info" name="action" value="cari" onclick="return confirm('Apakah Data Akan diCari ?')"><i class="fas fa-search"></i> Cari</button>
                                </span>
                                @error('periode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="text" class="form-control float-right" id="date_p" value="{{ $datecari }}" hidden>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    {{-- <div class="col-4"></div> --}}
                    <div class="col-8">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" class="btn btn-success" name="action" value="refresh" onclick="return confirm('Apakah Data Akan diRefresh ?')">
                              <i class="fas fa-sync-alt"></i>
                              <span>Refresh</span>
                            </button>
                            <button type="submit" class="btn btn-secondary" name="action" value="convert" onclick="return confirm('Apakah Data Akan diConvert ?')">
                              <i class="fas fa-file-export"></i>
                              <span>Convert</span>
                            </button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <div class="card-body table-responsive p-0" style="height: 400px;">
            <table id="" class="table table-striped table-head-fixed text-nowrap">
                <thead>
                    <tr class="font-weight-bold">
                        <th>#</th>
                        <th>Kode Perencanaan</th>
                        <th>Perencana</th>
                        <th>Tgl Perencanaan</th>
                        <th>Judul Perencanaan</th>
                        <th>Status</th>
                        <th style="width: 10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perencanaans_datas as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_perencanaan}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->tgl_perencanaan}}</td>
                        <td>{{$item->judul_perencanaan}}</td>
                        <td class="text-center">
                            @if($item->status_perencana =='1')
                                <button type="button" class="btn btn-info btn-sm"><i class="fas fa-paper-plane"></i> diAjukan</button>
                            @elseif($item->status_perencana =='2')
                                <button type="button" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> diTerima</button>
                            @else
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i> diTolak</button>        
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('staf/laporan/perencanaan/cek_file_laporan/' .$item->id_perencanaan ) }}" class="btn btn-warning btn-sm" title="Cek Detail Data">
                                <i class="fas fa-file fa-lg"></i>
                            </a> | 
                            <a href="{{ url('staf/perencanaan/cek_file/' .$item->id_perencanaan ) }}" class="btn btn-secondary btn-sm" title="Cek File" target="_blank">
                                <i class="far fa-file-alt fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(function () {
        $("#bootstrap-data-table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

        $("#bootstrap-data-table2").DataTable();

        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })
        var datecari = $('#date_p').val();
        $('#reservation').val(datecari);
    });
</script>

@endsection
