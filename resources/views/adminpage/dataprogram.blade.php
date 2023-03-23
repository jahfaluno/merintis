@extends('template.adminlte')

@section('additionalcss')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                <a href="{{ url('/miadmin/datamis') }}" class="nav-link">
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
              <a href="{{ url('/miadmin/dataprogram') }}" class="nav-link active">
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
    <h3 class="card-title">Data Program Merintis Indonesia</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="dataprogram" class="table table-bordered table-striped">
      <thead class="bg-success">
      <tr>
        <th>No</th>
        <th>Nama Program</th>
        <th>Nama Kegiatan</th>
        <th>Pamflet</th>
        <th>Link Daftar</th>
        <th>Deskripsi</th>
        <th>Sasaran</th>
        <th>Perlengkapan</th>
        <th>Mentor</th>
        <th>Link CV</th>
        <th>Metode Pelaksanaan</th>
        <th>Link G-Map</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Jam Tambahan</th>
        <th>Biaya</th>
        <th>Harga Normal</th>
        <th>Harga Promo</th>
        <th>Link Jadwal</th>
        <th>Link Dokumentasi</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody id="tbl-data">
      <?php
        $no = 0;
        foreach ($dtProgram as $row):
      ?>
        <tr>
          <td>{{ ++$no }}</td>
          <td>{{ $row['nama_program'] }}</td>
          <td>{{ $row['nama_kegiatan'] }}</td>
          <td>
            <a href="{{ asset('storage/images/programs/'.rawurlencode($row['link_pamflet'])) }}" target="_blank">
              {{ $row['link_pamflet'] }}
            </a>
          </td>
          <td>
            <?php
                $linkdaftar = '';
                if ($row['link_daftar'] == 'mistalk' || $row['link_daftar'] == 'coachclinic' || $row['link_daftar'] == 'kubis') {
                  $linkdaftar = url('/program/daftar'.'/'.$row['link_daftar'].'/'.$row['id']);
                } else {
                  $linkdaftar = $row['link_daftar'];
                }
            ?>
            <a href="{{ $linkdaftar }}" target="_blank">
              {{ $row['link_daftar'] }}
            </a>
          </td>
          <td>{!! $row['desc_program'] !!}</td>
          <td>{{ $row['sasaran_program'] }}</td>
          <td>{{ $row['perlengkapan'] }}</td>
          <td>{{ $row['mentor'] }}</td>
          <td>{!! ($row['link_cv']) ? '<a href="'.$row['link_cv'].'" target="_blank">'.$row['link_cv'].'</a>' : '' !!}</td>
          <td>{{ $row['metode_pelaksanaan'] }}</td>
          <td>
            <?php
              if ($row['link_map']) {
                  echo "<a href='".$row['link_map']."' target='_blank'>".$row['link_map']."</a>";
              } else {
                  echo "-";
              }
            ?>
          </td>
          <td>{{ $row['tgl_mulai'] }}</td>
          <td>
            <?php
              $dateStr = strtotime($row['tgl_selesai']);
              if ($dateStr == strtotime('0000-00-00')) {
                echo "-";
              } else {
                echo $row['tgl_selesai'];
              }
            ?>
          </td>
          <td>{{ $row['jam_mulai'] }} WIB</td>
          <td>{{ $row['jam_selesai'] }} WIB</td>
          <td>
              <?php
                if($row['jam_tambahan']) {
                    echo $row['jam_tambahan'].' WIB';
                }
              ?>
          </td>
          <td>{{ $row['biaya'] }}</td>
          <td> <span class="numeric">{{ $row['harga_normal'] }}</span> </td>
          <td> <span class="numeric">{{ $row['harga_promo'] }}</span> </td>
          <td>
            <?php
            if ($row['link_jadwal']) {
              echo "<a href='".$row['link_jadwal']."' target='_blank'>".$row['link_jadwal']."</a>";
            } else {
              echo "-";
            }
            ?>
          </td>
          <td>
            <?php
            if ($row['link_dokumentasi']) {
              echo "<a href='".$row['link_dokumentasi']."' target='_blank'>".$row['link_dokumentasi']."</a>";
            } else {
              echo "-";
            }
            ?>
          </td>
          <td>{{ $row['status'] }}</td>
          <td>
            <a href="{{ url('/miadmin/ubahprogram/'.$row['id']) }}" class="btn btn-warning">Edit</a> |
            <a href="javascript:void(0)" onclick="hapus({{ $row['id'] }});" class="btn btn-danger">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>No</th>
        <th>Nama Program</th>
        <th>Nama Kegiatan</th>
        <th>Pamflet</th>
        <th>Link Daftar</th>
        <th>Deskripsi</th>
        <th>Sasaran</th>
        <th>Perlengkapan</th>
        <th>Mentor</th>
        <th>Link CV</th>
        <th>Metode Pelaksanaan</th>
        <th>Link G-Map</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Jam Tambahan</th>
        <th>Biaya</th>
        <th>Harga Normal</th>
        <th>Harga Promo</th>
        <th>Link Jadwal</th>
        <th>Link Dokumentasi</th>
        <th>Status</th>
        <th>Aksi</th>
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
<script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
<!-- Page specific script -->
<script>
  // ===== NUMERIC ====
  const IDR = value => currency(value, { symbol: "Rp", precision: 0, separator: ".", decimal: "," })
  $(document).ready(function() {
      $('.numeric').each(function(i, obj) {
          let harga = IDR($('.numeric').eq(i).text()).format()
          $('.numeric').eq(i).text(harga)
      })
  })
  // ===== END NUMERIC ====

  $(function () {
    $("#dataprogram").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "pagingType": "simple",
      "buttons": ["colvis"]
    }).buttons().container().appendTo('#dataprogram_wrapper .col-md-6:eq(0)');
  });

  function hapus(id) {
    // Konfirmasi
    if (confirm("Apakah Anda yakin menghapusnya?")) {
      // Hapus Program
      $.ajax({
        type: "get",
        url: "{{ url('/miadmin/hapusprogram') }}/"+id,
        success: function(data) {
          console.log(data)
          if (data.success === true && data.success !== null) {
            alert(data.message)
            location.reload(true)
          } else {
            alert(data.message)
          }
        },
        error: function(err) {
          console.error(err)
        }
      })
    }
  }
</script>
@endsection
