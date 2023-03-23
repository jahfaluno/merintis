@extends('template/adminlte')

@section('additionalcss')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/add-admin.css') }}">
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
    <li class="nav-item">
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
        <a href="{{ url('/miadmin/dataprogram') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Program</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item menu-open">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-edit"></i>
        <p>
          Form
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('/miadmin/formprogram') }}" class="nav-link active">
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
<!--================ FIXED ALERT =================-->
<div class = 'fixed-alert'></div>
<!--================ END FIXED ALERT =================-->

<div class="row">
  <div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title">Form Program
          <small class="text-muted">Input/Edit Data Program</small>
        </h3>
      </div>
      <div class="card-body">

        <!-- IF ADA DATA -->
        <?php
        if (isset($dtProgram)):
          if (count($dtProgram) > 0):
        ?>
        <form id="formProgram" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nama_program">Nama Program</label>
            <input type="text" class="form-control" id="nama_program" name="nama_program" placeholder="Ex: MIS TALKSHOW #1, PROGRAM PKU, MIS 2021" value="{{ $dtProgram[0]['nama_program'] }}">
            <div class="invalid-feedback">Error nama program</div>
          </div>
          <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Ex: BEDAH PROPOSAL, BUSINESS PLAN 101, PAKET PERINTIS" value="{{ $dtProgram[0]['nama_kegiatan'] }}">
            <div class="invalid-feedback">Error nama kegiatan</div>
          </div>
          <div class="form-group">
            <label for="link_pamflet">Gambar Pamflet</label>
            <div class="col-12 my-2">
              <img src="{{ asset('storage/images/programs/'.$dtProgram[0]['link_pamflet']) }}" alt="gambar-pamflet" class="img-100">
              <br>
              <small class="text-muted">[ Gambar sebelum diubah ]</small>
            </div>
            <input type="hidden" name="pamflet_old" value="{{ $dtProgram[0]['link_pamflet'] }}">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="link_pamflet" name="link_pamflet">
                <label class="custom-file-label" for="link_pamflet">{{ $dtProgram[0]['link_pamflet'] }}</label>
              </div>
            </div>
            <small class="text-danger d-none">Error unggah pamflet</small>
          </div>
          <div class="form-group">
            <label for="desc_program">Deskripsi Program</label>
            <textarea name="desc_program" id="desc_program" cols="80" rows="10">
                {{ $dtProgram[0]['desc_program'] }}
            </textarea>
          </div>
          <div class="form-group">
            <label for="link_daftar">Link Daftar</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="link_daftar" id="mistalk" value="mistalk" <?= ($dtProgram[0]['link_daftar'] == 'mistalk') ? 'checked' : '' ?>>
              <label class="form-check-label" for="mistalk">
                MIS TALK
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="link_daftar" id="coaching" value="coachclinic" <?= ($dtProgram[0]['link_daftar'] == 'coachclinic') ? 'checked' : '' ?>>
              <label class="form-check-label" for="coaching">
                Coaching Clinic
              </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="link_daftar" id="kubis" value="kubis" <?= ($dtProgram[0]['link_daftar'] == 'kubis') ? 'checked' : '' ?>>
                <label class="form-check-label" for="kubis">
                  Kuliah Bisnis
                </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="link_daftar" id="link_custom_radio_daftar" <?= ($dtProgram[0]['link_daftar'] != 'mistalk' && $dtProgram[0]['link_daftar'] != 'coachclinic' && $dtProgram[0]['link_daftar'] != 'kubis') ? 'checked' : '' ?>>
              <label class="form-check-label" for="link_custom_radio_daftar">
                <input type="text" class="form-control" id="link_custom_text_daftar" placeholder="Isi link lainnya ...." value="<?= ($dtProgram[0]['link_daftar'] != 'mistalk' && $dtProgram[0]['link_daftar'] != 'coachclinic') ? $dtProgram[0]['link_daftar'] : '' ?>">
              </label>
              <div class="custom-err"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="link_meet">Link Meeting</label>
            <input type="text" class="form-control" id="link_meet" name="link_meet" placeholder="Link Zoom/Gmeet Jika ada" value="{{ $dtProgram[0]['link_meet'] }}">
            <div class="invalid-feedback">Error link meet</div>
          </div>
          <div class="form-group">
            <label for="sasaran_program">Sasaran Program</label>
            <input type="text" class="form-control" id="sasaran_program" name="sasaran_program" placeholder="Ex: Khusus untuk Peserta ..." value="{{ $dtProgram[0]['sasaran_program'] }}">
            <div class="invalid-feedback">Error sasaran program</div>
          </div>
          <div class="form-group">
            <label for="perlengkapan">Perlengkapan</label>
            <input type="text" class="form-control" id="perlengkapan" name="perlengkapan" placeholder="Ex: Device, Notebook, ..." value="{{ $dtProgram[0]['perlengkapan'] }}">
            <div class="invalid-feedback">Error perlengkapan</div>
          </div>
          <div class="form-group">
            <label for="mentor">Mentor</label>
            <input type="text" class="form-control" id="mentor" name="mentor" placeholder="Nama mentor" value="{{ $dtProgram[0]['mentor'] }}">
            <div class="invalid-feedback">Error mentor</div>
          </div>
          <div class="form-group">
            <label for="profesi">Profesi</label>
            <input type="text" class="form-control" id="profesi" name="profesi" placeholder="Profesi Mentor" value="{{ $dtProgram[0]['profesi'] }}">
            <div class="invalid-feedback">Error profesi</div>
          </div>
          <div class="form-group">
            <label for="link_cv">Link CV</label>
            <input type="text" class="form-control" id="link_cv" name="link_cv" placeholder="Link CV ..." value="{{ $dtProgram[0]['link_cv'] }}">
            <div class="invalid-feedback">Link CV</div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 form-group">
              <label for="tgl_mulai">Tanggal Mulai</label>
              <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{ $dtProgram[0]['tgl_mulai'] }}">
              <div class="invalid-feedback">Error tanggal mulai program</div>
            </div>
            <div class="col-12 col-sm-6 form-group">
              <label for="tgl_selesai">Tanggal Selesai</label>
              <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{ $dtProgram[0]['tgl_selesai'] }}">
              <div class="invalid-feedback">Error tanggal selesai program</div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 form-group">
              <label for="jam_mulai">Jam Mulai</label>
              <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Hh:Mm" onchange="validateHhMm(this);" value="{{ $dtProgram[0]['jam_mulai'] }}">
              <div class="invalid-feedback">Error jam mulai program</div>
            </div>
            <div class="col-12 col-sm-6 form-group">
              <label for="jam_selesai">Jam Selesai</label>
              <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Hh:Mm" onchange="validateHhMm(this);" value="{{ $dtProgram[0]['jam_selesai'] }}">
              <div class="invalid-feedback">Error jam selesai program</div>
            </div>
            <div class="col-12 form-group">
                <label for="jam_tambahan">Jam Tambahan</label>
                <input type="text" class="form-control" id="jam_tambahan" name="jam_tambahan" placeholder="Jam Tambahan" value="{{ $dtProgram[0]['jam_tambahan'] }}">
                <div class="invalid-feedback">Error jam tambah</div>
            </div>
          </div>
          <div class="form-group">
            <label for="metode_pelaksanaan">Metode Pelaksanaan</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="livezoom" value="Live Zoom" <?= ($dtProgram[0]['metode_pelaksanaan'] == 'Live Zoom') ? 'checked' : '' ?>>
              <label class="form-check-label" for="livezoom">
                Live Zoom
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="liveyt" value="Live Youtube" <?= ($dtProgram[0]['metode_pelaksanaan'] == 'Live Youtube') ? 'checked' : '' ?>>
              <label class="form-check-label" for="liveyt">
                Live Youtube
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="hybridls" value="Hybrid Learning System" <?= ($dtProgram[0]['metode_pelaksanaan'] == 'Hybrid Learning System') ? 'checked' : '' ?>>
              <label class="form-check-label" for="hybridls">
                Hybrid Learning System
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="link_custom_radio_metode" <?= ($dtProgram[0]['metode_pelaksanaan'] != 'Live Zoom' && $dtProgram[0]['metode_pelaksanaan'] != 'Live Youtube' && $dtProgram[0]['metode_pelaksanaan'] != 'Hybrid Learning System') ? 'checked' : '' ?>>
              <label class="form-check-label" for="link_custom_radio_metode">
                <input type="text" class="form-control" id="link_custom_text_metode" placeholder="Lainnya ...." value="<?= ($dtProgram[0]['metode_pelaksanaan'] != 'Live Zoom' && $dtProgram[0]['metode_pelaksanaan'] != 'Live Youtube' && $dtProgram[0]['metode_pelaksanaan'] != 'Hybrid Learning System') ? $dtProgram[0]['metode_pelaksanaan'] : '' ?>">
              </label>
              <div class="custom-err"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="link_map">Link Map</label>
            <input type="url" class="form-control" id="link_map" name="link_map" placeholder="Isi Link Google Map" value="{{ $dtProgram[0]['link_map'] }}">
            <div class="invalid-feedback">Error link Map</div>
          </div>
          <div class="form-group">
              <label for="biaya">Biaya</label>
              <select class="form-control" id="biaya" name="biaya" onchange="shBiaya();">
                  <option value="" <?= ($dtProgram[0]['biaya'] != 'Gratis' && $dtProgram[0]['biaya'] != 'Berbayar') ? 'selected':'' ?>>--Pilih Satu---</option>
                  <option value="Gratis" <?= ($dtProgram[0]['biaya'] == 'Gratis') ? 'selected':'' ?>>Gratis</option>
                  <option value="Berbayar" <?= ($dtProgram[0]['biaya'] == 'Berbayar') ? 'selected':'' ?>>Berbayar</option>
              </select>
              <div class="invalid-feedback">Error biaya gaes</div>
          </div>
          <div class="row">
            <?php
              $biaya = ($dtProgram[0]['biaya'] != 'Gratis') ? '' : 'd-none'
            ?>
            <div class="col-12 col-sm-6 {{ $biaya }} form-group">
              <label for="harga_normal">Harga Normal</label>
              <input type="number" class="form-control" id="harga_normal" name="harga_normal" min="0" value="{{ $dtProgram[0]['harga_normal'] }}">
              <div class="invalid-feedback">Error harga normal gaes</div>
            </div>
            <div class="col-12 col-sm-6 {{ $biaya }} form-group">
              <label for="harga_promo">Harga Promo</label>
              <input type="number" class="form-control" id="harga_promo" name="harga_promo" min="0" value="{{ $dtProgram[0]['harga_promo'] }}">
              <div class="invalid-feedback">Error harga promo gaes</div>
            </div>
          </div>
          <div class="form-group">
            <label for="link_jadwal">Link Jadwal</label>
            <input type="url" class="form-control" id="link_jadwal" name="link_jadwal" placeholder="Isi Link Jadwal" value="{{ $dtProgram[0]['link_jadwal'] }}">
            <div class="invalid-feedback">Error link jadwal</div>
          </div>
          <div class="form-group">
            <label for="link_dokumentasi">Link Dokumentasi</label>
            <input type="url" class="form-control" id="link_dokumentasi" name="link_dokumentasi" placeholder="Isi Link Dokumentasi" value="{{ $dtProgram[0]['link_dokumentasi'] }}">
            <div class="invalid-feedback">Error link dokumentasi</div>
          </div>
          <div class="form-group">
            <label for="status">Status Program</label>
            <select class="form-control" id="status" name="status">
                <option value="" <?= ($dtProgram[0]['status'] != 'past' && $dtProgram[0]['status'] != 'on-going' && $dtProgram[0]['status'] != 'upcoming' ) ? 'selected' : '' ?>>-- Pilih Status --</option>
                <option value="past" <?= ($dtProgram[0]['status'] == 'past') ? 'selected' : '' ?>>Past</option>
                <option value="on-going" <?= ($dtProgram[0]['status'] == 'on-going') ? 'selected' : '' ?>>On-Going</option>
                <option value="upcoming" <?= ($dtProgram[0]['status'] == 'upcoming') ? 'selected' : '' ?>>Upcoming</option>
            </select>
            <div class="invalid-feedback">Error status program</div>
          </div>
          <input type="hidden" name="id_program" id="id_program" value="<?= $dtProgram[0]['id'] ?>">
        </form>
        <button class="btn btn-primary" id="simpanUbah">Submit</button>

        <?php
          endif;
        else:
        ?>

        <!-- IF TIDAK ADA DATA -->
        <form id="formProgram" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama_program">Nama Program</label>
            <input type="text" class="form-control" id="nama_program" name="nama_program" placeholder="Ex: MIS TALKSHOW #1, PROGRAM PKU, MIS 2021">
            <div class="invalid-feedback">Error nama program</div>
          </div>
          <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Ex: BEDAH PROPOSAL, BUSINESS PLAN 101, PAKET PERINTIS">
            <div class="invalid-feedback">Error nama kegiatan</div>
          </div>
          <div class="form-group">
            <label for="link_pamflet">Gambar Pamflet</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="link_pamflet" name="link_pamflet">
                <label class="custom-file-label" for="link_pamflet">Unggah file jpeg/jpg/png</label>
              </div>
            </div>
            <small class="text-danger d-none">Error unggah pamflet</small>
          </div>
          <div class="form-group">
            <label for="desc_program">Deskripsi Program</label>
            <textarea name="desc_program" id="desc_program" cols="80" rows="10">
                <p>Tuliskan Deskripsi Program di sini</p>
            </textarea>
          </div>
          <div class="form-group">
            <label for="link_daftar">Link Daftar</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="link_daftar" id="mistalk" value="mistalk">
              <label class="form-check-label" for="mistalk">
                MIS TALK
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="link_daftar" id="coaching" value="coachclinic">
              <label class="form-check-label" for="coaching">
                Coaching Clinic
              </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="link_daftar" id="kubis" value="kubis">
                <label class="form-check-label" for="kubis">
                  Kuliah Bisnis
                </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="link_daftar" id="link_custom_radio_daftar">
              <label class="form-check-label" for="link_custom_radio_daftar">
                <input type="text" class="form-control" id="link_custom_text_daftar" placeholder="Isi link lainnya ....">
              </label>
              <div class="custom-err"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="link_meet">Link Meeting</label>
            <input type="text" class="form-control" id="link_meet" name="link_meet" placeholder="Link Zoom/Gmeet Jika ada">
            <div class="invalid-feedback">Error link meet</div>
          </div>
          <div class="form-group">
            <label for="sasaran_program">Sasaran Program</label>
            <input type="text" class="form-control" id="sasaran_program" name="sasaran_program" placeholder="Ex: Khusus untuk Peserta ...">
            <div class="invalid-feedback">Error sasaran program</div>
          </div>
          <div class="form-group">
            <label for="perlengkapan">Perlengkapan</label>
            <input type="text" class="form-control" id="perlengkapan" name="perlengkapan" placeholder="Ex: Device, Notebook, ...">
            <div class="invalid-feedback">Error perlengkapan</div>
          </div>
          <div class="form-group">
            <label for="mentor">Mentor</label>
            <input type="text" class="form-control" id="mentor" name="mentor" placeholder="Nama mentor">
            <div class="invalid-feedback">Error mentor</div>
          </div>
          <div class="form-group">
            <label for="profesi">Profesi</label>
            <input type="text" class="form-control" id="profesi" name="profesi" placeholder="Profesi Mentor">
            <div class="invalid-feedback">Error profesi</div>
          </div>
          <div class="form-group">
            <label for="link_cv">Link CV</label>
            <input type="text" class="form-control" id="link_cv" name="link_cv" placeholder="Link CV ...">
            <div class="invalid-feedback">Link CV</div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 form-group">
              <label for="tgl_mulai">Tanggal Mulai</label>
              <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
              <div class="invalid-feedback">Error tanggal mulai program</div>
            </div>
            <div class="col-12 col-sm-6 form-group">
              <label for="tgl_selesai">Tanggal Selesai</label>
              <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai">
              <div class="invalid-feedback">Error tanggal selesai program</div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 form-group">
              <label for="jam_mulai">Jam Mulai</label>
              <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Hh:Mm" onchange="validateHhMm(this);">
              <div class="invalid-feedback">Error jam mulai program</div>
            </div>
            <div class="col-12 col-sm-6 form-group">
              <label for="jam_selesai">Jam Selesai</label>
              <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Hh:Mm" onchange="validateHhMm(this);">
              <div class="invalid-feedback">Error jam selesai program</div>
            </div>
            <div class="col-12 form-group">
              <label for="jam_tambahan">Jam Tambahan</label>
              <input type="text" class="form-control" id="jam_tambahan" name="jam_tambahan" placeholder="Jam Tambahan">
              <div class="invalid-feedback">Error jam tambah</div>
            </div>
          </div>
          <div class="form-group">
            <label for="metode_pelaksanaan">Metode Pelaksanaan</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="livezoom" value="Live Zoom">
              <label class="form-check-label" for="livezoom">
                Live Zoom
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="liveyt" value="Live Youtube">
              <label class="form-check-label" for="liveyt">
                Live Youtube
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="hybridls" value="Hybrid Learning System">
              <label class="form-check-label" for="hybridls">
                Hybrid Learning System
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pelaksanaan" id="link_custom_radio_metode">
              <label class="form-check-label" for="link_custom_radio_metode">
                <input type="text" class="form-control" id="link_custom_text_metode" placeholder="Lainnya ....">
              </label>
              <div class="custom-err"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="link_map">Link Map</label>
            <input type="url" class="form-control" id="link_map" name="link_map" placeholder="https://goo.gl/maps/xxxx">
            <div class="invalid-feedback">Error link Map</div>
          </div>
          <div class="form-group">
              <label for="biaya">Biaya</label>
              <select class="form-control" id="biaya" name="biaya" onchange="shBiaya();">
                  <option value="" selected>--Pilih Satu---</option>
                  <option value="Gratis">Gratis</option>
                  <option value="Berbayar">Berbayar</option>
              </select>
              <div class="invalid-feedback">Error biaya gaes</div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 d-none form-group">
              <label for="harga_normal">Harga Normal</label>
              <input type="number" class="form-control" id="harga_normal" name="harga_normal" min="0">
              <div class="invalid-feedback">Error harga normal gaes</div>
            </div>
            <div class="col-12 col-sm-6 d-none form-group">
              <label for="harga_promo">Harga Promo</label>
              <input type="number" class="form-control" id="harga_promo" name="harga_promo" min="0">
              <div class="invalid-feedback">Error harga promo gaes</div>
            </div>
          </div>
          <div class="form-group">
            <label for="link_jadwal">Link Jadwal</label>
            <input type="url" class="form-control" id="link_jadwal" name="link_jadwal" placeholder="Isi Link Jadwal">
            <div class="invalid-feedback">Error link jadwal</div>
          </div>
          <div class="form-group">
            <label for="link_dokumentasi">Link Dokumentasi</label>
            <input type="url" class="form-control" id="link_dokumentasi" name="link_dokumentasi" placeholder="Isi Link Dokumentasi">
            <div class="invalid-feedback">Error link dokumentasi</div>
          </div>
          <div class="form-group">
            <label for="status">Status Program</label>
            <select class="form-control" id="status" name="status">
                <option value="" selected>-- Pilih Status --</option>
                <option value="past">Past</option>
                <option value="on-going">On-Going</option>
                <option value="upcoming">Upcoming</option>
            </select>
            <div class="invalid-feedback">Error status program</div>
          </div>
        </form>
        <button class="btn btn-primary" id="simpan">Submit</button>

        <?php endif ?>

      </div>
    </div>
  </div>
</div>
@endsection

@section('additionaljs')
<script src="{{ url('/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ url('/plugins/codemirror/codemirror.js') }}"></script>
<script>
  $(document).ready(function() {
    //Summernote Editor
    $("#desc_program").summernote({
      height: 150,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize', 'fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['misc', ['codeview', 'help', 'fullscreen']]
      ]
    })

    // Form input file bootstrap 4
    $('input[type="file"]').change(function(e){
      var fileName = e.target.files[0].name
      $('.custom-file-label').html(fileName)
    })
})

// Onchange Time Input
function validateHhMm(inputField) {
  let isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

  if (isValid) {
    $('#'+inputField.id).removeClass('is-invalid')
  } else {
    $('#'+inputField.id).addClass('is-invalid')
    $('#'+inputField.id+'~ .invalid-feedback').html('*Waktu Tidak Valid *Format waktu Hh:Mm')
  }

  return isValid;
}

// SHOW HIDE HARGA BAYAR
function shBiaya() {
  let pilihan = $('#biaya').val()
  if (pilihan == 'Gratis') {
    $('#harga_promo').val(0)
    $('#harga_normal').val(0)
    $('div:has(> #harga_promo)').addClass('d-none')
    $('div:has(> #harga_normal)').addClass('d-none')
  } else if(pilihan == 'Berbayar') {
    //Tampilkan Input Harga
    $('div:has(> #harga_promo)').removeClass('d-none')
    $('div:has(> #harga_normal)').removeClass('d-none')
    // $('#harga_normal').attr('required', true)
  }
}

// KUMPULAN ALERT
  // = AL FIXED
  // ------------------ FIXED ALERT
  function alFixedBerhasil(pesan) {
    let alBerhasil = `
    <div class="alert alert-success shadow alert-dismissible fade show" role="alert">
    <div id="text-berhasil">${pesan}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    `
    $('.fixed-alert').html(alBerhasil)
    $('.fixed-alert').html(alBerhasil).animate({
      right: '12px'
    })

    $('.fixed-alert .close').on("click", function() {
      $('.fixed-alert').animate({
        right: '-100px'
      });
      $('.fixed-alert .alert').removeClass('.show');
    })
  }

  function alFixedGagal(pesan) {
    let alGagal = `
    <div class="alert alert-danger shadow alert-dismissible fade show" role="alert">
    <div id="text-berhasil">${pesan}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    `
    $('.fixed-alert').html(alGagal).animate({
      right: '12px'
    })

    $('.fixed-alert .close').on("click", function() {
      $('.fixed-alert').animate({
        right: '-100px'
      });
      $('.fixed-alert .alert').removeClass('.show');
    })
  }
  // -------------------------- END FIXED ALERT

// SIMPAN PROGRAM
$('#simpan').on("click", function() {
  // input radio dengan text metode
  let textMetode = $('#link_custom_text_metode').val()
  $('#link_custom_radio_metode').val(textMetode)
  // input radio dengan text daftar
  let textDaftar = $('#link_custom_text_daftar').val()
  $('#link_custom_radio_daftar').val(textDaftar)
  // harga normal jika berbayar
  let pilihan = $('#biaya').val()
  let harganor = $('#harga_normal').val()
  if (pilihan == 'Berbayar' && harganor == '') {
    $('#harga_normal').addClass('is-invalid')
    $('#harga_normal + .invalid-feedback').html('Harga normal wajib diisi')
  } else {
    $('#harga_normal').removeClass('is-invalid')
    let formData = new FormData($('#formProgram')[0]);
    formData.append('_token', '{{ csrf_token() }}');
    $.ajax({
      type: "post",
      url: "{{ url('/miadmin/inputprogram') }}",
      contentType: false,
      cache: false,
      processData: false,
      data: formData,
      beforeSend: function() {
        $("#simpan").addClass('bg-secondary')
        $("#simpan").attr('disabled', true)
      },
      success: function(data) {
        $("#simpan").removeClass('bg-secondary')
        $("#simpan").attr('disabled', false)
        console.log(data)
        if (data.success == false) {
          alFixedGagal('Periksa form kembali!');
          // = Nama_Program
          if (data.errors && data.errors.nama_program) {
            // Munculkan invalid
            $('#nama_program').addClass('is-invalid')
            $('#nama_program + .invalid-feedback').html(data.errors.nama_program)
          } else {
            // Hapus invalid
            $('#nama_program').removeClass('is-invalid')
          }

          //  = Nama_Kegiatan
          if (data.errors && data.errors.nama_kegiatan) {
            // Munculkan invalid
            $('#nama_kegiatan').addClass('is-invalid')
            $('#nama_kegiatan + .invalid-feedback').html(data.errors.nama_kegiatan)
          } else {
            // Hapus invalid
            $('#nama_kegiatan').removeClass('is-invalid')
          }

          // = Gambar Pamflet
          if (data.errors && data.errors.link_pamflet) {
            // Munculkan invalid
            $('#link_pamflet').addClass('is-invalid')
            $('div:has(> .custom-file) + small').removeClass('d-none')
            $('div:has(> .custom-file) + .text-danger').html(data.errors.link_pamflet+' ')
          } else {
            // Hapus invalid
            $('#link_pamflet').removeClass('is-invalid')
            $('div:has(> .custom-file) + small').addClass('d-none')
          }

          // = Link Daftar
          if (data.errors && data.errors.link_daftar) {
            // Munculkan invalid
            $('.custom-err').eq(0).html(data.errors.link_daftar)
          } else {
            // Hapus invalid
            $('.custom-err').eq(0).html('')
          }

          // = Sasaran program
          if (data.errors && data.errors.sasaran_program) {
            // Munculkan invalid
            $('#sasaran_program').addClass('is-invalid')
            $('#sasaran_program + .invalid-feedback').html(data.errors.sasaran_program)
          } else {
            // Hapus invalid
            $('#sasaran_program').removeClass('is-invalid')
          }

          // = Tanggal mulai
          if (data.errors && data.errors.tgl_mulai) {
            // Munculkan invalid
            $('#tgl_mulai').addClass('is-invalid')
            $('#tgl_mulai + .invalid-feedback').html(data.errors.tgl_mulai)
          } else {
            // Hapus invalid
            $('#tgl_mulai').removeClass('is-invalid')
          }

          // = Jam mulai
          if (data.errors && data.errors.jam_mulai) {
            // Munculkan invalid
            $('#jam_mulai').addClass('is-invalid')
            $('#jam_mulai + .invalid-feedback').html(data.errors.jam_mulai)
          } else {
            // Hapus invalid
            $('#jam_mulai').removeClass('is-invalid')
          }

          // = Jam selesai
          if (data.errors && data.errors.jam_selesai) {
            // Munculkan invalid
            $('#jam_selesai').addClass('is-invalid')
            $('#jam_selesai + .invalid-feedback').html(data.errors.jam_selesai)
          } else {
            // Hapus invalid
            $('#jam_selesai').removeClass('is-invalid')
          }

          // = Biaya
          if (data.errors && data.errors.biaya) {
            // Munculkan invalid
            $('#biaya').addClass('is-invalid')
            $('#biaya + .invalid-feedback').html(data.errors.biaya)
          } else {
            // Hapus invalid
            $('#biaya').removeClass('is-invalid')
          }

          // = Status
          if (data.errors && data.errors.status) {
            // Munculkan invalid
            $('#status').addClass('is-invalid')
            $('#status + .invalid-feedback').html(data.errors.status)
          } else {
            // Hapus invalid
            $('#status').removeClass('is-invalid')
          }

          // = Metode Pelaksanaan
          if (data.errors && data.errors.metode_pelaksanaan) {
            // Munculkan invalid
            $('.custom-err').eq(1).html(data.errors.metode_pelaksanaan)
          } else {
            // Hapus invalid
            $('.custom-err').eq(1).html('')
          }

          // Gagal disimpan
          if (data.message) {
            alFixedGagal(data.message)
          }

        } else {
          // Jika Sukses Maka ...
          $('#nama_program').removeClass('is-invalid')
          $('#nama_kegiatan').removeClass('is-invalid')
          $('#link_pamflet').removeClass('is-invalid')
          $('div:has(> .custom-file) + small').addClass('d-none')
          $('.custom-err').eq(0).html('')
          $('.custom-err').eq(1).html('')
          $('#sasaran_program').removeClass('is-invalid')
          $('#tgl_mulai').removeClass('is-invalid')
          $('#jam_mulai').removeClass('is-invalid')
          $('#jam_selesai').removeClass('is-invalid')
          $('#biaya').removeClass('is-invalid')
          $('#status').removeClass('is-invalid')
          // ==== Alert berhasil disimpan
          alFixedBerhasil(data.message)
          // === Reset Form
          $('#formProgram')[0].reset();
          $("#link_pamflet").val(null);
          $('.custom-file-label').html('Unggah file jpeg/jpg/png');
          $('#desc_program').summernote('code', '<p>Tuliskan Deskripsi Program di sini</p>')
        }
      },
      error: function(err) {
        console.error(err);
        alFixedGagal(err.responseJSON.message)
        $("#simpan").attr('disabled', false)
      }
    })
  }
})
// END SIMPAN PROGRAM

// SIMPAN UBAH
$('#simpanUbah').on("click", function() {
  let formData = new FormData($('#formProgram')[0])
  // input radio dengan text metode
  let textMetode = $('#link_custom_text_metode').val()
  $('#link_custom_radio_metode').val(textMetode)
  // input radio dengan text daftar
  let textDaftar = $('#link_custom_text_daftar').val()
  $('#link_custom_radio_daftar').val(textDaftar)
  // harga normal jika berbayar
  let pilihan = $('#biaya').val()
  let harganor = $('#harga_normal').val()
  if (pilihan == 'Berbayar' && harganor == '') {
    $('#harga_normal').addClass('is-invalid')
    $('#harga_normal + .invalid-feedback').html('Harga normal wajib diisi')
  } else {
    $('#harga_normal').removeClass('is-invalid')
    let formData = new FormData($('#formProgram')[0]);
    $('#harga_normal').removeClass('is-invalid')
    $.ajax({
      type: "post",
      url: "{{ url('/miadmin/prsubahprogram') }}",
      contentType: false,
      cache: false,
      processData: false,
      data: formData,
      beforeSend: function() {
        $("#simpanUbah").addClass('bg-secondary')
        $("#simpanUbah").attr('disabled', true)
      },
      success: function(data) {
        $("#simpanUbah").removeClass('bg-secondary')
        $("#simpanUbah").attr('disabled', false)
        console.log(data)
        if (data.success == false) {
          alFixedGagal('Periksa form kembali!');
          // = Nama_Program
          if (data.errors && data.errors.nama_program) {
            // Munculkan invalid
            $('#nama_program').addClass('is-invalid')
            $('#nama_program + .invalid-feedback').html(data.errors.nama_program)
          } else {
            // Hapus invalid
            $('#nama_program').removeClass('is-invalid')
          }

          //  = Nama_Kegiatan
          if (data.errors && data.errors.nama_kegiatan) {
            // Munculkan invalid
            $('#nama_kegiatan').addClass('is-invalid')
            $('#nama_kegiatan + .invalid-feedback').html(data.errors.nama_kegiatan)
          } else {
            // Hapus invalid
            $('#nama_kegiatan').removeClass('is-invalid')
          }

          // = Gambar Pamflet
          if (data.errors && data.errors.link_pamflet) {
            // Munculkan invalid
            $('#link_pamflet').addClass('is-invalid')
            $('div:has(> .custom-file) + small').removeClass('d-none')
            $('div:has(> .custom-file) + .text-danger').html(data.errors.link_pamflet)
          } else {
            // Hapus invalid
            $('#link_pamflet').removeClass('is-invalid')
            $('div:has(> .custom-file) + small').addClass('d-none')
          }

          // = Link Daftar
          if (data.errors && data.errors.link_daftar) {
            // Munculkan invalid
            $('#link_daftar').addClass('is-invalid')
            $('#link_daftar + .invalid-feedback').html(data.errors.link_daftar)
          } else {
            // Hapus invalid
            $('#link_daftar').removeClass('is-invalid')
          }

          // = Sasaran program
          if (data.errors && data.errors.sasaran_program) {
            // Munculkan invalid
            $('#sasaran_program').addClass('is-invalid')
            $('#sasaran_program + .invalid-feedback').html(data.errors.sasaran_program)
          } else {
            // Hapus invalid
            $('#sasaran_program').removeClass('is-invalid')
          }

          // = Tanggal mulai
          if (data.errors && data.errors.tgl_mulai) {
            // Munculkan invalid
            $('#tgl_mulai').addClass('is-invalid')
            $('#tgl_mulai + .invalid-feedback').html(data.errors.tgl_mulai)
          } else {
            // Hapus invalid
            $('#tgl_mulai').removeClass('is-invalid')
          }

          // = Jam mulai
          if (data.errors && data.errors.jam_mulai) {
            // Munculkan invalid
            $('#jam_mulai').addClass('is-invalid')
            $('#jam_mulai + .invalid-feedback').html(data.errors.jam_mulai)
          } else {
            // Hapus invalid
            $('#jam_mulai').removeClass('is-invalid')
          }

          // = Jam selesai
          if (data.errors && data.errors.jam_selesai) {
            // Munculkan invalid
            $('#jam_selesai').addClass('is-invalid')
            $('#jam_selesai + .invalid-feedback').html(data.errors.jam_selesai)
          } else {
            // Hapus invalid
            $('#jam_selesai').removeClass('is-invalid')
          }

          // = Biaya
          if (data.errors && data.errors.biaya) {
            // Munculkan invalid
            $('#biaya').addClass('is-invalid')
            $('#biaya + .invalid-feedback').html(data.errors.biaya)
          } else {
            // Hapus invalid
            $('#biaya').removeClass('is-invalid')
          }

          // = Status
          if (data.errors && data.errors.status) {
            // Munculkan invalid
            $('#status').addClass('is-invalid')
            $('#status + .invalid-feedback').html(data.errors.status)
          } else {
            // Hapus invalid
            $('#status').removeClass('is-invalid')
          }
        } else {
          // Jika Sukses Maka ...
          $('#nama_program').removeClass('is-invalid')
          $('#nama_kegiatan').removeClass('is-invalid')
          $('#link_pamflet').removeClass('is-invalid')
          $('div:has(> .custom-file) + small').addClass('d-none')
          $('#link_daftar').removeClass('is-invalid')
          $('#sasaran_program').removeClass('is-invalid')
          $('#tgl_mulai').removeClass('is-invalid')
          $('#jam_mulai').removeClass('is-invalid')
          $('#jam_selesai').removeClass('is-invalid')
          $('#biaya').removeClass('is-invalid')
          $('#status').removeClass('is-invalid')
          // ==== Alert berhasil disimpan
          alFixedBerhasil(data.message)
          // Refresh Page
          location.reload();
          // === Reset Form
          $('#formProgram')[0].reset();
          $("#link_pamflet").val(null);
          $('.custom-file-label').html('Unggah file jpeg/jpg/png');
          $('#desc_program').summernote('code', '<p>Tuliskan Deskripsi Program di sini</p>')
        }
      },
      error: function(err) {
        console.error(err);
        alFixedGagal(err.responseJSON.message)
        $("#simpan").attr('disabled', false)
      }
    })
  }
})
// END SIMPAN UBAH
</script>
@endsection
