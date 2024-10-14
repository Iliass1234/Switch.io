<?php $descrizioneParte1 = get_post_meta(get_the_ID(), 'tc_home_sezione_team_descrizione1', true); ?>
<?php $descrizioneParte2 = get_post_meta(get_the_ID(), 'tc_home_sezione_team_descrizione2', true); ?>
<?php $gruppoImgAnimazione= get_post_meta(get_the_ID(), 'tc_home_sezione_team_gallery', true); ?>
<?php $gruppoFondatore = get_post_meta(get_the_ID(), 'tc_home_sezione_team_gruppo_fondatore', true); ?>
<?php $idImgFondatore = $gruppoFondatore['0']['tc_home_sezione_team_img_fondatore_id'] ?>
<?php $urlImgFondatore = wp_get_attachment_image_url($idImgFondatore, 'rectangle-thumb'); ?>
<?php $descrizioneFondatore = $gruppoFondatore ['0']['tc_home_sezione_team_descrizione'] ?>
<?php $gruppoTeam = get_post_meta(get_the_ID(), 'tc_home_sezione_team_gruppo', true); ?>

<?php function get_attachment_id_from_url($attachment_url = '') {
global $wpdb;
$attachment_id = false;

if ('' == $attachment_url) {
return;
}

$upload_dir_paths = wp_upload_dir();

if (strpos($attachment_url, $upload_dir_paths['baseurl']) !== false) {
$attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
$attachment_id = $wpdb->get_var(
$wpdb->prepare(
"SELECT ID FROM $wpdb->posts WHERE guid LIKE %s",
'%' . $attachment_url . '%'
)
);
}

return $attachment_id;
}
?>

<?php $idimgAnimata1 = get_attachment_id_from_url($gruppoImgAnimazione[32]); ?>
<?php $idimgAnimata2 = get_attachment_id_from_url($gruppoImgAnimazione[33]); ?>
<?php $idimgAnimata3= get_attachment_id_from_url($gruppoImgAnimazione[34]); ?>

<?php $imgAnimata1 = wp_get_attachment_image_src($idimgAnimata1, 'card-thumb'); ?>
<?php $imgAnimata2 = wp_get_attachment_image_src($idimgAnimata2, 'card-thumb'); ?>
<?php $imgAnimata3 = wp_get_attachment_image_src($idimgAnimata3, 'card-thumb'); ?>


<section class="overflow-hidden tcMainSection" id="chi-siamo">
    <div class="row gx-md-3 gy-md-2">
        <div class="col-md-5 bg-secondary d-flex justify-content-center align-items-center">
            <div class="p-5">
                <img class="img-fluid tcTeamAnimationImg"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/svg/logoanimato.svg" alt="">
            </div>
        </div>
        <div class="col-md-7">
            <img class="img-fluid h-100 w-100"
                 src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/png/sezione-team2.png"
                 alt="">
        </div>
        <div class="col-lg-5 bg-black " id="mission">
            <div class="p-sm-5 ms-4 py-5 tcContainerImgAnimata">
                <?php if (!empty($descrizioneParte1)) : ?>
                    <div class="tcTestoAziandaTeam pt-5 text-white px-md-2 mb-5"> <?php echo $descrizioneParte1 ?></div>
                <?php endif; ?>
                <?php if (!empty($descrizioneParte2)) : ?>
                    <div class="tcTestoAziandaTeam pb-5 text-white px-md-2"> <?php echo $descrizioneParte2 ?></div>
                <?php endif; ?>
                <div class="tcImgAnimata1 tcImgAnimWidth overflow-hidden">
                        <img class="img-fluid tcImgDescriptionEffect" src="<?php echo $imgAnimata1[0] ?>" alt="">
                </div>
                <div class="tcImgAnimata2 tcImgAnimWidth overflow-hidden">
                        <img class="img-fluid tcImgDescriptionEffect" src="<?php echo $imgAnimata2[0] ?>" alt="">
                </div><div class="tcImgAnimata3 tcImgAnimWidth overflow-hidden">
                        <img class="img-fluid tcImgDescriptionEffect" src="<?php echo $imgAnimata3[0] ?>" alt="">
                </div>

            </div>
        </div>
        <div class="col-lg-7 ">
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

