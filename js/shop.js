// Global variable cart withi in all fishes in the shoping cart
var cart = [];
var running = false;

// Triggers addition to the cart
function start(it) {
    if (!running) {
    console.log("runnunig shop.js");
    running = true;
    // Unhide and clear shoppingcart table
    $(".shoppingcart").show();
    }
    addCart(it);
}

// Adds new fish to cart
function addCart(it, callback) {
    // Gets fish-id from button id
    var fishId = it.id.substr(0, it.id.indexOf('-'));
    var fish = {};
    var isInCart = false;

    // Checks if fish is allready in cart
    cart.forEach(fish => {
        if (fish.id == fishId) {
            isInCart = true;
        }
    });
    console.log(isInCart)
    // If fish is not in cart the amount off the fish in cart is increased by the added amount
    if (!isInCart) {
        var fish = {
            id : fishId,
            name : $(`${fishId}-name-article`).val(),
            price : $(`${fishId}-price-article`).val(),
            amount : $(`${fishId}-amount-article`).val(),
            total : ($(`${fishId}-price-article`).val() * $(`${fishId}-amount-article`).val())
        };
        cart.push(fish);

    // If fish is in cart the amount off the fish in cart is increased by the added amount
    } else {
        var toUpdate = cart.filter(function(item) { return item.id == fishId });
        toUpdate[0].amount =  (toUpdate[0].amount + $(`${fishId}-amount-article`).val());
        toUpdate[0].total = (toUpdate[0].price * toUpdate[0].amount);
    }

    //callback(); wird nicht gecalled
}

// Prints/refreshes the shoppingcart on the page
function printCart(){
    console.log("called addPrintCart")

    $("#cart-table > tr").remove();
    $("#cart-table > td").remove();
    // Fill shoppingcart table
    cart.forEach(fish => function(){ 
        $("#shoppingcart").append(`
            <tr>
                <td id="${fish['id']}-id-cart" hidden>${fish['id']}</td>
                <td id="${fish['id']}-name-cart">${fish['name']}</td>
                <td id="${fish['id']}-ammount-cart">${fish['ammount']}pc</td>
                <td id="${fish['id']}-price-cart">${fish['price']}</td>
                <td id="${fish['id']}-total-cart">${fish['total']}</td>
            </tr>
        `)
    });

    // Adds total amount at tablefoot
    $("#shoppingcart-totalamount");
}