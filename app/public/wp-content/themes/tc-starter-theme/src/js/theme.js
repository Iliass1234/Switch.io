import {gsap} from "gsap";

window.addEventListener('load', () => {
    tcInitMenuAnimations()


    const menuLinks = document.querySelectorAll('nav ul li a');
    const sections = document.querySelectorAll('.tcMainSection');

    // Funzione che aggiorna il link attivo in base allo scroll
    function aggiornaLinkAttivo() {
        const posizioneScroll = window.scrollY;

        sections.forEach((sezione, index) => {
            const offsetSuperiore = sezione.offsetTop - 70; // 70px per tenere conto dell'altezza del menu
            const altezzaSezione = sezione.offsetHeight;
            const offsetInferiore = offsetSuperiore + altezzaSezione;

            if (posizioneScroll >= offsetSuperiore && posizioneScroll < offsetInferiore) {
                // Rimuoviamo la classe 'active' da tutti i link
                menuLinks.forEach((link) => link.classList.remove('active'));
                // Aggiungiamo la classe 'active' al link corrente
                if (menuLinks[index] !== undefined) {
                    if (posizioneScroll !== 0) {
                        menuLinks[index].classList.add('active');

                    }

                }
            }
        });
    }

    // Aggiungiamo l'evento 'scroll' all'oggetto window
    window.addEventListener('scroll', aggiornaLinkAttivo);

    // Chiamiamo la funzione al caricamento della pagina
    aggiornaLinkAttivo();
})


function tcInitMenuAnimations() {

    tcTamDescriptionAnimation()
    tcHandleOffcanvasHide()
    tcHandleOffcanvasShow()
    const mediaQuery = window.matchMedia('(min-width: 992px)');
    const myOffcanvas = document.getElementById('tc-main-menu-offcanvas')
    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(myOffcanvas);
    mediaQuery.addEventListener('change', function (event) {
        console.log(event)
        bsOffcanvas.hide();
    })
    let menuLinks = document.querySelectorAll('#tc-main-menu .nav-link')
    menuLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            bsOffcanvas.hide();
        })
    })


    function tcHandleOffcanvasShow() {
        document.querySelector('#tc-main-menu-offcanvas').addEventListener('show.bs.offcanvas', () => {
            document.querySelector('.tcHeaderButton').innerText = 'CHIUDI'
            let offcanvasTL = gsap.timeline();
            offcanvasTL.to('.tcOffcanvasCerchio', {
                width: 800,
                height: 800,
                duration: 1.2,
                ease: "back.out(0.5)",
                transformOrigin: 'right bottom',
            });
            offcanvasTL.to('#tc-main-menu-container', {
                x: 0,
                opacity: 1,
                duration: 0.6,
                ease: "power4.out",
            }, 1.2);
        });
    }

    function tcHandleOffcanvasHide() {
        document.querySelector('#tc-main-menu-offcanvas').addEventListener('hide.bs.offcanvas', () => {
            document.querySelector('.tcHeaderButton').innerText = 'MENU'
            let offcanvasTL = gsap.timeline();
            offcanvasTL.to('.tcOffcanvasCerchio', {
                width: 30,
                height: 30,
                duration: 0.8,
                ease: "sine.inOut",
                transformOrigin: 'right bottom',
            });
            offcanvasTL.to('#tc-main-menu-container', {
                x: 90,
                opacity: 0,
                duration: 1.2,
                ease: "sine.inOut",
            }, '<');
        });
    }
}

function tcTamDescriptionAnimation() {
    let imgDescrizioneTeam = document.querySelectorAll('.tcImgAnimWidth')
    let imgDescrizioneTeamEffect = document.querySelectorAll('.tcImgDescriptionEffect')
    let offcanvasTL = gsap.timeline({repeat :-1});
    offcanvasTL.to(imgDescrizioneTeamEffect, {
        scale:0.01,
    });
    offcanvasTL.to(imgDescrizioneTeam, {
        scale:0.01,
    });

    offcanvasTL.to(imgDescrizioneTeam, {
        scale:1,
        duration:1,
        stagger: {
            each: 1.2,
            from: "start"
        }
    });
    offcanvasTL.to(imgDescrizioneTeamEffect, {
        scale:1.3,
        duration:1,
        ease: "back.out(1.7)",
        stagger: {
            each: 1.2,
            from: "start"
        }
    });
    offcanvasTL.to({}, {
        duration: 1.3,
    });

    offcanvasTL.to(imgDescrizioneTeam, {
        scale: 0.01,
        duration: 0.5,
        ease: "power1.in",
        stagger: {
            each: 0.5,
            from: "end"
        }
    });
    offcanvasTL.to({}, {
        duration: 5,
    });
}

// <-------------------------------- SWIPER -------------------------------------------------------------------------->


if (document.querySelector('.tcReviews__swiper') !== null) {

    let swiper = new Swiper(".tcReviews__swiper", {
        slidesPerView: 4,
        spaceBetween: 5,
        loop: true,
        pagination: {},
        breakpoints: {
            0: {
                slidesPerView: 1.9,
                spaceBetween: 10
            },
            426: {
                slidesPerView: 3.1,
                spaceBetween: 5
            },
            1024.5: {
                slidesPerView: 4,
                spaceBetween: 5
            }
        }
    });

}

// <-------------------------------- TITOLO / EXCERPT  CPT------------------------------------------------------------>
const imgCpt = document.querySelectorAll('.tcImgProgetti');
const titleCpt = document.getElementById('tcCptTitle');
const excerptCpt = document.getElementById('tcCptexerpt');

imgCpt.forEach(imgCpt => {
    imgCpt.addEventListener('click', function () {
        const newTitle = this.getAttribute('data-title');
        const newExcerpt = this.getAttribute('data-excerpt');

        titleCpt.textContent = newTitle;
        excerptCpt.textContent = newExcerpt;
    });
});
