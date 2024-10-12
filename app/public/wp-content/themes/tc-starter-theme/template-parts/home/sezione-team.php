<?php $descrizioneParte1 = get_post_meta(get_the_ID(), 'tc_home_sezione_team_descrizione1', true); ?>
<?php $descrizioneParte2 = get_post_meta(get_the_ID(), 'tc_home_sezione_team_descrizione2', true); ?>
<?php $gruppoImgAnimazione= get_post_meta(get_the_ID(), 'tc_home_sezione_team_gallery', true); ?>
<?php $gruppoFondatore = get_post_meta(get_the_ID(), 'tc_home_sezione_team_gruppo_fondatore', true); ?>
<?php $idImgFondatore = $gruppoFondatore['0']['tc_home_sezione_team_img_fondatore_id'] ?>
<?php $urlImgFondatore = wp_get_attachment_image_url($idImgFondatore, 'rectangle-thumb'); ?>
<?php $descrizioneFondatore = $gruppoFondatore ['0']['tc_home_sezione_team_descrizione'] ?>
<?php $gruppoTeam = get_post_meta(get_the_ID(), 'tc_home_sezione_team_gruppo', true); ?>
<?php $image_url = $gruppoImgAnimazione[32]?>
<?php //function get_attachment_id_by_url( $image_url ) {
//global $wpdb;
//$attachment = $wpdb->get_col( $wpdb->prepare( "
//SELECT ID FROM $wpdb->posts
//WHERE guid = %s
//AND post_type = 'attachment'
//", $image_url ) );
//
//return $attachment ? $attachment[0] : null;
//}?>
<?php //$image_id = get_attachment_id_by_url( $image_url );?>
<?php //var_dump($image_id); ?>
<?php //var_dump($gruppoImgAnimazione[34]); ?>

<section class="overflow-hidden tcMainSection" id="chi-siamo">
    <div class="row gy-md-1">
        <div class="col-md-5 pe-0 bg-secondary d-flex justify-content-center align-items-center">
            <div class="p-5">
                <img class="img-fluid tcTeamAnimationImg"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/svg/logoanimato.svg" alt="">
            </div>
        </div>
        <div class="col-md-7 ps-1">
            <img class="img-fluid h-100"
                 src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/png/sezione-team2.png"
                 alt="">
        </div>
        <div class="col-lg-5 bg-black pe-1 "id="mission">
            <div class="p-5 ms-4 position-relative">
                <?php if (!empty($descrizioneParte1)) : ?>
                    <div class="tcTestoAziandaTeam text-white px-2 mb-5"> <?php echo $descrizioneParte1 ?></div>
                <?php endif; ?>
                <?php if (!empty($descrizioneParte2)) : ?>
                    <div class="tcTestoAziandaTeam text-white px-2"> <?php echo $descrizioneParte2 ?></div>
                <?php endif; ?>
                <div class="position-absolute h-100 top-0 left-0 d-flex justify-content-center align-items-center">
                    <div class="container h-100">

                    </div>

                </div>

            </div>
        </div>
        <div class="col-lg-7 ps-1">
            <div class="bg-primary d-flex flex-column justify-content-between h-100">
                <div class="d-flex flex-column flex-md-row p-5 mb-5">
                    <div class="me-5">
                        <img class="tcImgFondatore img-fluid" src="<?php echo $urlImgFondatore ?>" alt="">
                    </div>
                    <div><?php echo $descrizioneFondatore ?></div>
                </div>
                <?php get_template_part('template-parts/home/galleria-team') ?>
            </div>

        </div>
    </div>


</section>

