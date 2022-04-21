@extends('main')

@section('title', 'Barang')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Tambah Barang</h1>
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
    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Barang Sudah Pernah Ada</h3>
                    <div class="card-tools">
                        {{-- <a href="{{ url('staf/barang') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-reply"></i> Kembali
                        </a> --}}
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('staf/barang/addProcess_ada')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')">
                        @csrf
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="row">
                                    {{-- Baigan Kiri - Start --}}
                                    <div class="col-6 border-right">
                                        <div class="form-group">
                                            <label for="">Kode Barang Masuk</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lightbulb"></i></span>
                                                </div>
                                                <input type="text" name="id_brg_masuk" class="form-control" value="{{ $kode }}" readonly>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kode Barang</label>
                                            <select name="id_barang" id="id_barang" class="form-control id_barang" autofocus>
                                                @foreach ($barangs as $item)
                                                <option value="{{$item->id_barang}}" data-nama="{{$item->nama_barang}}" data-satuan="{{$item->satuan}}">{{$item->id_barang }} : {{$item->nama_barang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-archive"></i></span>
                                                </div>
                                                <input type="text" name="nama_barang" class="form-control nama_barang @error('nama_barang') is-invalid @enderror" value="" readonly required>
                                                @error('nama_barang')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Satuan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fab fa-unity"></i></span>
                                                </div>
                                                <input type="text" name="satuan" class="form-control satuan @error('satuan') is-invalid @enderror" value="" readonly required>
                                                @error('satuan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Baigan Kiri - End --}}

                                    {{-- Baigan Kanan - Start --}}
                                    <div class="col-6 border-left">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                                </div>
                                                <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g);" maxlength="12">
                                                @error('jumlah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="">Supplier</label>
                                            <select name="supplier" id="supplier" class="form-control">
                                                @foreach ($suppliers as $item)
                                                <option value="{{$item->id_supplier}}">{{$item->id_supplier }} : {{$item->nama_supplier}}</option>
                                                @endforeach
                                            </select>
                                            {{-- <div class="row">
                                                <div class="col-md-10">
                                                    <select name="supplier" id="supplier" class="form-control">
                                                        @foreach ($suppliers as $item)
                                                        <option value="{{$item->id_supplier}}">{{$item->id_supplier }} : {{$item->nama_supplier}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="" class="btn btn-primary btn-block add_supplier" title="Add Supplier">
                                                        <i class="fas fa-plus-square fa-lg"></i>
                                                    </a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal Barang Masuk</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input tgl_brg_masuk" data-target="#reservationdate" name="tgl_brg_masuk"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="border: 1px solid;" class="text-secondary">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ url('staf/barang/brgmasuk_data') }}" class="btn btn-sm bg-gradient-secondary btn-block">
                                                    <i class="fas fa-reply"></i> Kembali
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" name="action" value="save_a" class="btn btn-sm bg-gradient-success btn-block"><i class="fa fa-save"></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Baigan Kanan - End --}}
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
  </div>
    
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
                $('.tgl_brg_masuk').val(outputdate);
        }

        $(document).on("click", ".id_barang", function () {
            var gnama = $('option:selected', this).attr('data-nama');
            var gsatuan = $('option:selected', this).attr('data-satuan');
            $('.satuan').val(gsatuan);
            $('.nama_barang').val(gnama);
        });

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('.add_supplier').click(function() {
            if (confirm('Yakin akan menambah data Supplier dan meninggalkan halaman ini ?')) {
                $(this).attr('href','{{ URL::to('staf/brg_masuk/add_supplier') }}')
            }
        });
    });
</script>

@endsection