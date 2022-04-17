// Add headers into Ajax Request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//Main carousels
let mainCarousel = $("#main-carousel");
if (mainCarousel[0]) {
    mainCarousel.owlCarousel({
        items: 1,
        loop: true,
        margin: 40,
        autoHeight: true
    });
}

//Novelty carousel
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


//Lightbox carousels
let productShowCarousel = $("#product-show-carousel");
if (productShowCarousel[0]) {
    productShowCarousel.owlCarousel({
        items: 1,
        margin: 20,
        loop: true,
        autoHeight: true,
        dots: false
    });

    // Owl carousel navigations
    let owlNavPrev = document.getElementById("product-show-carousel-prev-nav");
    if (owlNavPrev) {
        owlNavPrev.addEventListener("click", function () {
            productShowCarousel.trigger('prev.owl.carousel');
        });
    }

    let owlNavNext = document.getElementById("product-show-carousel-next-nav");
    if (owlNavNext) {
        owlNavNext.addEventListener("click", function () {
            productShowCarousel.trigger('next.owl.carousel');
        });
    }
}


//Lightbox carousels
let lightboxCarousel = $("#lightbox-carousel");
if (lightboxCarousel[0]) {
    lightboxCarousel.owlCarousel({
        items: 3,
        margin: 20,
        loop: false,
        rewind: true,
        dots: false
    });
}


//modals
document.querySelectorAll('[data-action="show-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.getElementById(item.dataset.targetId).classList.add('show');
        document.body.style.overflowY = "hidden";
    });
});

//hide modals
document.querySelectorAll('[data-action="hide-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.body.style.overflowY = "auto";
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
        document.body.style.overflowY = "hidden";
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


//AJAX Checkout
let checkoutForm = document.getElementById('checkout-form');
if (checkoutForm) {
    checkoutForm.addEventListener('submit', event => {
        event.preventDefault();
        let productIds = [];
        let productSizes = [];
        let productAmounts = [];

        let productsSection = document.getElementsByClassName('products-list-section')[0];
        let forms = productsSection.getElementsByClassName('product-card__form');

        for (let form of forms) {
            let id = form.querySelector('input[name="product_id"]').value;
            let size = form.querySelector('input[name="size"]:checked').value;
            let amount = form.querySelector('input[name="amount"]').value;

            if (amount && amount > 0) {
                productIds.push(id);
                productSizes.push(size);
                productAmounts.push(amount);
            }
        }

        let order = {
            'name': document.getElementById('checkout-form-name').value,
            'phone': document.getElementById('checkout-form-phone').value,
            'promocode': document.getElementById('checkout-form-promocode').value,
            'products': {
                'ids': productIds,
                'sizes': productSizes,
                'amounts': productAmounts
            }
        };

        $.ajax({
            type: 'POST',
            url: '/checkout',
            data: order,
            cache: false,
            timeout: 600000,

            success: function (url) {
                window.location = url;
            },
            error: function () {
                console.log('Ajax checkout failed !');
            }
        });
    });
}


//debounce function (замыкания)
function debounce (callback, timeoutDelay = 500) {
    // Используем замыкания, чтобы id таймаута у нас навсегда приклеился
    // к возвращаемой функции с setTimeout, тогда мы его сможем перезаписывать
    let timeoutId;
  
    return (...rest) => {
      // Перед каждым новым вызовом удаляем предыдущий таймаут,
      // чтобы они не накапливались
      clearTimeout(timeoutId);
  
      // Затем устанавливаем новый таймаут с вызовом колбэка на ту же задержку
      timeoutId = setTimeout(() => callback.apply(this, rest), timeoutDelay);
  
      // Таким образом цикл «поставить таймаут - удалить таймаут» будет выполняться,
      // пока действие совершается чаще, чем переданная задержка timeoutDelay
    };
}


//Search
let searchInput = document.getElementById('search-input');
let searchResults = document.getElementById('search-results');

function submitSearch() {
    $.ajax({
        type: 'POST',
        url: '/search',
        data: { 'keyword': searchInput.value },
        cache: false,
        timeout: 600000,

        success: function (response) {
            searchResults.innerHTML = response;
        },
        error: function () {
            console.log('Ajax search failed !');
        }
    });
}

const debounceSearch = debounce(() => submitSearch());