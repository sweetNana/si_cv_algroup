@extends('main')

@section('title', 'Barang Masuk')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Barang Masuk</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Barang Masuk</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Brg Sudah Pernah Ada</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Brg Belum Pernah Ada</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{url('staf/brg_masuk/addProcess')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')">
                    @csrf
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            {{-- Sudah Pernah Ada --}}
                            <div class="row">
                                <div class="col-1"></div>
                                    <div class="col-5">
                                        <div class="card card-success card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title">Data 1</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="">Id Barang Masuk</label>
                                                    <input type="text" name="id_brg_masuk" class="form-control" value="{{ $kode }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Id Barang</label>
                                                    <select name="id_barang" id="id_barang" class="form-control id_barang" autofocus>
                                                        @foreach ($barangs as $item)
                                                        <option value="{{$item->id_barang}}" data-nama="{{$item->nama_barang}}" data-kategori="{{$item->kategori}}">{{$item->id_barang }} : {{$item->nama_barang}}</option>
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
                                                <div class="form-group">
                                                    <label for="">Kategori</label>
                                                    <input type="text" name="kategori" class="form-control kategori @error('kategori') is-invalid @enderror" value="" readonly required>
                                                    @error('kategori')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="card card-success card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title">Data 2</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="">Jumlah</label>
                                                    <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g);" maxlength="12">
                                                    @error('jumlah')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Supplier</label>
                                                    <div class="row">
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
                                                    </div>
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
                                                <hr style="border: 1px solid;" class="text-danger">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="{{ url('staf/brg_masuk') }}" class="btn btn-sm btn-danger btn-block">
                                                            <i class="fas fa-times-circle"></i> Cancel
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" name="action" value="save_a" class="btn btn-sm btn-success btn-block"><i class="fa fa-save"></i> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-1"></div>
                            </div>
                            {{-- Sudah Pernah Ada End--}}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            {{-- Belum Pernah Ada --}}
                            <div class="row">
                                <div class="col-1"></div>
                                    <div class="col-5">
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title">Data 1</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="">Id Barang Masuk</label>
                                                    <input type="text" name="id_brg_masuk2" class="form-control" value="{{ $kode }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Id Barang</label>
                                                    <input type="text" name="id_barang2" class="form-control id_barang2" value="{{ $kode_barangs }}" readonly required>
                                                    @error('nama_barang2')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Nama Barang</label>
                                                    <input type="text" name="nama_barang2" class="form-control nama_barang2 @error('nama_barang2') is-invalid @enderror" value="{{ old('nama_barang2') }}" autofocus>
                                                    @error('nama_barang2')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Kategori</label>
                                                    <input type="text" name="kategori2" class="form-control kategori2 @error('kategori2') is-invalid @enderror" value="">
                                                    @error('kategori2')
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
                                                    <input type="text" name="jumlah2" class="form-control @error('jumlah2') is-invalid @enderror" value="{{ old('jumlah2') }}" autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g);" maxlength="12">
                                                    @error('jumlah2')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Supplier</label>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <select name="supplier2" id="supplier2" class="form-control">
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
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tanggal Barang Masuk</label>
                                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input tgl_brg_masuk" data-target="#reservationdate2" name="tgl_brg_masuk2"/>
                                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="border: 1px solid;" class="text-danger">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="{{ url('staf/brg_masuk') }}" class="btn btn-sm btn-danger btn-block">
                                                            <i class="fas fa-times-circle"></i> Cancel
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" name="action" value="save_b" class="btn btn-sm btn-success btn-block"><i class="fa fa-save"></i> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-1"></div>
                            </div>
                            {{-- Belum Pernah Ada --}}
                        </div>
                    </div>
                    </form>
                </div>
            
            <!-- /.card -->
        </div>
        
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(function () {

        function error_2() {
            $('#custom-tabs-one-home-tab').removeClass('active');
            $('#custom-tabs-one-profile-tab').addClass('active');
            $('#custom-tabs-one-home-tab').prop('aria-selected', false);
            $('#custom-tabs-one-profile-tab').prop('aria-selected', true);
            $('#custom-tabs-one-home').removeClass('active show');
            $('#custom-tabs-one-profile').addClass('active show');
        }

        @error('kategori2')
            error_2();
        @enderror

        @error('jumlah2')
            error_2();
        @enderror

        @error('nama_barang2')
            error_2();
        @enderror

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
            var gkategori = $('option:selected', this).attr('data-kategori');
            $('.kategori').val(gkategori);
            $('.nama_barang').val(gnama);
        });

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        
        $('#reservationdate2').datetimepicker({
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