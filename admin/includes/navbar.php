<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand" href="index.php">InstantFlow</a>
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
        <ul class="navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo $rowUser["first_name"] . " " . $rowUser["last_name"]; ?></div>
                            <div class="dropdown-user-details-email"><?php echo $rowUser["email"]; ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="destruct.php">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Log Out
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="sidenav-menu-heading">Other</div>
                        <a class="nav-link" href="index.php">
                            <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                            Dashboard
                        </a>
                        <div class="sidenav-menu-heading">Tools</div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                            <div class="nav-link-icon"><i class="bi bi-tools"></i></div>
                            Actions
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="film.php">Films</a>
                                <a class="nav-link" href="admin.php">Admins</a>
                                <a class="nav-link" href="actor.php">Actors</a>
                            </nav>
                        </div>
                        <div class="sidenav-menu-heading">Personal Area</div>
                        <a class="nav-link" href="account.php">
                            <div class="nav-link-icon"><i data-feather="user"></i></div>
                            Account
                        </a>
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?php echo $rowUser["first_name"] . " " . $rowUser["last_name"]; ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
