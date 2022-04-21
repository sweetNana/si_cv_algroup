@extends('main')

@section('title', 'Barang Masuk')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Barang Masuk</h1>
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
            <h3 class="card-title"><i class="nav-icon fas fa-sign-in-alt"></i> - Data Barang Masuk</h3>
            
            <div class="card-tools">
                <a href="{{ url('staf/brg_masuk/export') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-file-alt fa-lg"></i> Export
                </a> |
                <a href="{{ url('staf/brg_masuk/add') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table2" class="table table-bordered table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>Id Brg Masuk</td>
                        <td>Id Barang</td>
                        <td>Nama Barang</td>
                        <td>Jumlah</td>
                        <td>Supplier</td>
                        <td>Tgl Masuk</td>
                        {{-- <td style="width: 10%">Action</td> --}}
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
                        {{-- <td class="text-center">
                            <a href="" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a> |
                            <form action="" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Id Barang Masuk <?=$item->id_brg_masuk?> ? ')">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td> --}}
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
    });
</script>

@endsection
