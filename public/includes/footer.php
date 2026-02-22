<?php
/**
 * Footer Include
 * 
 * Usage:
 * - Optional: $enableAOS = true/false - Enables AOS (Animate On Scroll) library
 * - Optional: $footerTheme = 'light'/'dark' - Footer theme
 */

// Set defaults if not provided
$enableAOS = $enableAOS ?? false;
$footerTheme = $footerTheme ?? 'light';
$footerBgClass = $footerTheme === 'dark' ? 'bg-dark' : 'bg-white';
$footerClass = $footerTheme === 'dark' ? 'footer-dark' : 'footer-light';
?>

        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto <?php echo $footerBgClass; ?> <?php echo $footerClass; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-brand">InstantFlow</div>
                            <div class="icon-list-social mb-5">
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-facebook"></i></a>
                                <a class="icon-list-social-link" href="https://github.com/davidelomundo/InstantFlow/" target="_blank" rel="noopener noreferrer"><i class="fab fa-github"></i></a>
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Company</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">About Us</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Contact</a></li>
                                        <li><a href="javascript:void(0);">Careers</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Help</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">FAQ</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Help Center</a></li>
                                        <li><a href="javascript:void(0);">Account</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row align-items-center">
                        <div class="col-md-6 small">Copyright &copy; InstantFlow <?php echo date('Y'); ?></div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Privacy Policy</a>
                            &middot;
                            <a href="javascript:void(0);">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <?php if ($enableAOS): ?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
    <?php endif; ?>
</body>
