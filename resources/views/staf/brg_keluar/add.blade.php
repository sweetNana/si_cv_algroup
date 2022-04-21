@extends('main')

@section('title', 'Barang Keluar')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Barang Keluar</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Barang Keluar</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="tampil_alert_Stok">
        <div class="alert with-close alert-danger alert-dismissible fade show" style="color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">
            <span class="badge badge-pill badge-danger">Error</span>
                Stok Barang tidak Mencukupi .!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Tambah Barang Keluar</h3>
            <div class="card-tools">
                <a href="{{ url('staf/brg_keluar') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('staf/brg_keluar/addProcess')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Yakin Data Sudah Sesuai ?')">
                @csrf
                
                <div class="row">
                    <div class="col-1"></div>
                        <div class="col-5">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Data 1</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Id Barang Keluar</label>
                                        <input type="text" name="id_brg_keluar" class="form-control" value="{{ $kode }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Id Barang</label>
                                        <select name="id_barang" id="id_barang" class="form-control id_barang" autofocus>
                                            @foreach ($barangs as $item)
                                            <option value="{{$item->id_barang}}" data-nama="{{$item->nama_barang}}" data-stok="{{$item->stok}}">{{$item->id_barang }} : {{$item->nama_barang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control nama_barang @error('nama_barang') is-invalid @enderror" value="" readonly required>
                                        @error('nama_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Data 2</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Jumlah</label>
                                        <input type="text" name="jumlah" class="form-control jumlah @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g);" maxlength="12">
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Barang Keluar</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input tgl_brg_keluar" data-target="#reservationdate" name="tgl_brg_keluar"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" value="{{ old('keterangan') }}" rows="2" placeholder="Alasan..." oninvalid="this.setCustomValidity('Keterangan harus diIsi')" oninput="this.setCustomValidity('')" autofocus required></textarea>
                                    </div>
                                    <hr style="border: 1px solid;" class="text-danger">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ url('staf/brg_keluar') }}" class="btn btn-sm btn-danger btn-block">
                                                <i class="fas fa-times-circle"></i> Cancel
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="save_a" class="btn btn-sm btn-success btn-block btnsave"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-1"></div>
                </div>

            </form>
        </div>
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(function () {

        $('.tampil_alert_Stok').hide();
        //Date picker
        get_tgl();
        function get_tgl(){
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var outputdate = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
                $('.tgl_brg_keluar').val(outputdate);
        }

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $(document).on("click", ".id_barang", function () {
            var gnama = $('option:selected', this).attr('data-nama');
            $('.nama_barang').val(gnama);
            stoks();
        });

        $(".jumlah").on("keyup change", function(e) {
            stoks();
        })

        function stoks(){
            var stoks = 0;
            var stok_brg = $('option:selected', '.id_barang').attr('data-stok');
            $('.jumlah').each(function(i, e){
                var jmlh_brg = $(this).val()-0;
                if(jmlh_brg > stok_brg){
                    $('.btnsave').prop('disabled', true);
                    $('.tampil_alert_Stok').show();
                }else{
                    $('.btnsave').prop('disabled', false);
                    $('.tampil_alert_Stok').hide();
                }
            });
        }

    });
</script>

@endsection