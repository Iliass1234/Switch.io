<?php
$args = [
    'posts_per_page' => -1,
    'post_type' => [\tc\Theme\tcStarterTheme::TC_PROGETTI_CPT_NAME],
];
?>
<?php $i = 01 ?>
<?php $tipologiaQuery = new WP_Query($args); ?>

<?php if ($tipologiaQuery->have_posts()) : ?>
    <section class="overflow-hidden mt-1 px-1 tcMainSection" id="progetti">
        <div class="row flex-row-reverse gx-lg-1 gx-2 gy-5 gy-lg-0">
            <?php while ($tipologiaQuery->have_posts()) : $tipologiaQuery->the_post(); ?>
                <?php $titleBase = get_the_title(); ?>
                <?php $titletransform = explode(' ', $titleBase); ?>
                <?php
                if (count($titletransform) > 1) {
                    $titletransform[1] = '<span class="text-secondary">' . $titletransform[1] . '</span>';
                }
                $titleProgetti = implode(' ', $titletransform);
                ?>
                <?php
                $excerpt = get_the_excerpt();
                $idImgProgetti = get_post_thumbnail_id();
                $ulrImgProgetti = wp_get_attachment_image_url($idImgProgetti, 'card-thumb');
                ?>
                <div class="col-lg-2 col-sm-4 col-6">
                    <div>
                        <img class="img-fluid tc-img-cover tcImgProgetti"
                             src="<?php echo esc_url($ulrImgProgetti); ?>"
                             alt="<?php echo esc_attr($titleBase); ?>"
                             data-title="<?php echo get_the_title() ?>"
                             data-excerpt="<?php echo $excerpt ?>">
                        <div class="d-block d-lg-none d-flex justify-content-between">
                            <span class="d-block text-uppercase"><?php echo $titleProgetti ?></span>
                            <span class="d-block text-uppercase">.<?php echo sprintf('%02d', $i) ?></span>
                        </div>
                    </div>

                </div>
            <?php $i++ ?>
            <?php endwhile; ?>
        </div>

        <div class="mx-5 ps-2 my-5 d-lg-block d-none ">
            <div class="row">
                <div class="col-6">
                    <?php $titleBase = get_the_title(); ?>
                    <?php $titletransform = explode(' ', $titleBase); ?>
                    <?php
                    if (count($titletransform) > 1) {
                        $titletransform[1] = '<span class="text-secondary">' . $titletransform[1] . '</span>';
                    }
                    $titleProgetti = implode(' ', $titletransform);
                    ?>
                    <span class="h3" id="tcCptTitle"><?php echo $titleProgetti ?></span>
                </div>
                <div class="col-6">
                    <span> FEATURED WORKS </span>
                </div>
                <div class="w-75 mt-4">
                    <div class="col-3"><span id="tcCptexerpt"><?php echo $excerpt; ?></span></div>
                </div>

            </div>
            <div class="mt-5">
                <button class="btn btn-info tc-btn-arrow-info ">scopri il progetto</button>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php wp_reset_query(); ?>
