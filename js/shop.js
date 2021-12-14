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

    addCart(it, printCart);
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

    // If fish is not in cart the amount off the fish in cart is increased by the added amount
    if (!isInCart) {
        fish = {
            id : fishId,
            name : document.getElementById(`${fishId}-name-article`).value,
            price : Number(document.getElementById(`${fishId}-price-article`).value),
            amount : Number(document.getElementById(`${fishId}-amount-article`).value),
            total : (Number(document.getElementById(`${fishId}-price-article`).value) * Number(document.getElementById(`${fishId}-amount-article`).value))
        };
        cart.push(fish);

    // If fish is in cart the amount off the fish in cart is increased by the added amount
    } else {
        var toUpdate = cart.filter(function(item) { return item.id == fishId });
        toUpdate[0].amount =  (Number(toUpdate[0].amount) + Number(document.getElementById(`${fishId}-amount-article`).value));
        toUpdate[0].total = (Number(toUpdate[0].price) * Number(toUpdate[0].amount));
    }

    callback();
}

// Updates cart[]
function updateCart(){}

// Prints/refreshes the shoppingcart on the page
function printCart(){
    console.log("called addPrintCart")
    var totalamount = 0;

    // Show shoppingcart-table
    $(".shoppingcart").show();

    // Clear shoppingcart-table
    $("#cart-table > tr").remove();
    $("#cart-table > td").remove();

    // Fill shoppingcart table
    cart.forEach(fish => {
        console.log(cart);
        
        let row = document.getElementById("cart-table").insertRow(-1);

        let idCart = row.insertCell(0);
        idCart.setAttribute(`id`, `${fish.id}-id-cart`);
        idCart.setAttribute(`hidden`, ``);
        idCart.innerHTML = fish.id;

        let nameCart = row.insertCell(1);
        nameCart.setAttribute(`id`, `${fish.id}-name-cart`);
        nameCart.innerHTML = fish.name;

        let amountCart = row.insertCell(2);
        amountCart.setAttribute(`id`, `${fish.id}-amount-cart`);
        amountCart.innerHTML = fish.amount;

        let priceCart = row.insertCell(3);
        priceCart.setAttribute(`id`, `${fish.id}-price-cart`);
        priceCart.innerHTML = fish.price;

        let totalCart = row.insertCell(4);
        totalCart.setAttribute(`id`, `${fish.id}-total-cart`);
        totalCart.innerHTML = fish.total;

        totalamount = Number(totalamount) + Number(fish.total);

    });

    // Adds total amount at tablefoot
    document.getElementById("shoppingcart-totalamount").innerHTML = totalamount;
}