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
                                    <i class="fas fa-user"></i> - <b>{{$item->name}} - {{ $item->role }}
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
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-primary">
                  {{-- <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div> --}}
                  
                  <!-- START CHAT /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">

                      @foreach ($chatss as $item)
                        <?php 
                          $className = $item->c_user_id == Auth::user()->id ? 'float-right' : 'float-left'; 
                          $classDate = $item->c_user_id == Auth::user()->id ? 'float-left' : 'float-right';
                          $classHead = $item->c_user_id == Auth::user()->id ? 'right' : '';
                        ?>
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg <?php echo $classHead; ?>">
                          <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name <?php echo $className; ?>">
                              @if($item->c_user_id == Auth::user()->id)
                                Saya
                              @else
                                {{$item->name}}
                              @endif
                            </span>
                            <span class="direct-chat-timestamp <?php echo $classDate; ?>">{{$item->created_at}}</span>
                          </div>
                          <div class="direct-chat-text">
                            {{$item->c_isi}}
                          </div>
                        </div>
                        <!-- /.direct-chat-msg -->
                      @endforeach
                    </div>
                  </div>
                  <!-- END CHAT /.card-body -->

                  <div class="card-footer">
                    <form action="{{url('staf/chat/addChat/' .$id_to. '/' .$id_from)}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="input-group">
                        <input type="text" class="form-control" name="c_user_id" readonly value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" name="c_user_to" readonly value="{{ $id_to }}" hidden>
                        <input type="text" name="message" placeholder="Ketik Pesan ..." class="form-control p_isi @error('message') is-invalid @enderror" value="{{ old('message') }}">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-success btnKirim" disabled>Kirim</button>
                        </span>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
              </div>
              <!--/.direct-chat -->
              </div>
            </div>
            

        </div>
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(function () {
      $(".p_isi").focus();
      $("#bootstrap-data-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

      $("#bootstrap-data-table2").DataTable();

      $(".p_isi").keyup(function(){
        var inputans = $(".p_isi").val();
        if(inputans == ""){
            $('.btnKirim').prop('disabled', true);
        }else{
            $('.btnKirim').prop('disabled', false);
        }
      });
    });
</script>

@endsection
