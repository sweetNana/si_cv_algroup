@extends('main')

@section('title', 'History')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>History</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">History</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-history"></i> - Data History</h3>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table2" class="table table-bordered table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>Id Pengajuan</td>
                        <td>Tanggal Pengajuan</td>
                        <td>Judul Pengajuan</td>
                        <td>User Pengaju</td>
                        <td>Tanggal Balasan</td>
                        {{-- <td>User Penyetuju</td> --}}
                        <td style="width: 12%">Status</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans_datas as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->h_id_pengajuan}}</td>
                        <td>{{$item->h_tgl_pengajuan}}</td>
                        <td>{{$item->h_judul_pengajuan}}</td>
                        <td>{{$item->name}} - {{$item->role}}</td>
                        <td>{{$item->h_tgl_setuju}}</td>
                        {{-- <td>{{$item->name}}</td> --}}
                        <td class="text-center">
                            @if($item->h_status_pengajuan =='1')
                                <button type="button" class="btn btn-info btn-sm"><i class="fas fa-paper-plane fa-lg"></i> diAjukan</button>
                            @elseif($item->h_status_pengajuan =='2')
                                <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt fa-lg"></i> diProcess</button>
                            @elseif($item->h_status_pengajuan =='3')
                                <button type="button" class="btn btn-success btn-sm"><i class="fas fa-check-circle fa-lg"></i> diTerima</button>
                            @else
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times-circle fa-lg"></i> diTolak</button>        
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
        "buttons": ["csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

      $("#bootstrap-data-table2").DataTable();
    });
</script>

@endsection