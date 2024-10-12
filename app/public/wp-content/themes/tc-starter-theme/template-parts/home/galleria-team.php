<?php $gruppoTeam = get_post_meta(get_the_ID(), 'tc_home_sezione_team_gruppo', true); ?>


<div class="ms-5 pt-5 mt-5 mb-1">
    <div class="swiper tcReviews__swiper ">
        <div class="swiper-wrapper ">
            <?php foreach ($gruppoTeam as $value) : ?>
                <?php $idImgTeam = $value['tc_home_sezione_team_img_id'] ?>
                <?php $urlTeam = wp_get_attachment_image_url($idImgTeam, 'card-thumb'); ?>
                <div class="swiper-slide h-auto ">
                    <div class="h-100">
                        <div class="tcInfoTeam d-flex flex-column justify-content-between h-100  w-100">
                            <?php foreach ($value['tc_home_sezione_team_titolo'] as $index => $title) : ?>
                            <div>
                                <?php if ($index === 0) : ?>
                                    <span ><?php echo $title; ?></span>
                                <?php elseif ($index === 1) : ?>
                                    <span class="tcRuoloTeam text-secondary"><?php echo $title; ?></span>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                            <div class="mt-2">
                                <img class=" img-fluid tc-img-cover tcImgSwiper"
                                     src="<?php echo $urlTeam ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination "></div>
    </div>
</div>