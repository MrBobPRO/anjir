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

    // Owl carousel navigations
    let owlNavPrev = document.getElementById("novelty-carousel-prev-nav");
    owlNavPrev.addEventListener("click", function () {
        noveltyCarousel.trigger('prev.owl.carousel');
    });

    let owlNavNext = document.getElementById("novelty-carousel-next-nav");
    owlNavNext.addEventListener("click", function () {
        noveltyCarousel.trigger('next.owl.carousel');
    });
}


//modals
document.querySelectorAll('[data-action="show-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.getElementById(item.dataset.targetId).classList.add('show');
    });
});

//hide modals
document.querySelectorAll('[data-action="hide-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.getElementById(item.dataset.targetId).classList.remove('show');
    });
});


//buy on click
document.querySelectorAll('[data-action="buy-on-click"]').forEach(item => {
    item.addEventListener('click', event => {
        //copy card sizes and image to modal
        let card = item.closest('.product-card');

        let cardSizes = card.getElementsByClassName('product-card__sizes')[0];
        let modalSizes = document.getElementById('buy-on-click-sizes');
        modalSizes.innerHTML = cardSizes.innerHTML;

        let modalImage = document.getElementById('buy-on-click-modal-image');
        let cardImage = card.getElementsByClassName('product-card__image')[0];
        modalImage.src = cardImage.src;

        //change radio ids & label ids of modal to escape conflicts with card
        let inputs = modalSizes.getElementsByClassName('product-card__radio');
        for (let input of inputs) {
            input.id = input.id + 'modal';
        }

        let labels = modalSizes.getElementsByTagName('label');
        for (let label of labels) {
            label.setAttribute('for', label.htmlFor + 'modal');
        }

        //set product amount to 1
        document.getElementById('buy-on-click-modal-amount').value = 1;
        //show modal
        document.getElementById('buy-on-click-modal').classList.add('show');
    });
});


//add into basket
document.querySelectorAll('[data-action="add-into-basket"]').forEach(item => {
    item.addEventListener('click', event => {
        let form = item.closest('.product-card__form');
        let data = new FormData(form);

        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '/add-into-basket',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,

            success: function (response) {
                if (response.action == 'stored') {
                    item.innerHTML = 'убрать из корзины <img src="/img/main/remove-from-basket.png">';
                } else if (response.action == 'removed') {
                    item.innerHTML = 'в корзину <img src="/img/main/add-to-basket.png">'
                }

                document.getElementById('basket-products-count').innerHTML = response.productsInBasket;
            },
            error: function () {
                console.log('Ajax add into basket failed !');
            }
        });
    });
});


//counter increment & decrement buttons
document.querySelectorAll('.increment-amount').forEach(item => {
    item.addEventListener('click', event => {
        let parent = item.parentElement;
        let input = parent.getElementsByTagName('input')[0];
        let value = parseInt(input.value);
        input.value = value + 1;
    });
});

document.querySelectorAll('.decrement-amount').forEach(item => {
    item.addEventListener('click', event => {
        let parent = item.parentElement;
        let input = parent.getElementsByTagName('input')[0];
        let value = parseInt(input.value);
        if (value > 0) {
            input.value = value - 1;
        }
    });
});


//allow only numbers for some input
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}

let onlyNumberInputs = document.getElementsByClassName('only-numbers');
for (let input of onlyNumberInputs) {
    setInputFilter(input, function(value) {
        return /^\d*\d*$/.test(value);
    });
}