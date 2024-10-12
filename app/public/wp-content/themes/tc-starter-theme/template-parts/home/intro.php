<?php $IntroTitolo = get_post_meta(get_the_ID(), 'tc_home_intro_titolo', true); ?>
<?php $IntroDescrizione = get_post_meta(get_the_ID(), 'tc_home_intro_descrizione', true); ?>

<section class="my-5 tcMainSection" id="vision">
    <div class="container">
        <span class="text-uppercase">vision</span>
        <div class="row mt-5">
            <div class="col-md-7 pe-5 mb-4 mb-md-0">
                <?php if (!empty($IntroTitolo)) : ?>
                    <span class="d-block pe-5 h2"><?php echo $IntroTitolo ?></span>
                <?php endif; ?>
            </div>
            <div class="col-md-5">
                <?php if (!empty($IntroDescrizione)) : ?>
                    <span class="ps-5 ms-4 ms-md-0 ps-md-0 d-block mt-md-5 pt-md-5"><?php echo $IntroDescrizione
                        ?></span>
                <?php endif; ?>
            </div>

        </div>
    </div>

</section>
