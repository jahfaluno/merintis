@extends('template.adminlte')

@section('additionalcss')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection()

@section('sidebarMenu')
{{-- Sidebar Menu --}}
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/miadmin/homeadmin') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Kumpulan Data
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/miadmin/datamis') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan MIS 2021</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/miadmin/datafinalis') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Finalis 50 MIS 2021</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/miadmin/datamistalk') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Peserta MISTALK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/miadmin/datacclinic') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Coaching Clinic</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/miadmin/datakubis') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kuliah Bisnis</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/miadmin/dataprogram') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Program</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Form
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('miadmin/formprogram') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  Form Program
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
{{-- ./Sidebar Menu --}}
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Top Finalis 50 MIS 2021</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="tblfinalis" class="table table-bordered table-striped">
      <thead class="bg-success">
      <tr>
        <th>No</th>
        <th>ID Finalis</th>
        <th>Nama Tim</th>
        <th>Nama Bisnis</th>
        <th>Link Video</th>
      </tr>
      </thead>
      <tbody>
        <?php
        $angka = 0;
        foreach ($dataFinalis as $row):
        ?>
        <tr>
          <td>{{ ++$angka }}</td>
          <td>{{ $row['id_finalis'] }}</td>
          <td>{{ $row['nm_lengkap'] }}</td>
          <td>{{ $row['nama_bisnis'] }}</td>
          <td class="text-center">
          <?php
            if ($row['link_yt']) {
              echo "<a href=".$row['link_yt']." target='_blank' class='btn btn-warning'><i class='fas fa-video'></i>&nbsp;&nbsp;Watch</a>";
            }
          ?>
        </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>No</th>
        <th>ID Finalis</th>
        <th>Nama Tim</th>
        <th>Nama Bisnis</th>
        <th>Link Video</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

@section('additionaljs')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#tblfinalis").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "pagingType": "simple",
      "buttons": [
        {
        text: "Excel",
        action: function(e, dt, node, config) {
          window.location.href = "{{ url('/miadmin/xlsfinal') }}";
          }
        },
        "colvis"
      ]
    }).buttons().container().appendTo('#tblfinalis_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
