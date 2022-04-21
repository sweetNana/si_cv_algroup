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
    <div class="card card-success card-outline">
        
        <div class="card-header">
            <h3 class="card-title"><strong>Data Pengajuan</strong></h3>
            <div class="card-tools">
                <a href="{{ url('staf/staf_pengajuan/' .$roles) }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('staf/staf_pengajuan/staf_addProcess/' .$roles. '/' .$data_diris->id_pengajuan)}}" enctype="multipart/form-data" method="post"> 
            @csrf
            <div class="row">

                {{-- Bagian Kiri--}}
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">Data-1</h3>
                        </div>
                        <div class="card-body">
                            @if($roles == 'staf')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Id Pengajuan</label>
                                            <input type="text" class="form-control" name="id_pengajuan" readonly value="{{ $data_diris->id_pengajuan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Id Perencanaan</label>
                                            <input type="text" class="form-control" name="id_perencanaan" readonly value="{{ $data_diris->id_perencanaan_pj }}">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="">Id Pengajuan</label>
                                    <input type="text" class="form-control" name="id_pengajuan" readonly value="{{ $data_diris->id_pengajuan }}">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Judul Pengajuan</label>
                                <input type="text" class="form-control" name="judul_pengajuan" readonly value="{{ $data_diris->judul }}">
                                <input type="text" class="form-control" name="user_pengaju" readonly value="{{ $data_diris->user_pengaju }}" hidden>
                                <input type="text" class="form-control" name="h_user_penyetuju" readonly value="{{ Auth::user()->id }}" hidden>
                                <input type="text" class="form-control tgl_balasan" name="tgl_balasan" readonly hidden>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pengaju</label>
                                <input type="text" class="form-control" name="nama_pengaju" readonly value="{{ $data_diris->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Tgl Pengajuan</label>
                                <input type="text" class="form-control" name="tgl_pengajuan" readonly value="{{ $data_diris->tgl_pengajuan }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File Pengajuan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="file_pengajuan" readonly value="{{ $data_diris->file_pengajuan }}">
                                    <div class="input-group-prepend">
                                        <a href="{{ url('staf/staf_pengajuan/staf_cek_file/' .$data_diris->id_pengajuan ) }}" class="btn btn-info" title="Cek File" target="_blank">
                                            <i class="far fa-file-alt fa-lg"></i> Cek File
                                        </a>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- Bagian Kiri End--}}
    
                {{-- Bagian Kanan--}}
                <div class="col-md-6">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                          <h3 class="card-title">Data-2</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>#</td>
                                        <td>Barang</td>
                                        <td>Jumlah</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pengajuans as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->jumlah}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr style="border: 1px solid;" class="text-danger">
                            
                            @if($item->status_pengajuan =='1')
                                <div class="form-group">
                                    <label for="">Alasan diSetujui/diTolak</label>
                                    <textarea name="keterangan" class="form-control" value="{{ old('keterangan') }}" rows="2" placeholder="Alasan..." oninvalid="this.setCustomValidity('Alasan diSetujui/diTolak harus diIsi')"  oninput="this.setCustomValidity('')" autofocus required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-danger btnsave btn-block" name="action" id="tolak" value="tolak"><i class="fas fa-times-circle fa-lg"></i> Tolak Pengajuan</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success btnsave btn-block" name="action" id="process" value="process"><i class="fas fa-paper-plane fa-lg"></i> Process Pengajuan</button>
                                    </div>
                                </div>
                            @elseif($item->status_pengajuan =='2')
                                <button type="button" class="btn btn-primary btn-block"><i class="fas fa-pencil-alt fa-lg"></i> Sedang diProcess</button>  
                            @elseif($item->status_pengajuan =='3')  
                                <button type="button" class="btn btn-success btn-block"><i class="fas fa-check-circle fa-lg"></i> diTerima</button> 
                            @else
                                <button type="button" class="btn btn-danger btn-block"><i class="fas fa-times-circle fa-lg"></i> diTolak</button>        
                            @endif
                        </div>
                    </div>
                </div>{{-- Bagian Kanan End--}}
            </div>

            </form>
        </div>
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(document).ready(function() {
        get_tgl();
        function get_tgl(){
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var outputdate = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
                $('.tgl_balasan').val(outputdate);
        }

        $('#tolak').click(function() {
            return confirm('Apakah Data Pengajuan Akan diTolak ?');
        });

        $('#process').click(function() {
            return confirm('Apakah Data Pengajuan Akan diProcess ?');
        });
    }); 
</script>

@endsection