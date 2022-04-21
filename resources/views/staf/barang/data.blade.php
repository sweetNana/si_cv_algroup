@extends('main')

@section('title', 'Barang')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Data Barang</h1>
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

    <div class="card card-default">
        
        <div class="card-header">
            <a href="{{ url('staf/barang/brgmasuk_data') }}" class="btn btn-outline-primary">
                <i class="fas fa-sign-in-alt"></i> Barang Masuk
            </a> | 
            <a href="{{ url('staf/barang/brgkeluar_data') }}" class="btn btn-outline-secondary">
                <i class="fas fa-sign-out-alt"></i> Barang Keluar
            </a>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table2" class="table table-bordered table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>Kode Barang</td>
                        <td>Nama Barang</td>
                        <td>Stok</td>
                        <td>Satuan</td>
                        <td class="text-center">Cek diPerencanaan</td>
                        <td style="width: 10%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_barang}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->stok}}</td>
                        <td>{{$item->satuan}}</td>
                        <td class="text-center">
                            <a href="{{ url('staf/barang/historybarang_p/' .$item->id_barang ) }}" class="btn btn-success btn-sm" title="Cek Barang di List Perencanaan">
                                <i class="fas fa-random fa-lg"></i> Cek Data
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('staf/barang/edit/' .$item->id_barang ) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a> |
                            <form action="{{ url('staf/barang/delete/' .$item->id_barang ) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Barang <?=$item->id_barang?> : <?=$item->nama_barang?> ? ')">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
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
    });
</script>

@endsection
