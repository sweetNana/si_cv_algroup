@extends('main')

@section('title', 'Chat')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Chat</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chat</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-comments"></i> - Pesan</h3>
        </div> --}}
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header card-outline card-primary">
                            <h3 class="card-title"><i class="nav-icon fas fa-comments"></i> - Pesan</h3>
                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                @foreach ($datas as $item)
                                @if($item->role != auth()->user()->role)
                                    <li class="nav-item">
                                        <a href="{{ url('staf/chat/chat/' .auth()->user()->id. '/' .$item->id) }}" class="nav-link">
                                            <i class="fas fa-user"></i> - <b>{{$item->name}} - {{$item->role}}
                                            </b>
                                            <span class="badge bg-primary float-right">
                                                @foreach ($belum_bacas as $items)
                                                    @if($items->c_user_id == $item->id and $items->c_user_to == auth()->user()->id)
                                                        {{$items->belumbaca}}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-8">
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-body">
                          <div class="direct-chat-messages text-center">
                            <i class="fab fa-facebook-messenger fa-8x text-secondary"></i><br>
                            <label for="" class="text-secondary">Pilih Pesan yang akan dibuka atau dibalas !</label> 
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.yang atas div row -->
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
