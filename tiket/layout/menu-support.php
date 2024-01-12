<?php $page =  $_GET['page']; ?>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php?page=Dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo_MAA.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo_MAAA.png" alt="" height="35">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php?page=Dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo_MAA.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo_MAAA.png" alt="" height="35">
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
                    <a class="nav-link menu-link <?php if ($page == 'ATK/Stationary' || $page == 'Building Facilities' || $page == 'Other Facilities') echo 'active'; ?>" href="#ga2" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="ga2">
                        <i class="ri-tools-fill"></i> <span> GA Facilities </span>
                    </a>
                    <div class="collapse <?php if ($page == 'Other Facilities' || $page == 'ATK/Stationary' || $page == 'Building Facilities') echo 'show'; ?> menu-dropdown" id="ga2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="index.php?page=ATK/Stationary" class="nav-link <?php if ($page == 'ATK/Stationary') echo 'active'; ?>">ATK/Stationary</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=Building Facilities" class="nav-link <?php if ($page == 'Building Facilities') echo 'active'; ?>">Building Maintenance Support</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=Other Facilities" class="nav-link <?php if ($page == 'Other Facilities') echo 'active'; ?>">Other Facilities Request</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php if ($page == 'Delivery' || $page == 'Received') echo 'active'; ?>" href="#d" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="d">
                        <i class="mdi mdi-truck-fast-outline"></i>
                        <span> Courier Service </span>
                    </a>
                    <div class="collapse <?php if ($page == 'Received' || $page == 'Delivery') echo 'show'; ?> menu-dropdown" id="d">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="index.php?page=Delivery" class="nav-link <?php if ($page == 'Delivery') echo 'active'; ?>">Sent Package</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=Received" class="nav-link <?php if ($page == 'Received') echo 'active'; ?>">Received Package</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <?php
                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin");
                $row7 = mysqli_fetch_assoc($sql7);
                ?>

                <?php if (isset($row7['admin']) && ($row7['admin'] == '1')) : ?>
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
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php if ($page == 'ATKList') echo 'active'; ?>" href="index.php?page=ATKList" aria-expanded="false">
                            <i class="ri-scissors-fill"></i> <span> ATK List </span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>


        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>