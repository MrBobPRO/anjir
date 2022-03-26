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
    });
});

//hide modals
document.querySelectorAll('[data-action="hide-modal"]').forEach(item => {
    item.addEventListener('click', event => {
        document.getElementById(item.dataset.targetId).classList.remove('show');
    });
});


//buy on click
document.querySelectorAll('.buy-on-click').forEach(item => {
    item.addEventListener('click', event => {
        //copy all needed values for request & appearance
        let card = item.closest('.product-card');
        let cardForm = card.getElementsByClassName('product-card__form')[0];

        let productId = document.getElementById('buy-on-click-modal-product-id');
        let cardProductId = card.getElementsByClassName('product-card__id')[0];
        productId.value = cardProductId.value;

        let sizesContainer = document.getElementById('modal-sizes');
        sizesContainer.innerHTML = cardForm.innerHTML;

        let inputs = sizesContainer.getElementsByTagName('input');
        for (let input of inputs) {
            input.id = input.id + 'modal';
        }

        let labels = sizesContainer.getElementsByTagName('label');
        for (let label of labels) {
            label.setAttribute('for', label.htmlFor + 'modal');
        }

        let modalImage = document.getElementById('buy-on-click-modal-image');
        let productImage = card.getElementsByClassName('product-card__image')[0];
        modalImage.src = productImage.src;

        //also set product amount to 1
        document.getElementById('buy-on-click-modal-amount-input').value = 1;

        //show modal
        document.getElementById('buy-on-click-modal').classList.add('show');
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