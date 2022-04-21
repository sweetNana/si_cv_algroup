@extends('main')

@section('title', 'Perencanaan')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Tambah Perencanaan</h1>
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
    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Tambah Perencanaan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default-wma">
                            <i class="fas fa-microscope text-secondary fa-lg"></i> Peramalan
                        </button> | 
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-lg">
                            <i class="fas fa-star text-warning fa-lg"></i> Rekomendasi
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('staf/perencanaan/addProcess')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')">
                        @csrf
                        <div class="row">
                            {{-- Baigan Kiri - Start --}}
                            <div class="col-5 border-right">
                                <div class="form-group">
                                    <label for="">Kode Perencanaan</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lightbulb"></i></span>
                                        </div>
                                        <input type="text" name="id_perencanaan" class="form-control" value="{{ $kode }}" readonly>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="">Perencana</label>
                                    <select class="custom-select form-control" name="user_perencana" readonly>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Perencanaan</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input tgl_perencanaan" data-target="#reservationdate" name="tgl_perencanaan"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File Perencanaan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file_perencana" required>
                                        <label class="custom-file-label" for="exampleInputFile">Pilih file..</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Baigan Kiri - End --}}

                            {{-- Baigan Kanan - Start --}}
                            <div class="col-7 border-left">
                                <div class="form-group">
                                    <label for="">Judul Perencanaan</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullhorn"></i></span>
                                        </div>
                                        <input type="text" name="judul_perencanaan" class="form-control" value="{{ old('judul_perencanaan') }}" placeholder="Judul Perencanaan ..." oninvalid="this.setCustomValidity('Judul Pengajuan Tidak Boleh Kosong')"  oninput="this.setCustomValidity('')" autofocus required>
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                </div>
                                {{-- <hr> --}}
                                <div class="form-group">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th style="width: 25%">Jumlah</th>
                                                <th class="text-center">
                                                    <a href="javascript:;" class="btn btn-info addRow" id="addRow"><i class="fas fa-plus-circle" title="Tambah List Barang"></i></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="addDataBarang">
                                            <tr>
                                                <td>
                                                    <select name="barang_p[]" id="barang_p" class="form-control">
                                                        @foreach ($barangs as $item)
                                                        <option value="{{$item->id_barang }}" data-stokbarang="{{ $item->stok }}">{{$item->id_barang }} : {{$item->nama_barang}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="numeric" name="jumlah_p[]" class="form-control jumlah_p" value="{{ old('jumlah_p') }}" required autofocus>
                                                </td>
                                                <td class="text-center"><a href="javascript:;" class="btn btn-danger deleteRow" title="Hapus List Barang"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <hr style="border: 1px solid;" class="text-secondary">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('staf/perencanaan') }}" class="btn btn-sm bg-gradient-secondary btn-block">
                                            <i class="fas fa-reply"></i> Kembali
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" name="action" value="save_a" class="btn btn-sm bg-gradient-success btn-block"><i class="fas fa-paper-plane"></i> Ajukan Perencanaan</button>
                                    </div>
                                </div>
                            </div>
                            {{-- Baigan Kanan - End --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
  </div>
  @include('staf.perencanaan.modal_pilih_wma')
  @include('staf.perencanaan.rekomendasi')
    
@endsection

@section('jscript')

<script>
    $(function () {

        get_tgl();
        function get_tgl(){
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var outputdate = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
                $('.tgl_perencanaan').val(outputdate);
        }

        bsCustomFileInput.init();

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#addRow').on('click', function(){
            var tr = 
            '<tr>'+
                '<td>'+
                    '<select name="barang_p[]" id="barang" class="form-control">'+
                        @foreach ($barangs as $item)
                        '<option value="{{$item->id_barang }}" data-stokbarang="{{ $item->stok }}">{{$item->id_barang }} : {{$item->nama_barang}}</option>'+
                        @endforeach
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="numeric" name="jumlah_p[]" class="form-control jmlh_brg" value="{{ old('jumlah_p') }}" required autofocus>'+
                '</td>'+
                '<td class="text-center"><a href="javascript:;" class="btn btn-danger deleteRow" title="Hapus List Barang"><i class="fas fa-trash"></i></a></td>'+
            '</tr>';
            
            $('.addDataBarang').append(tr);
        });

        $('tbody').on('click', '.deleteRow', function(){
            $(this).parent().parent().remove();
        });


        $('#addDataList').on('click', function(){
            var selectedKeys = [];
            var id = null;
            $("input[name=chkRow]").each(function () {
                if ($(this).prop('checked')) {
                    id = $(this).attr('data-idbarang');
                    selectedKeys.push(id);
                }
            });
            
            var selectedNew = [];
            $.each(selectedKeys, function(i, e) {
                if ($.inArray(e, selectedNew) == -1) selectedNew.push(e);
            });

            var arrayLength = selectedNew.length;
            for (var i = 0; i < arrayLength; i++) {
                data_rekomendasi(selectedNew[i]);
            }

            $('#modal-lg').modal('toggle');
        });

        function data_rekomendasi(pilihans){
            var tr = 
            '<tr>'+
                '<td>'+
                    '<select name="barang_p[]" id="barang_rekomendasi'+pilihans+'" class="form-control">'+
                        @foreach ($barangs as $item)
                        '<option value="{{$item->id_barang }}" data-stokbarang="{{ $item->stok }}">{{$item->id_barang }} : {{$item->nama_barang}}</option>'+
                        @endforeach
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="numeric" name="jumlah_p[]" class="form-control jmlh_brg" value="{{ old('jumlah_p') }}" required autofocus>'+
                '</td>'+
                '<td class="text-center"><a href="javascript:;" class="btn btn-danger deleteRow" title="Hapus List Barang"><i class="fas fa-trash"></i></a></td>'+
            '</tr>';
            
            $('.addDataBarang').append(tr);
            $('#barang_rekomendasi'+pilihans).val(pilihans);
        }

        $('.close_rekomendasi').on('click', function(){
            $('input[name=chkRow]').prop('checked', false);
        });

    });
</script>

@endsection