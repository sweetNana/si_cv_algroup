@extends('main')

@section('title', 'Barang')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>List Data - <label for="">{{$barangs->nama_barang}}</label></h1>
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
    <div class="card card-default">
        <div class="card-header">
            <h5 class="card-title"><div class="text-secondary">List Data Barang <label for="">{{$barangs->nama_barang}}</label> di Perencanaan</div></h5>
            {{-- <h3 class="card-title">Fixed Header Table</h3> --}}
            <div class="card-tools">
                <a href="{{ url('staf/barang') }}" class="btn bg-gradient-secondary">
                    <i class="fas fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table2" class="table table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <th>#</th>
                        <th>Kode Perencanaan</th>
                        <th>Jumlah</th>
                        <th>Perencana</th>
                        <th>Tgl Perencana</th>
                        <th>Judul Perencanaan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_historybarang_p as $item)
                    <tr>
                        <td>#</td>
                        <td>{{ $item->id_perencanaan }}</td>
                        <td>{{ $item->jumlah_p }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->tgl_perencanaan }}</td>
                        <td>{{ $item->judul_perencanaan }}</td>
                        <td class="text-center font-italic">
                            @if($item->status_perencana =='1')
                                <label for="">diAjukan</label> 
                            @elseif($item->status_perencana =='2')
                                <label for="">diTerima</label> 
                            @else
                                <label for="">diTolak</label>         
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
