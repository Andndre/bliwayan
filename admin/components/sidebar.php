<?php 
    $current_page = $_SERVER['REQUEST_URI'];
?>

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">BliWayan</div>
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
    <div class="sidebar-heading">
        Interface
    </div>
    <li class="nav-item">
        <a class="nav-link" href="/admin/utilities.php">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span></a>
    </li>
    <li class="nav-item <?php echo ($current_page == '/admin/about-settings' ? 'active' : '')?>">
        <a class="nav-link" href="/admin/about-settings">
            <i class="fas fa-fw fa-server"></i>
            <span>About Setting</span></a>
    </li>
    <li class="nav-item <?php echo ($current_page == '/admin/menu' ? 'active' : '')?>">
        <a class="nav-link" href="/admin/menu">
            <i class="fas fa-fw fa-egg"></i>
            <span>Menu</span></a>
    </li>
    <li class="nav-item <?php echo ($current_page == '/admin/gallery' ? 'active' : '')?>">
        <a class="nav-link" href="/admin/gallery">
            <i class="fas fa-fw fa-file"></i>
            <span>gallery</span></a>
    </li>
    


    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> -->


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    

</ul>