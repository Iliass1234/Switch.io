<?php get_header()?>

<section>
    <div class="container">
        <div class="vh-100 d-flex align-items-center justify-content-center flex-column">
            <img src="<?php echo get_theme_mod('main_logo'); ?>" class="img-fluid w-50"/>
            <div class="mt-5 mb-5">
                <h1 class="text-primary text-center">Ooops...</h1>
                <p class="text-center mt-3"><b>Error 404:</b> la pagina che stavi cercando non esiste</p>
            </div>
            <button class="btn btn-primary" onclick="history.back()">Torna indietro</button>
        </div>
    </div>
</section>
<?php get_footer() ?>
