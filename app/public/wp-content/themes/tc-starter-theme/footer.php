<?php $settingsLink = get_option(\tc\Theme\tcStarterTheme::TC_THEME_PREFIX . '_theme_settings_links') ?>
<?php $paginaPrivacyPolicyID = $settingsLink['tc__links_privacy_page']['value'] ?>
<?php $paginaCookiePolicyID = $settingsLink['tc__links_cookie_page']['value'] ?>
<?php $telefono = get_theme_mod('telefono') ?>
<?php $mail = get_theme_mod('mail') ?>
<?php $nomeSito = get_theme_mod('nome_sito'); ?>
<?php $iva = get_theme_mod('iva'); ?>
<?php $indirizzo = get_theme_mod('indirizzo'); ?>
<?php $citta = get_theme_mod('citta'); ?>
<?php $ig = get_theme_mod('instagram') ?>
<?php $fb = get_theme_mod('facebook') ?>
</main><!-- .site -->
<footer id="contatti" class="tcMainSection">
    <div class="pt-5 mt-5 overflow-hidden">
        <div class="row flex-column flex-md-row">
            <div class="col-md-4 pe-0">
                <div class="d-flex flex-column align-items-center h-100">
                    <span class="fs-2 d-block mb-4">Dove siamo</span>
                    <img class="img-fluid w-100 h-100"
                         src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/png/mappa.png" alt="">
                </div>
            </div>
            <div class="col-md-8 ps-0 mt-5 mt-md-0 ">
                <div class="d-flex flex-column align-items-center ps-md-3 pe-md-5">
                    <span class="fs-2 d-block">Richiedi maggiori informazioni</span>
                    <div class="container mt-4 pe-5 ps-5 border border-0">
                        <div class="row g-0 gy-3">
                            <?php echo do_shortcode('[contact-form-7 id="686da01" title="Modulo di contatto 1"]') ?>

                        </div>
                    </div>
                </div>
                <div class="tcFooterInfo mt-4 ">
                    <div class="container ">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="my-4 ps-5">
                                <img class="img-fluid tcFooterLogo"
                                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/svg/logo-positivo.svg"
                                     alt="logo Switch">
                            </div>
                            <div class="d-flex me-5 pe-5">
                                <div>
                                    <?php if (!empty($fb)): ?>
                                        <a href="<?php echo $fb ?>" target="_blank">
                                            <img class="img-fluid me-5"
                                                 src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/svg/fb.svg"
                                                 alt="Facebook">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($ig)): ?>
                                        <a href="<?php echo $ig ?>" target="_blank">
                                            <img class="img-fluid"
                                                 src="<?php echo get_stylesheet_directory_uri();
                                                 ?>/assets/images/png/insta.png"
                                                 alt="Instagram">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center py-2">
                        <a href="<?php echo get_permalink($paginaPrivacyPolicyID) ?>" target="_blank"
                           class="text-decoration-none  text-black">
                            Privacy Policy
                        </a>
                    </div>
                    <div class="col-4  text-center py-2 tcFooterInfoBorder">
                        <a href="<?php echo get_permalink($paginaCookiePolicyID) ?>" target="_blank"
                           class="text-decoration-none ">
                            Cookie Policy
                        </a>
                    </div>
                    <div class="col-4 text-center py-2">
                        <span><?php echo wp_date('Y') ?>©Switch srl</span>
                    </div>

                </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
