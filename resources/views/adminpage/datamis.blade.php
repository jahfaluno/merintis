@extends('template.adminlte')

@section('additionalcss')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

<!-- Sidebar Menu -->
@section('sidebarMenu')
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
                <a href="{{ url('/miadmin/datamis') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan MIS 2021</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/miadmin/datafinalis') }}" class="nav-link">
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
                <a href="{{ url('/miadmin/formprogram') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  Form Program
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
@endsection
<!-- ./Sidebar Menu -->

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Peserta MIS 2021</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="datamis" class="table table-bordered table-striped">
      <thead class="bg-success">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Nomor HP</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Kota Domisili</th>
        <th>Pekerjaan</th>
        <th>Jenis Kelamin</th>
        <th>Role</th>
        <th>Proposal</th>
        <th>Bidang Bisnis</th>
        <th>Metode Bayar</th>
        <th>Bukti Bayar</th>
      </tr>
      </thead>
      <tbody>
      <?php
        $no = 0;
        foreach ($datamis as $row):
      ?>
        <tr>
          <td>{{ ++$no }}</td>
          <td>{{ $row['nm_lengkap'] }}</td>
          <td>{{ $row['email'] }}</td>
          <td>{{ $row['no_hp'] }}</td>
          <td>{{ $row['tempat_lahir'] }}</td>
          <td>{{ $row['tgl_lahir'] }}</td>
          <td>{{ $row['kota_domisili'] }}</td>
          <td>{{ $row['pekerjaan'] }}</td>
          <td>{{ $row['jenis_kelamin'] }}</td>
          <td>{{ $row['role'] }}</td>
          <td>
            <?php
            if ($row['url_proposal']) {
              echo "<a href=". asset('storage/proposal/'.rawurlencode($row['url_proposal']))." target='_blank'>".$row['url_proposal']."</a>";
            }
            ?>
          </td>
          <td>{{ $row['bidang_bisnis'] }}</td>
          <td>{{ $row['metode_bayar'] }}</td>
          <td>
            <?php
            if ($row['url_proposal']) {
              echo "<a href=". asset('storage/bukti_bayar/mis/'.rawurlencode($row['url_bukti_bayar']))." target='_blank'>".$row['url_bukti_bayar']."</a>";
            }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Nomor HP</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Kota Domisili</th>
        <th>Pekerjaan</th>
        <th>Jenis Kelamin</th>
        <th>Role</th>
        <th>Proposal</th>
        <th>Bidang Bisnis</th>
        <th>Metode Bayar</th>
        <th>Bukti Bayar</th>
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
    $("#datamis").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "pagingType": "simple",
      "buttons": [
        {
          text: "Excel",
          action: function(e, dt, node, config) {
            window.location.href = "{{ url('/miadmin/xlsmis') }}";
          }
        },
        "colvis"
      ]
    }).buttons().container().appendTo('#datamis_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection()
