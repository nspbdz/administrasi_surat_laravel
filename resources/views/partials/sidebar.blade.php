<?php
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{asset('logo/logo fkdt.jpg')}}" alt="logo" width="70">
        </div>
        <br>
        <div class="sidebar-brand">
            <a href="index.html">Administrasi Surat</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AS</a>
        </div>
        <ul class="sidebar-menu">

            <!-- @if(auth()->user()->roles[0]['code'] == 'dpc' || auth()->user()->roles[0]['code'] == 'dpp' || auth()->user()->roles[0]['code'] == 'dpw' )
            @else -->
            @can('dashboard')
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="/"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @endcan

            <!-- @endif -->

            <li class="menu-header">Menu</li>
            @can('jadwal_surat-index')
            <li class="{{ request()->is('jadwalSurat*') ? 'active' : '' }}"><a class=" nav-link" href="{{ route('jadwalSurat.index') }}"><i class="fas fa-clipboard-list"></i> <span>Jadwal Surat</span></a></li>
            @endcan

            @can('surat_masuk-index')
            <li class="{{ request()->is('suratMasuk*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('suratMasuk.index') }}"><i class="fas fa-envelope-open"></i> <span>Surat Masuk</span></a></li>
            @endcan
            <li class="dropdown {{ Request::is('suratkeluar*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-envelope"></i>
                    <span>Surat Keluar</span>
                </a>
                <ul class="dropdown-menu">
                    @can('surat_pemberitahuan-index')
                    <li class="{{ request()->is('suratkeluar/suratPemberitahuan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('suratPemberitahuan.index') }}">Surat Pemberitahuan</a></li>
                    @endcan

                    @can('surat_tugas-index')
                    <li class="{{ request()->is('suratkeluar/suratTugas*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('suratTugas.index') }}">Surat Tugas</a></li>
                    @endcan

                    @can('surat_dispensasi-index')
                    <li class="{{ request()->is('suratkeluar/suratDispensasi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('suratDispensasi.index') }}">Surat Dispensasi</a></li>
                    @endcan

                    @can('surat_undangan-index')
                    <li class="{{ request()->is('suratkeluar/suratUndangan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('suratUndangan.index') }}">Surat Undangan</a></li>
                    @endcan
                </ul>
            </li>

            @can('dokumen-index')

            <li class="dropdown {{ Request::is('dokumenData*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-folder"></i>
                    <span>Dokumen</span>
                </a>
                <ul class="dropdown-menu">
                    @can('file_blanko-index')
                    <li class="{{ request()->is('dokumenData/dokumenBlanko*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dokumenBlanko.index') }}">File Blanko</a></li>
                    @endcan

                    @can('file_surat-keluar-index')
                    <li class="{{ request()->is('dokumenData/dokumenSurat*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dokumenSurat.index') }}">File Surat Keluar</a></li>
                    @endcan

                    @can('file_sertifikat-index')
                    <li class="{{ request()->is('dokumenData/dokumenSertifikat*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dokumenSertifikat.index') }}">File Sertifikat</a></li>
                    @endcan

                </ul>
            </li>
            @endcan


            <li class="menu-header">Menu Lainnya</li>

            @can('auth')
            <li class="{{ request()->is('auth/users*') ? 'active' : '' }}"><a class="nav-link" href="/auth/users"><i class="fas fa-user"></i> <span>User Management</span></a></li>
            @endcan

            <li class="{{ request()->is('instansi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('instansi.index') }}"><i class="fas fa-building"></i> <span>Data Instansi</span></a></li>
    </aside>
</div>
