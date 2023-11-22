<?php $page =  $_GET['page']; ?>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php?page=Dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../assets/images/logo_MAA.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo_MAAA.png" alt="" height="35">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php?page=Dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="../assets/images/logo_MAA.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo_MAAA.png" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user') { ?>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link<?php if ($page == 'Dashboard') echo 'active'; ?>" href="index.php?page=Dashboard" aria-expanded="false">
                            <i class="ri-dashboard-2-line"></i> <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php if ($page == 'ITSupport') echo 'active'; ?>" href="index.php?page=ITSupport" aria-expanded="false">
                            <i class=" ri-mac-line"></i> <span> IT-Support </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" <?php if ($page == 'GAFacilities') echo 'active'; ?> href="#ga" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="ga">
                            <i class="ri-tools-fill"></i> <span>GA Facilities</span>
                        </a>
                        <div class="collapse menu-dropdown" id="ga">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="index.php?page=ATK/Stationary" class="nav-link">ATK /
                                        Stationary</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=Maintenance" class="nav-link">Building
                                        Maintenance Support</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=OtherFacilities" class="nav-link">Other Facilities
                                        Request</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php if ($page == 'Delivery') echo 'active'; ?>" href="index.php?page=Delivery" aria-expanded="false">
                            <i class="mdi mdi-truck-fast-outline"></i> <span> Delivery </span>
                        </a>
                    </li>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
                        <li class="menu-title"><span data-key="t-menu">Admin Access</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link<?= ($page == 'Administrator') ? ' active' : ''; ?>" href="#admin" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="admin">
                                <i class="ri-admin-fill"></i> <span>Administrator</span>
                            </a>
                            <div class="collapse menu-dropdown" id="admin">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="index.php?page=AccessAdministrator" class="nav-link"> Access Admin </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.php?page=MenuAdministrator" class="nav-link"> Menu Admin </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>

                </ul>
            <?php    } ?>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>