@extends('main')

@section('title', 'Barang')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Barang</h1>
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
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Edit Barang</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('staf/barang/editProcess/' .$barangg->id_barang)}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')">
                        @method('patch') 
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Barang</label>
                            <input type="text" name="id_barang" class="form-control" value="{{ $barangg->id_barang }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Satuan Barang</label>
                            <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan', $barangg->satuan) }}" autofocus>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $barangg->nama_barang) }}" autofocus>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Kondisi Barang</label>
                            <input type="text" name="kondisi" class="form-control @error('kondisi') is-invalid @enderror" value="{{ old('kondisi', $barangg->kondisi) }}" autofocus>
                            @error('kondisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="">Stok Barang</label>
                            <input type="text" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $barangg->stok) }}" autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g);" maxlength="10" readonly>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" class="form-control" value="{{ old('keterangan', $barangg->keterangan) }}" rows="2" placeholder="Keterangan Barang" autofocus>{{ $barangg->keterangan }}</textarea>
                        </div> --}}
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ url('staf/barang') }}" class="btn bg-gradient-secondary">
                                    <i class="fa fa-reply"></i> Kembali
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn bg-gradient-success" style="float: right;"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
      </div>
  </div>
    
@endsection