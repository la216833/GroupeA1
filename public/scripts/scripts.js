const btn = document.getElementById('showMore');
const plusContent = document.getElementById('plusContent')
const products = document.getElementById('products');
const table = document.getElementById('table');
const totalText = document.getElementById('total');

btn.addEventListener('click', () => {
    plusContent.classList.toggle('show');
    btn.innerHTML = btn.innerHTML == "+" ? "-": "+";
})

products.addEventListener('click', event => {

    let card = event.target.closest('.card');

    addToCart(card)
    total();

})

table.addEventListener('click', event => {
    if(event.target.classList.value == 'table-delete') {
        const row = event.target.closest('tr')
        let quantity = parseInt(row.childNodes[2].innerHTML)
        let price = parseFloat(row.childNodes[3].innerHTML)
        if (quantity === 1) {
            table.removeChild(row)
        }

        row.childNodes[2].innerHTML = (quantity - 1)
        row.childNodes[3].innerHTML = (price - price/quantity).toFixed(2)
        total();
    }

})

function addToCart(card) {
    let exist = false;
    let quantity = 1;
    let price = parseFloat(card.childNodes[5].innerHTML.slice(0, -1));

    for (let i = 0; i < table.childNodes.length; i++) {
        if (table.childNodes[i].nodeName == 'TR') {
            for (let j = 0; j < table.childNodes[i].childNodes.length; j++) {
                if (table.childNodes[i].childNodes[j].nodeName == 'TD') {
                    if (table.childNodes[i].childNodes[j].classList[0] == 'hide')
                        if(table.childNodes[i].childNodes[j].innerHTML == card.id) {
                            quantity = parseInt(table.childNodes[i].childNodes[2].innerHTML) + 1;
                            table.childNodes[i].childNodes[2].innerHTML = quantity;
                            table.childNodes[i].childNodes[3].innerHTML = (quantity * price).toFixed(2);
                            exist = true;
                            break;
                        }
                }
            }
        }
    }

    if (!exist) {
        let row = table.insertRow(-1);
        let id = row.insertCell(0)
        let name = row.insertCell(1);
        let quantityCell = row.insertCell(2);
        let priceCell = row.insertCell(3);
        let deleteBtn = row.insertCell(4);

        id.classList.add('hide');
        quantityCell.classList.add('table-right');
        priceCell.classList.add('table-right');
        deleteBtn.classList.add('table-delete');

        id.innerHTML = card.id
        name.innerHTML = card.childNodes[3].innerHTML
        quantityCell.innerHTML = 1
        priceCell.innerHTML = (price * quantity).toFixed(2);
    }
}

function total() {
    let priceTot = 0;
    for (let i = 0; i < table.childNodes.length; i++) {
        if (table.childNodes[i].nodeName == 'TR') {
            for (let j = 0; j < table.childNodes[i].childNodes.length; j++) {
                if (table.childNodes[i].childNodes[j].nodeName == 'TD') {
                    if (table.childNodes[i].childNodes[j].classList[0] == 'hide')
                        if (!isNaN(table.childNodes[i].childNodes[3].innerHTML))
                            priceTot += parseFloat(table.childNodes[i].childNodes[3].innerHTML);
                }
            }
        }
    }

    totalText.innerHTML = priceTot.toFixed(2) + " €"
}