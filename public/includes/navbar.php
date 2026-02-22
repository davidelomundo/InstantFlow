<?php
/**
 * Navigation Bar Include
 * 
 * Usage:
 * - For public pages: $isLoggedIn = false;
 * - For logged-in pages: $isLoggedIn = true; (requires $userInfo array)
 * - Optional: $showSearch = true/false (for logged-in pages)
 * - Optional: $searchAction = 'logged.php' (form action for search)
 */

// Set defaults if not provided
$isLoggedIn = $isLoggedIn ?? false;
$showSearch = $showSearch ?? true;
$searchAction = $searchAction ?? 'logged.php';
$dropdownText = $dropdownText ?? ($userInfo["first_name"] ?? 'Profile');
?>

<nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand text-white" href="<?php echo $isLoggedIn ? 'logged.php' : 'index.php'; ?>">InstantFlow</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if ($isLoggedIn): ?>
                <!-- Logged-in Navigation -->
                <ul class="navbar-nav ml-auto mr-lg-5">                                    
                    <li class="nav-item dropdown no-caret">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $dropdownText; ?><i class="fas fa-chevron-right dropdown-arrow"></i></a>
                        <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                            <a class="dropdown-item py-3" href="settings.php">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-gear"></i></div>
                                <div>
                                    <div class="small text-gray-500">Settings</div>
                                    Manage your account
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="abbonato.php">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-credit-card-2-front-fill"></i></div>
                                <div>
                                    <div class="small text-gray-500">Subscription</div>
                                    Check or renew your subscription
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="history.php">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-clock-history"></i></div>
                                <div>
                                    <div class="small text-gray-500">History</div>
                                    Recently watched films
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="destruct.php">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-power"></i></div>
                                <div>
                                    <div class="small text-gray-500">Log Out</div>
                                    Sign out
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="generi.php">Genres</a></li>
                </ul>
                <?php if ($showSearch): ?>
                    <form action="<?php echo $searchAction; ?>" method="GET" class="d-flex align-items-center">
                        <div class="form-row align-items-center justify-content-center">
                            <div>
                                <div class="form-group mb-0 mr-0 mr-lg-2">
                                    <label class="sr-only" for="inputSearch">Search...</label>
                                    <input class="form-control form-control-solid rounded-pill" id="inputSearch" name="ricerca" type="text" placeholder="Search..." />
                                </div>
                            </div>
                            <div>
                                <button class="btn-teal btn rounded-pill px-4 ml-lg-4" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <!-- Public Navigation -->
                <ul class="navbar-nav ml-auto mr-lg-5">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="pricing.php">Pricing</a></li>
                </ul>
                <a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="<?php echo isset($loginButtonHref) ? $loginButtonHref : 'login.php'; ?>">
                    <?php echo isset($loginButtonText) ? $loginButtonText : 'Login'; ?><i class="fas fa-arrow-right ml-1"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
