
var prices = document.getElementsByClassName("prices");
var purchases = document.getElementsByClassName("purchases");


function calculateTotalSales() {
    var totalSales = document.getElementById("totalSales");
    var total = 0;

    for(var i = 0; i < prices.length; ++i) {
        var amount = prices[i].innerHTML;
        var count = purchases[i].innerHTML;

        total += formatAmount(amount) * parseInt(count);
    }
    totalSales.innerHTML =  '$' + total;
    totalSales.style.color = "green";
}

function formatAmount(amount)
{
    var result = amount.replace('$', '').replace(',', '');

    return parseFloat(result);
}

function increment(id) {
    var value = document.getElementById(id);
    value.innerHTML = parseInt(value.innerHTML) + 1;

    calculateTotalSales();
}

function decrement(id) {
    var value = document.getElementById(id);
    if (value.innerHTML > 0) {
        value.innerHTML -= 1;
    }

    calculateTotalSales();
}
