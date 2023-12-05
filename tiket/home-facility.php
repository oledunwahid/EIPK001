<link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />


<div class="card bg-red" style="background-color: #af2a25; color: white;">
    <div class="card-body">
        <h4 class="fs-20 mb-4 " style="color:white">Hello, Welcome <?= $namalogin ?> </h4>
        <p class="fs-15 mb-0">
            This system will help you to get GA & IT request and also help us for
            manage, and track request from your submission.
        </p>
        <div class="language-container">
            <p class="indonesian-text fs-14" style="color: white; font-style: italic;">
                Sistem ini akan membantu Anda dalam pengajuan permintaan GA dan IT,
                serta membantu kami dalam mengelola dan melacak permintaan dari
                pengajuan Anda.
            </p>
        </div>
    </div>
</div>

<h4 class="text-left mb-4">Our Features</h4>

<div class="row mt-4">

    <!-- IT Helpdesk Card -->
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-primary mb-2">IT Support</h5>
                        <p class="text-muted mb-0">Submit your IT-related issues here. Our IT team will assist you as soon as possible. (Additional or RAM Replacement, Drive or Cloud storage request, Email, Printer, Scan, Software problems etc).</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="index.php?page=ITSupport" class="btn btn-primary">Open IT Request</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-danger mb-2">Building Maintenance</h5>
                        <p class="text-muted mb-0">Submit building and facility-related maintenance
                            requests here. Our team
                            will assist you with building maintenance needs.</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="index.php?page=Building Facilities" class="btn btn-danger">Open
                        Building Maintenance</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Facilities Card -->
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-secondary mb-2">Other Facilities Request</h5>
                        <p class="text-muted mb-0">For purchasing and replacing items, please attach the
                            approved material
                            request form and submit your request here.</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="index.php?page=Other Facilities" class="btn btn-secondary">Open Other
                        Facilities Request</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ATK/Stationary Card -->
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class=" mb-2" style="color: #af2a25">ATK/Stationary</h5>
                        <p class="text-muted mb-0">Submit your stationary-related requests here. Our
                            team will assist you with ATK/Stationary needs.</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="index.php?page=ATK/Stationary" class="btn " style="background-color: #af2a25; color:white">Open
                        ATK/Stationary Request</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delivery -->
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class=" mb-2" style="color: #176B87">Delivery</h5>
                        <p class="text-muted mb-0">Submit your delivery-related requests here. Our
                            team will assist you with delivery needs.</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="index.php?page=Delivery" class="btn " style="background-color: #176B87; color:white">Open
                        Delivery Request</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Project Card -->
    <?php
    $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin");
    $row7 = mysqli_fetch_assoc($sql7);

    if (isset($row7['admin']) && ($row7['admin'] == '1')) { ?>
        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-success mb-2">Project Management</h5>
                            <p class="text-muted mb-0">View and manage ongoing projects, track
                                progress, and collaborate with team members.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="btn btn-success">View Projects</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Card -->
        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-warning mb-2">Task Management</h5>
                            <p class="text-muted mb-0">Track and manage individual tasks within
                                projects. Stay organized and meet deadlines efficiently.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="btn btn-warning">View Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


</div>