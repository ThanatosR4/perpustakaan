<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="/dashboard">SMAN 1 Teluk Keramat</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="/dashboard">
          <img alt="Foto Profil" src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('images/default-avatar.png') }}" class="rounded-circle mr-1" style="max-width: 32px;">
    </a>    
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
          <a href="/dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Data</li>
        <li>
          <a href="/kategori" class="nav-link"><i class="fas fa-list"></i><span>Kategori</span></a>
          <a href="/siswa" class="nav-link"><i class="fas fa-user-graduate"></i><span>Siswa</span></a>
          <a href="/buku" class="nav-link"><i class="fas fa-book"></i><span>Buku</span></a>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-exchange-alt"></i><span>Aktivitas</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="/peminjaman"><i class="fas fa-book-reader"></i> Peminjaman</a></li>
              <li><a class="nav-link" href="/pengembalian"><i class="fas fa-book-open"></i> Pengembalian</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link"><i class="fas fa-file-alt"></i><span>Laporan</span></a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Pengaturan</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="/pengaturan/peminjaman"><i class="fas fa-clock"></i> Aturan Peminjaman</a></li>
              <li><a class="nav-link" href="/pengaturan/denda"><i class="fas fa-money-bill-wave"></i> Aturan Denda</a></li>
            </ul>
          </li>
        </li>
      </ul>
  </aside>
</div>