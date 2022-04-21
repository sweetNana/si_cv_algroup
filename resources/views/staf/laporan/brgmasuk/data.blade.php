@extends('main')

@section('title', 'Barang Masuk')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Laporan Barang Masuk</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Barang Masuk</li>
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
            <form action="{{url('staf/laporan/brgmasuk/brgmasuk_aksi')}}" method="post" enctype="multipart/form-data">
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
                        <td>#</td>
                        <td>Kode Brg Masuk</td>
                        <td>Kode Barang</td>
                        <td>Nama Barang</td>
                        <td>Jumlah</td>
                        <td>Supplier</td>
                        <td>Tgl Masuk</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brg_masuks as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_brg_masuk}}</td>
                        <td>{{$item->id_barang}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->jumlah}}</td>
                        <td>{{$item->nama_supplier}}</td>
                        <td>{{$item->tgl_brg_masuk}}</td>
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
