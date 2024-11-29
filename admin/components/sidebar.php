<?php 
    $current_page = $_SERVER['REQUEST_URI'];
?>

<ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/">
        <!-- <div class="sidebar-brand-text mx-3">BliWayan</div> -->
        <div class="sidebar-brand-icon">
            <!-- Tambahkan logo di sini -->
            <img src="/images/logo-bw.png" style="height: 50px;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item active"> -->
    <li class="nav-item <?php echo ($current_page == '/admin/' ? 'active' : ''); ?>">
        <a class="nav-link" href="/admin/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Interface
    </div> -->
    <li class="nav-item <?php echo (str_starts_with($current_page, '/admin/about-settings') ? 'active' : '')?>">
        <a class="nav-link" href="/admin/about-settings">
            <i class="fas fa-fw fa-server"></i>
            <span>About Setting</span></a>
    </li>
    <li class="nav-item <?php echo (str_starts_with($current_page, '/admin/menu') ? 'active' : '')?>">
        <a class="nav-link" href="/admin/menu">
            <i class="fas fa-fw fa-egg"></i>
            <span>Menu</span></a>
    </li>
    <li class="nav-item <?php echo (str_starts_with($current_page, '/admin/gallery') ? 'active' : '')?>">
        <a class="nav-link" href="/admin/gallery">
            <i class="fas fa-fw fa-file"></i>
            <span>Gallery</span></a>
    </li>
    <li class="nav-item <?php echo (str_starts_with($current_page, '/admin/user-messages') ? 'active' : '')?>">
        <a class="nav-link" href="/admin/user-messages">
            <i class="fas fa-fw fa-envelope"></i>
            <span>User Messages</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>