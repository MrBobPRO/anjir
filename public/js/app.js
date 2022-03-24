//owl carousels
let mainCarousel = $("#main-carousel");
if (mainCarousel[0]) {
    mainCarousel.owlCarousel({
        items: 1,
        loop: true,
        margin: 40
    });
}

let noveltyCarousel = $("#novelty-carousel");
if (noveltyCarousel[0]) {
    noveltyCarousel.owlCarousel({
        margin: 20,
        loop: true,
        autoWidth: true,
        items: 4
    });
}


//modals
document.querySelectorAll('[data-action="show-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.getElementById(item.dataset.targetId).classList.add('show');
    })
})

//hide modals
document.querySelectorAll('[data-action="hide-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.getElementById(item.dataset.targetId).classList.remove('show');
    })
})