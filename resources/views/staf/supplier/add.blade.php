@extends('main')

@section('title', 'Supplier')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Tambah Supplier</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
                    <h3 class="card-title">Tambah Supplier</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('staf/supplier/addProcess')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Supplier</label>
                            <input type="text" name="id_supplier" class="form-control" value="{{ $kode }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <input type="text" name="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" value="{{ old('nama_supplier') }}" autofocus placeholder="Nama Supplier . . .">
                            @error('nama_supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input type="text" name="telepon_supplier" class="form-control @error('telepon_supplier') is-invalid @enderror" value="{{ old('telepon_supplier') }}" autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g);" maxlength="13" placeholder="No Telepon . . .">
                            @error('telepon_supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Supplier</label>
                            <textarea name="alamat_supplier" class="form-control" value="{{ old('alamat_supplier') }}" rows="2" placeholder="Alamat Supplier . . ." autofocus required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ url('staf/supplier') }}" class="btn bg-gradient-secondary">
                                    <i class="fa fa-reply"></i> Kembali
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn bg-gradient-success" style="float: right;"><i class="fa fa-save"></i> Save</button>
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