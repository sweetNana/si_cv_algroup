<form action="{{url('staf/barang/wma')}}" method="post" enctype="multipart/form-data" target="_blank">
    @csrf
    <div class="modal fade" id="modal-default-wma">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-microscope"></i> - Peramalan WMA</h4>
              <button type="button" class="close closeReset" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Pilih Barang</label>
                    <select name="barang_p" id="barang_p" class="form-control">
                        @foreach ($barangs as $item)
                        <option value="{{$item->id_barang }}" data-stokbarang="{{ $item->stok }}">{{$item->id_barang }} : {{$item->nama_barang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger closeReset" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
              <button type="submit" class="btn btn-success" value="simpanTerima" id="simpanHasil" name="action"><i class="fas fa-check"></i> Pilih</button>
            </div>
          </div>
        </div>
      </div>
</form>