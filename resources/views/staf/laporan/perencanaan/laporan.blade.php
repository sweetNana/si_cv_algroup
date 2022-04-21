<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Perencanaan - CV Algroup</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('style/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('style/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('style/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('style/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('style/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('style/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('style/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('style/plugins/dropzone/min/dropzone.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('style/dist/css/adminlte.min.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header text-center">
                <h3 class="font-weight-bold"><i class="fab fa-glide fa-lg"></i> - CV Algroup</h3>
                <h5 class="mt-4">Mahkota Regency G11 – 24A Sirnabaya,</h5>
                <h5>Teluk Jambe Timur Kab. Karawang – Jawa Barat</h5>
                <hr style="border: 1px solid;" class="text-secondary">
                <div class="row">
                    <div class="col-4 text-left">
                        <a href="{{ url('staf/laporan/perencanaan/data') }}" class="btn bg-gradient-warning">
                            <i class="fa fa-reply"></i> Kembali
                        </a>
                    </div>
                    <div class="col-4">
                        <h3>Laporan Perencanaan</h3>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped">
                    <thead>
                        <tr class="font-weight-bold">
                            <td>#</td>
                            <td>Kode Perencanaan</td>
                            <td>Perencana</td>
                            <td>Tgl Perencanaan</td>
                            <td>Judul Perencanaan</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perencanaans_datas as $item)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$item->id_perencanaan}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->tgl_perencanaan}}</td>
                            <td>{{$item->judul_perencanaan}}</td>
                            <td class="text-center font-italic">
                                @if($item->status_perencana =='1')
                                    <label for="">diAjukan</label> 
                                @elseif($item->status_perencana =='2')
                                    <label for="">diTerima</label> 
                                @else
                                    <label for="">diTolak</label>         
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- <script type="text/javascript">
        window.print();
    </script> --}}

<!-- jQuery -->
<script src="{{asset('style/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('style/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('style/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('style/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('style/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('style/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('style/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('style/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('style/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('style/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('style/plugins/dropzone/min/dropzone.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('style/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('style/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('style/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('style/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('style/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('style/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('style/dist/js/demo.js')}}"></script>
<!-- Page specific script -->

<script>
    $(function () {
        $("#bootstrap-data-table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf"]
        }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

        $("#bootstrap-data-table_filter").hide();

        //Date range picker
    });
</script>

</body>
</html>