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