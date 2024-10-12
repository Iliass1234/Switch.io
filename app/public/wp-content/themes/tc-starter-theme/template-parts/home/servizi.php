<?php $gruppoServizi = get_post_meta(get_the_ID(), 'tc_home_sezione_servizi_gruppo', true); ?>
<?php $i = 1; ?>
<section class="pb-5 my-5 overflow-hidden tcMainSection" id="servizi">
    <div>
        <span class="text-uppercase d-block ms-5 ps-2 my-5">servizi</span>
        <div>
            <div class="accordion" id="accordionExample">
                <?php foreach ($gruppoServizi as $gruppo) : ?>
                    <div class="accordion-item">

                        <?php $titoloServizio = $gruppo['tc_home_sezione_servizi_titolo1']; ?>
                        <?php $titoloServizio2 = $gruppo['tc_home_sezione_servizi_titolo2']; ?>
                        <?php $descrizioneServizio = $gruppo['tc_home_sezione_team_descrizione']; ?>
                        <span class="accordion-header">
                            <div class=" d-flex justify-content-between">
                                <button class="accordion-button ps-5 tcCollapsBg" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne-<?php echo $i; ?>"
                                        aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>"
                                        aria-controls="collapseOne">
                            <span class="fs-1"><?php echo $titoloServizio[0]; ?></span>
                        </button>
                            <div class="d-flex justify-content-center align-items-center pe-5 tcServiziScopriDiPiu">
                                <span class="text-uppercase text-nowrap d-block me-2">scopri di più</span>
                                <div>
                                     <img class="tcServiziIcona img-fluid"
                                          src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/svg/icona.svg"
                                          alt="Scopri di più">
                                </div>
                            </div>
                            </div>

                    </span>
                        <div id="collapseOne-<?php echo $i; ?>" class="tcServizioDescrizioneBg accordion-collapse collapse
                    <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body ps-5">
                                <span class="d-block fs-1 text-white"><?php echo $titoloServizio2[0]; ?></span>
                                <div class="tcDescrizioneServizio"><?php echo $descrizioneServizio; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
