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

    <div class="card card-success card-outline">
        
        <div class="card-header">
            <h3 class="card-title"><strong>Tambah Pengajuan</strong></h3>

            <div class="card-tools">
                <a href="{{ url('user/pengajuan') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('user/pengajuan/addProcess')}}" enctype="multipart/form-data" method="post" onsubmit="return confirm('Apakah Data Pengajuan Akan Disimpan ? ')"> 
                {{-- nctype="multipart/form-data">  Untuk File Penting--}}
            @csrf
            <div class="row">

                {{-- Bagian Kiri--}}
                <div class="col-md-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">Data-1</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Id Pengajuan</label>
                                <input type="text" class="form-control" name="id_pengajuan" readonly value="{{ $kode }}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pengaju</label>
                                <select class="custom-select form-control" name="user_pengaju" readonly>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tgl Pengajuan</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input tgl_pengajuan" data-target="#reservationdate" name="tgl_pengajuan"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File Pengajuan</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file_pengajuan" required>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih file..</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- Bagian Kiri End--}}
    
                {{-- Bagian Kanan--}}
                <div class="col-md-7">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                          <h3 class="card-title">Data-2</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Judul Pengajuan</label>
                                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Judul Pengajuan ..." oninvalid="this.setCustomValidity('Judul Pengajuan Tidak Boleh Kosong')"  oninput="this.setCustomValidity('')" autofocus required>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th style="width: 25%">Jumlah</th>
                                        <th class="text-center">
                                            <a href="javascript:;" class="btn btn-info addRow" id="addRow"><i class="fas fa-plus"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="barang[]" id="barang" class="form-control">
                                                @foreach ($barangs as $item)
                                                <option value="{{$item->id_barang }}" data-stokbarang="{{ $item->stok }}">{{$item->id_barang }} : {{$item->nama_barang}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="numeric" name="jumlah[]" class="form-control jmlh_brg" value="{{ old('jumlah') }}" required autofocus>
                                        </td>
                                        <td class="text-center"><a href="javascript:;" class="btn btn-danger deleteRow"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="border: none"></td>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-success btnsave btn-block" id="btnsave"><i class="fa fa-save"></i> Save</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
    $(function () {

        //Date picker
        get_tgl();
        function get_tgl(){
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var outputdate = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
                $('.tgl_pengajuan').val(outputdate);
        }

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        bsCustomFileInput.init();

        $('#addRow').on('click', function(){
                var tr = 
                '<tr>'+
                    '<td>'+
                        '<select name="barang[]" id="barang" class="form-control">'+
                            @foreach ($barangs as $item)
                            '<option value="{{$item->id_barang }}" data-stokbarang="{{ $item->stok }}">{{$item->id_barang }} : {{$item->nama_barang}}</option>'+
                            @endforeach
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<input type="numeric" name="jumlah[]" class="form-control jmlh_brg" value="{{ old('jumlah') }}" required autofocus>'+
                    '</td>'+
                    '<td class="text-center"><a href="javascript:;" class="btn btn-danger deleteRow"><i class="far fa-trash-alt"></i></a></td>'+
                '</tr>';
                
                $('table tbody').append(tr);
            });

            $('tbody').on('click', '.deleteRow', function(){
                $(this).parent().parent().remove();
            });
    });
</script>

@endsection