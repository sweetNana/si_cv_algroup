@extends('main')

@section('title', 'Supplier')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Data Supplier</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
            <a href="{{ url('staf/supplier/add') }}" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
            {{-- <h3 class="card-title"><i class="nav-icon fas fa-truck"></i> - Data Supplier</h3> --}}
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
                        <td>Kode Supplier</td>
                        <td>Nama Supplier</td>
                        <td>No Handphone</td>
                        <td>Alamat</td>
                        <td style="width: 10%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_supplier}}</td>
                        <td>{{$item->nama_supplier}}</td>
                        <td>{{$item->telepon_supplier}}</td>
                        <td>{{$item->alamat_supplier}}</td>
                        <td class="text-center">
                            <a href="{{ url('staf/supplier/edit/' .$item->id_supplier ) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a> |
                            {{-- <a href="#" class="btn btn-primary btn-sm btnModalEdit" title="Edit" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-pencil-alt"></i>
                            </a> | --}}
                            <form action="{{ url('staf/supplier/delete/' .$item->id_supplier ) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Supplier <?=$item->id_supplier?> : <?=$item->nama_supplier?> ? ')">
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
            @include('staf.supplier.modaledit')
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

      var table = $("#bootstrap-data-table2").DataTable();

      // Start
      table.on('click','.btnModalEdit', function() {
          $tr = $(this).closest('tr');
          if($($tr).hasClass('child')){
              $tr = $tr.prev('.parent');
          }

          var data = table.row($tr).data();
          $("#kode_supplier").val(data[1]);
          $("#nama_supplier").val(data[2]);
          $("#no_hp").val(data[3]);
          $("#alamat").val(data[4]);

          $("#exampleModal").modal('show');
      });
      //End

    });
</script>

@endsection