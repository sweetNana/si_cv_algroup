<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-star text-warning"></i> Rekomendasi</h4>
          <button type="button" class="close close_rekomendasi" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Paling Banyak diAjukan</h3>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>#</td>
                                        <td>Nama Barang</td>
                                        <td>Total</td>
                                        <td>Pilih</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang_banyak as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->jmlh}}</td>
                                        <td class="text-center">
                                            <input name="chkRow" type="checkbox" class="form-check-input" id="chkPilih" data-idbarang="{{ $item->barang_p }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Stok Barang Paling Sedikit</h3>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <td>#</td>
                                        <td>Nama Barang</td>
                                        <td>Stok</td>
                                        <td>Pilih</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang_dikit as $item)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->stok}}</td>
                                        <td class="text-center">
                                            <input name="chkRow" type="checkbox" class="form-check-input" id="chkPilih2" data-idbarang="{{ $item->id_barang }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger close_rekomendasi" data-dismiss="modal">Close</button>
          <a href="javascript:;" class="btn btn-info addRow close_rekomendasi" id="addDataList"><i class="fas fa-plus"></i> Tambah ke List</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->