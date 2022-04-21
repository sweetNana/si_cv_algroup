@extends('main')

@section('title', 'Periksa Perencanaan')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Data Perencanaan</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Perencanaan</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-file-alt"></i> - Data Perencanaan</h3>
            <div class="card-tools">
                <a href="{{ url('ketua/approvement') }}" class="btn bg-gradient-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($data_diris->status_perencana =='2')
                <div class="alert" role="alert" style="color: #0f5132; background-color: #d1e7dd; border-color: #badbcc;">
                    <i class="fas fa-check-circle fa-lg"></i> Perencanaan diTerima
                </div>
            @elseif($data_diris->status_perencana =='3')
                <div class="alert" role="alert" style="color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">
                    <i class="fas fa-times-circle fa-lg"></i> Perencanaan diTolak
                </div>    
            @else   
                <div class="alert" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                    <i class="fas fa-exclamation-circle fa-lg"></i> Belum diProcess
                </div> 
            @endif
            <div class="callout callout-info">
                <div class="row">
                    {{-- Sebelah Kiri [Start]--}}
                    <div class="col-md-5">
                        <h5><i class="fas fa-bullhorn"></i> - {{$data_diris->judul_perencanaan}}</h5>
                        <table class="table table-striped">
                            <tr>
                                <th>Kode Perencanaan</th>
                                <td>{{$data_diris->id_perencanaan}}</td>
                            </tr>
                            <tr>
                                <th>Perencana</th>
                                <td>{{$data_diris->name}}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Perencanaan</th>
                                <td>{{$data_diris->tgl_perencanaan}}</td>
                            </tr>
                            <tr>
                                <th>File Perencanaan</th>
                                <td>
                                    <a href="{{ url('staf/perencanaan/cek_file/' .$data_diris->id_perencanaan ) }}" class="btn bg-gradient-secondary" title="Cek File" target="_blank">
                                        <i class="far fa-file-alt text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <div class="row">
                            @if($data_diris->status_perencana == 2)
                                {{-- <h5 class="font-weight-bold">Alasan diSetujui</h5>
                                <textarea name="ket_balasan" class="form-control" value="{{ old('ket_balasan') }}" rows="2" readonly>{{$data_diris->keterangan}}</textarea>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{ url('staf/perencanaan/cek_file_balasan/' .$data_diris->id_perencanaan ) }}" class="btn bg-gradient-success btnsave btn-block" target="_blank"><i class="fas fa-file-contract fa-lg"></i> Cek File Balasan</a>
                                    </div>
                                </div> --}}
                            @elseif($data_diris->status_perencana == 3)
                                {{-- <h5 class="font-weight-bold">Alasan diTolak</h5>
                                <textarea name="ket_balasan" class="form-control" value="{{ old('ket_balasan') }}" rows="2" readonly>{{$data_diris->keterangan}}</textarea> --}}
                            @else
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-block btndiTolak" data-toggle="modal" data-target="#modal-default"><i class="fas fa-times-circle fa-lg"></i> diTolak</button>  
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success btn-block btndiTerima" data-toggle="modal" data-target="#modal-default"><i class="fas fa-check-circle fa-lg"></i> diTerima</button> 
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Sebelah Kiri [End]--}}

                    {{-- Sebelah Kanan [Start]--}}
                    <div class="col-md-7">
                        <h5><i class="fas fa-list-ul"></i> Data</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr class="font-weight-bold">
                                    <td>#</td>
                                    <td>Kode Barang</td>
                                    <td>Nama Barang</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_perancanaans as $item)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$item->id_barang}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->jumlah_p}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                                @if($data_diris->status_perencana == 2)
                                    <tr>
                                        <th style="width: 25%">Alasan diTerima: </th>
                                        <td colspan="2">{{$data_diris->keterangan}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%">File Balasan: </th>
                                        <td>
                                            <a href="{{ url('staf/perencanaan/cek_file_balasan/' .$item->id_perencanaan ) }}" class="btn bg-gradient-success btnsave btn-block text-white" target="_blank" style="width: 50%"><i class="fas fa-file-contract fa-lg"></i> File Balasan</a>
                                        </td>
                                    </tr>
                                @elseif($data_diris->status_perencana == 3)
                                    <tr>
                                        <th style="width: 25%">Alasan diTolak: </th>
                                        <td colspan="2">{{$data_diris->keterangan}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%">File Balasan: </th>
                                        <td>
                                            <a href="{{ url('staf/perencanaan/cek_file_balasan/' .$item->id_perencanaan ) }}" class="btn bg-gradient-success btnsave btn-block text-white" target="_blank" style="width: 50%"><i class="fas fa-file-contract fa-lg"></i> File Balasan</a>
                                        </td>
                                    </tr>
                                @else
                                    
                                @endif
                                    {{-- <td><strong style="float: right;">Total</strong></td> --}}
                            </tbody>
                        </table>
                    </div>
                    {{-- Sebelah Kanan [End]--}}
                </div>
                
            </div>
        </div>
    </div>
  </div>

    <form action="{{url('ketua/approvement/addProcess/' .$data_diris->id_perencanaan)}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')">
        @csrf
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="fas fa-clipboard-check"></i> - Approvement</h4>
                  <button type="button" class="close closeReset" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Perencanaan</label>
                        <input type="text" name="id_perencanaan" class="form-control" value="{{$data_diris->id_perencanaan}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="lblAlasan">Alasan diTerima</label>
                        <textarea name="keterangan" class="form-control keterangan" value="{{ old('keterangan') }}" rows="2" placeholder="Tulis Alasan . . ." oninvalid="this.setCustomValidity('Alasan Tidak Boleh Kosong..!!')"  oninput="this.setCustomValidity('')" autofocus required></textarea>
                    </div>
                    <div class="form-group allBalasan">
                        {{-- <label for="exampleInputFile">File Balasan</label>
                        <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input fileBalasan" id="exampleInputFile" name="file_balasan" required>
                            <label class="custom-file-label" for="exampleInputFile">Pilih file..</label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger closeReset" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                  <button type="submit" class="btn btn-success" value="simpanTerima" id="simpanHasil" name="action"><i class="fas fa-save"></i> Simpan</button>
                  {{-- <button type="submit" class="btn btn-success" value="simpanTolak" id="simpanTolak"><i class="fas fa-save"></i> Simpan</button> --}}
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        {{-- <button type="submit" class="btn btn-success" style="float: right;"><i class="fa fa-save"></i> Save</button> --}}
    </form>
  
    
@endsection


@section('jscript')

<script>
    $(document).ready(function() {
        var checkBalasan = 0;
        bsCustomFileInput.init();

        function closeHapus() {
            $('.keterangan').val('');
            $('.allBalasanMulti').remove();
            $('.fileBalasanMulti').remove();
            checkBalasan = 0;
        }

        // $('.btndiTolak').click(function() {
        //     $('.lblAlasan').html('Alasan diTolak');
        //     $("#simpanHasil").val('simpanTolak');
        //     $('.allBalasanMulti').remove();
        //     $('.fileBalasanMulti').remove();
        //     checkBalasan = 0;
        // });

        $('.btndiTolak').click(function() {
            $('.lblAlasan').html('Alasan diTolak');
            $("#simpanHasil").val('simpanTolak');
            if(checkBalasan == 0){
                showFileBalasan();
            }
        });

        $('.btndiTerima').click(function() {
            $('.lblAlasan').html('Alasan diTerima');
            $("#simpanHasil").val('simpanTerima');
            if(checkBalasan == 0){
                showFileBalasan();
            }
        });

        $('.closeReset').click(function() {
            closeHapus();
        });

        function showFileBalasan() {
            var tr = 
                '<label for="exampleInputFile" class="fileBalasanMulti">File Balasan</label>'+
                '<div class="input-group allBalasanMulti">'+
                    '<div class="custom-file">'+
                    '<input type="file" class="custom-file-input fileBalasan" id="exampleInputFile" name="file_balasan" required>'+
                    '<label class="custom-file-label" for="exampleInputFile">Pilih file..</label>'+
                    '</div>'+
                '</div>';
            $('.allBalasan').append(tr);
            checkBalasan = 1;
            bsCustomFileInput.init();
        }
    }); 
</script>

@endsection