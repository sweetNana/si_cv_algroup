@extends('main')

@section('title', 'User')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Data User</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
            <a href="{{ url('staf/user/add') }}" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Tambah User
            </a>
            {{-- <h3 class="card-title"><i class="nav-icon fas fa-users"></i> - Data User</h3> --}}

            <div class="card-tools">
                {{-- <a href="{{ url('staf/user/add') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> Tambah User
                </a> --}}
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
                        <td>Nama User</td>
                        <td>Email</td>
                        <td>Jabatan</td>
                        <td style="width: 10%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email }}</td>
                        <td>{{$item->role}}</td>
                        <td class="text-center">
                            {{-- <a href="{{ url('staf/user/edit/' .$item->id ) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a> | --}}
                            @if($item->id == Auth::user()->id)
                                <button class="btn btn-secondary btn-sm" title="Delete" disabled>
                                    <i class="fa fa-trash"></i>
                                </button>
                            @else      
                                <form action="{{ url('staf/user/delete/' .$item->id ) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus User <?=$item->name?> : <?=$item->role?> ? ')">
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