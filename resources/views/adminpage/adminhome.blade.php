@extends('template.adminlte')

@section('sidebarMenu')
{{-- Sidebar Menu --}}
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
        <a href="{{ url('/miadmin/homeadmin') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Kumpulan Data
            </p>
        </a>
        </li>
        <li class="nav-item root-item">
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
{{-- ./Sidebar Menu --}}
@endsection

@section('content')
<h4 class="m-0 py-2">Data Merintis Indonesia Summit 2021</h4>

{{-- Small boxes (Stat box) --}}
<div class="row">
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $data['ttl_user'] }} </h3>
        <p>Peserta Terdaftar</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ url('/miadmin/datamis') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-warning">
      <div class="inner">
        <h3> {{ $data['ttl_proposal'] }}</h3>
        <p>Submit Proposal</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{ url('/miadmin/datamis') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
</div>
{{-- /.row --}}

<h4 class="m-0 py-2">Data Top Finalis 50 MIS 2021</h4>
{{-- Small boxes (Stat box) --}}
<div class="row">
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $data['ttl_video'] }}<sub>/50</sub></h3>
        <p>Submit Link YT</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{ url('/miadmin/datafinalis') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
</div>
{{-- /.row --}}

<h4 class="m-0 py-2">Data Program Merintis Indonesia</h4>
{{-- Small boxes (Stat box) --}}
<div class="row">
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $data['jmlProgram'] }}</h3>
        <p>Jumlah Program</p>
      </div>
      <div class="icon">
        <i class="ion ion-calendar"></i>
      </div>
      <a href="{{ url('/miadmin/dataprogram') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
</div>
{{-- /.row --}}

<h4 class="m-0 py-2">Data Peserta</h4>
{{-- Small boxes (Stat box) --}}
<div class="row">
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $data['jmlMistalk'] }}</h3>
        <p>Peserta Mistalk</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ url('/miadmin/datamistalk') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-warning">
      <div class="inner">
        <h3> {{ $data['jmlCclinic'] }}</h3>
        <p>Peserta Coaching Clinic</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ url('/miadmin/datacclinic') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
  <div class="col-lg-3 col-6">
    {{-- small box --}}
    <div class="small-box bg-dark">
      <div class="inner">
        <h3> {{ $data['jmlKubis'] }}</h3>
        <p>Peserta  Kuliah Bisnis</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ url('/miadmin/datakubis') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  {{-- ./col --}}
</div>
{{-- /.row --}}
@endsection
