// Global variable cart withi in all fishes in the shoping cart
var cart = [];

// Triggers addition to the cart
function start(it) {
    console.log("runnunig shop.js");
    addPrintCart(it);
}

// Adds new fish to cart and prints/refreshes the shoppingcart on the page
function addPrintCart(){
    console.log("called addPrintCart")

    // Unhide and clear shoppingcart table
    $("#shoppingcart").show();
    $("#shoppingcart").find("tr").remove();
    $("#shoppingcart").find("thead").remove();
    // Fill shoppingcart tablehead
    $("#shoppingcart").append(`<thead>
        <th hidden>id</th>
        <th>Name</th>
        <th>Menge</th>
        <th>Preis</th>
        <th>Betrag</th>
    </thhead>`);

    // Fill shoppingcart table
    cart.forEach(fish => function(){ 
        $("#shoppingcart").append(`
            <tr>
                <td hidden>${fish['id']}</td>
                <td>${fish['name']}</td>
                <td>${fish['ammount']}</td>
                <td>${fish['price']}</td>
                <td>${fish['total']}</td>
            </tr>
        `)

    // Adds total amount at tablefoot
    $("#shoppingcart").append(`<tfoot>
        <tf hidden></th>
        <tf></tf>
        <tf></tf>
        <tf></tf>
        <tf>${totalamount}</tf>
    </tfoor>`);
    });
}