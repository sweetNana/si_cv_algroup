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
            <h3 class="card-title"><i class="nav-icon fas fa-file-alt"></i> - Data Pengajuan</h3>

            <div class="card-tools">
                <a href="{{ url('staf/staf_pengajuan/'. $roles) }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-bordered table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>Id Pengajuan</td>
                        <td>Judul</td>
                        <td>Tgl Pengajuan</td>
                        <td>Nama Pengaju</td>
                        <td style="width: 16%">Status</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans_datas as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->id_pengajuan}}</td>
                        <td>{{$item->judul}}</td>
                        <td>{{$item->tgl_pengajuan}}</td>
                        <td>{{$item->name}}</td>
                        <td class="text-center">
                            @if($item->status_pengajuan =='1')
                                <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-exclamation-circle fa-lg"></i> Belum diProcess</button>
                            @elseif($item->status_pengajuan =='2')
                                <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt fa-lg"></i> diProcess</button>
                            @elseif($item->status_pengajuan =='3')
                                <a href="{{ url('staf/staf_pengajuan/approval/' .$item->id_pengajuan) }}" class="btn btn-success btn-sm"><i class="fas fa-check-circle fa-lg"></i> diTerima</a>
                            @else
                                <a href="{{ url('staf/staf_pengajuan/approval/' .$item->id_pengajuan) }}" class="btn btn-danger btn-sm"><i class="fas fa-times-circle fa-lg"></i> diTolak</a>        
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