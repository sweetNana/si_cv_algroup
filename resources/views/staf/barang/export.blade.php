@extends('main')

@section('title', 'Barang')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Barang</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Barang</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success" role="alert" style="color: #0f5132; background-color: #d1e7dd; border-color: #badbcc;">
        <span class="badge badge-pill badge-info">Success</span>
        {{ session('status') }}
        <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="text-danger">&times;</span>
        </button>
    </div>
    @endif

    <div class="card card-primary card-outline">
        
        <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-box"></i> - Data Barang</h3>

            <div class="card-tools">
                <a href="{{ url('staf/barang') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-bordered table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>Id Barang</td>
                        <td>Nama Barang</td>
                        {{-- <td>Kondisi</td> --}}
                        <td>Stok</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_barang}}</td>
                        <td>{{$item->nama_barang}}</td>
                        {{-- <td>{{$item->kondisi}}</td> --}}
                        <td>{{$item->stok}}</td>
                        <td>{{$item->keterangan}}</td>
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
        "buttons": ["excel", "pdf"]
      }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

      $("#bootstrap-data-table2").DataTable();
    });
</script>

@endsection
