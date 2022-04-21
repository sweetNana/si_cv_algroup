@extends('main')

@section('title', 'Perencanaan')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Perencanaan</h1>
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
            <h3 class="card-title"><i class="nav-icon fas fa-file-alt"></i> - Data Perencanaan</h3>

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
                        <td>Id Perencanaan</td>
                        <td>Tgl Perencanaan</td>
                        <td>Nama Perencana</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perencanaans_datas as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_perencanaan}}</td>
                        <td>{{$item->tgl_perencanaan}}</td>
                        <td>{{$item->name}}</td>
                        <td class="text-center">
                            @if($item->status_perencana =='1')
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-exclamation-circle"></i> Belum diAjukan</button>
                            @elseif($item->status_perencana =='2')
                                <button type="button" class="btn btn-info btn-sm"><i class="fas fa-paper-plane"></i> diAjukan</button>
                            @elseif($item->status_perencana =='3')
                                <button type="button" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> diTerima</button>
                            @else
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i> diTolak</button>        
                            @endif
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
        "buttons": ["excel", "pdf"]
      }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

      $("#bootstrap-data-table2").DataTable();
    });
</script>

@endsection