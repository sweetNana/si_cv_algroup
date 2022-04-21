@extends('main')

@section('title', 'Barang')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Perhitungan WMA</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perhitungan WMA</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h5 for=""><div class="text-secondary">Nama Barang : {{$namas->nama_barang}}</div></h5>
            <div class="card-tools">
                {{-- <a href="{{ url('staf/barang') }}" class="btn bg-gradient-secondary">
                    <i class="fas fa-reply"></i> Kembali
                </a> --}}
            </div>
        </div>
        <div class="card-body table-responsive p-0" style="height: 400px;">
            {{-- bootstrap-data-table2 --}}
            <table id="" class="table table-striped table-head-fixed text-nowrap">
                <thead>
                    <tr class="font-weight-bold">
                        <th>#</th>
                        <th>Bulan</th>
                        <th>Indeks Waktu</th>
                        <th>Permintaan Aktual</th>
                        <th>Ramalan WMA</th>
                        <th>Et</th>
                        <th>MSE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wmas as $item)
                    <tr>
                        <td>#</tD>
                        <td>{{$item->showdate}}</td>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center wma-{{$loop->iteration}}">{{$item->jmlh}}</td>
                        <td class="font-italic font-weight-bold text-center ramalan-{{$loop->iteration}}"></td>
                        <td class="text-center et-{{$loop->iteration}}"></td>
                        <td class="text-center mse-{{$loop->iteration}}"></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if($wmas->count() > 0)
                        <tr class="font-weight-bold table-info">
                            <td>#</td>
                            <td>Next Bulan ??</td>
                            <td class="text-center totalIndeks"></td>
                            <td class="text-center">0</td>
                            {{-- <td class="text-center text-white countWma">{{ $wmas->count() }}</td> --}}
                            <input type="text" name="id_barang" class="form-control countWma" value="{{ $wmas->count() }}" hidden readonly>
                            <td class="text-center totalWma">
                                {{-- <label class="totalWma btn btn-danger font-weight-bold font-italic"></label> --}}
                            </td>
                            <td class="totalEt text-center"></td>
                            <td class="totalMSE text-center"></td>
                        </tr>   
                    @endif
                </tfoot>
            </table>

        </div>
    </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(function () {
      $("#bootstrap-data-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

      $("#bootstrap-data-table2").DataTable();

      var valueWMA = 10;
      var countWma = parseInt($(".countWma").val());
      var className = "wma-";
      var a = undefined;
      // Total Ramalan WMA [Start]
        var data0 = $("." + className + (countWma-0)).html();
        var data1 = $("." + className + (countWma-1)).html();
        var data2 = $("." + className + (countWma-2)).html();
        var data3 = $("." + className + (countWma-3)).html();
        var dataTotal = 0;
        dataTotal = ((parseInt(data0)*4) + (parseInt(data1)*3) + (parseInt(data2)*2) + (parseInt(data3))*1) / valueWMA;
        dataTotalMSE = (Math.pow(dataTotal,2))/countWma;
        $(".totalWma").html(dataTotal);
        $(".totalIndeks").html(countWma+1);
        $(".totalEt").html(dataTotal);
        $(".totalMSE").html(dataTotalMSE.toFixed(3));
        if($(".totalMSE").html() == "NaN"){
            $(".totalMSE").html("");
        }
      // Total Ramalan WMA [End]

      // Ramalan WMA [Start]
      var hitungan = countWma - 4;
      var classRamalan = "ramalan-";
      var classEt = "et-";
      var classMSE = "mse-";
      for (var i = countWma; i > 4; i--) 
      {
        var dataPermintaanAktual = parseInt($("." + className + (i)).html());
        var data00 = $("." + className + (i-1)).html();
        var data11 = $("." + className + (i-2)).html();
        var data22 = $("." + className + (i-3)).html();
        var data33 = $("." + className + (i-4)).html();
        var dataTotall = 0;
        dataTotall = ((parseInt(data00)*4) + (parseInt(data11)*3) + (parseInt(data22)*2) + (parseInt(data33))*1) / valueWMA;
        $("." + classRamalan + i).html(dataTotall);
        // $("." + classEt + i).html((dataTotall-dataPermintaanAktual).toFixed(3));
        $("." + classEt + i).html((Math.abs(dataTotall-dataPermintaanAktual)).toFixed(3));
        $("." + classMSE + i).html(((Math.pow((dataTotall-dataPermintaanAktual),2))/countWma).toFixed(3));
        // if($("." + classEt + i).html() == "NaN"){
        //     $("." + classEt + i).html("");
        //     $("." + classMSE + i).html("");
        // }
      }
      // Ramalan WMA [End]
    });
</script>

@endsection
