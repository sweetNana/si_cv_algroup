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

    <div class="card card-default">
        
        <div class="card-header">
            <a href="{{ url('staf/perencanaan/add') }}" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Tambah Data
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
                        <td>Kode Perencanaan</td>
                        <td>Perencana</td>
                        <td>Tgl Perencanaan</td>
                        <td>Judul Perencanaan</td>
                        <td>Status</td>
                        <td style="width: 15%" class="text-center">Aksi</td>
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
                            {{-- @if($item->status_perencana =='1')
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-exclamation-circle"></i> Belum diAjukan</button> --}}
                            @if($item->status_perencana =='1')
                                <button type="button" class="btn btn-info btn-sm"><i class="fas fa-paper-plane"></i> diAjukan</button>
                            @elseif($item->status_perencana =='2')
                                <button type="button" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> diTerima</button>
                            @else
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i> diTolak</button>        
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ url('staf/perencanaan/cek_brg/' .$item->id_perencanaan ) }}" class="btn btn-success btn-sm" title="Cek Informasi Perencanaan">
                                <i class="far fa-file-archive fa-lg"></i>
                            </a> | 
                            <a href="{{ url('staf/perencanaan/cek_file/' .$item->id_perencanaan ) }}" class="btn btn-secondary btn-sm" title="Cek File" target="_blank">
                                <i class="far fa-file-alt fa-lg"></i>
                            </a> |
                            {{-- <a href="{{ url('staf/perencanaan/cek_file/' .$item->id_perencanaan ) }}" class="btn btn-danger btn-sm" title="Delete Data" target="_blank">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </a> --}}
                            @if($item->status_perencana =='2' || $item->status_perencana =='3')
                                <button class="btn btn-secondary btn-sm" title="Hapus Data Perencanaan" disabled>
                                    <i class="fa fa-trash"></i>
                                </button>
                            @else
                                <form action="{{ url('staf/perencanaan/delete/' .$item->id_perencanaan. '/' .$item->file_perencana ) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data Perencanaan <?=$item->id_perencanaan?> ? ')">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>        
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