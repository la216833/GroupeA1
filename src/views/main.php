<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armetiss</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <nav class="nav">
        <button class="btn btn-lg btn-active">link</button>
        <button class="btn  btn-lg btn-light">link</button>
        <button class="btn  btn-lg btn-light">link</button>
        <button class="btn  btn-lg btn-light">link</button>
        <button class="btn  btn-lg btn-light">link</button>
        <button class="btn  btn-lg btn-light">link</button>
        <button class="btn  btn-lg btn-light">link</button>
        <button class="btn  btn-lg btn-light">link</button>
    </nav>
    <div class="grid" id="products">
        <div class="card" id="1">
            <img class="card-img" src="https://imgs.search.brave.com/NrU6BUuYgNinz6B_0tEUpgLfXwg1k3boQgo62ZuJ8OY/rs:fit:773:1200:1/g:ce/aHR0cHM6Ly9wbHVz/cG5nLmNvbS9pbWct/cG5nL2NsYXNzaWMt/Y29rZS1ib3R0bGUt/Y29jYS1jb2xhLTc3/My5wbmc" alt="Image">
            <h2 class="card-title">Coca Cola 50Cl</h2>
            <h3 class="card-price">1.80€</h3>
            <p class="card-desc">Boisson sucrée petillante tres tres sucre</p>
        </div>
        <div class="card" id="2">
            <img class="card-img" src="https://imgs.search.brave.com/NrU6BUuYgNinz6B_0tEUpgLfXwg1k3boQgo62ZuJ8OY/rs:fit:773:1200:1/g:ce/aHR0cHM6Ly9wbHVz/cG5nLmNvbS9pbWct/cG5nL2NsYXNzaWMt/Y29rZS1ib3R0bGUt/Y29jYS1jb2xhLTc3/My5wbmc" alt="Image">
            <h2 class="card-title">Fanta 50Cl</h2>
            <h3 class="card-price">1.90€</h3>
            <p class="card-desc">Boisson sucrée petillante tres tres sucre</p>
        </div>
    </div>
    <div class="table">
        <div class="table-container">

            <img class="table-img" src="https://armetiss.be/img/logo-active.png" alt="Nom de l'entreprise">
            <h2 class="table-title">Ticket n°27897</h2>
            <table >
                <thead>
                <tr>
                    <th>Produit</th>
                    <th class="table-right">Qnte</th>
                    <th class="table-right">Total</th>
                </tr>
                </thead>
                <tbody id="table">
                <tr>
                    <td class="hide">0</td>
                    <td>Coca</td>
                    <td class="table-right">1</td>
                    <td class="table-right">1.1</td>
                    <td class="table-delete"></td>
                </tr>
                </tbody>
            </table>
            <div class="table-footer">
                <div class="table-total">
                    <p>Total <span id="total">0.00 €</span></p>
                    <div class="table-btn">
                        <button class="btn btn-md btn-red">Total</button>
                        <button class="btn btn-sm btn-red" id="showMore">+</button>
                    </div>
                </div>
                <div class="table-plus" id="plusContent">
                    <button class="btn btn-md btn-dark btn-space">Mettre en attente</button>
                    <button class="btn btn-md btn-dark btn-space">Retour article</button>
                    <button class="btn btn-md btn-dark btn-space">Note de credit</button>
                    <button class="btn btn-md btn-dark btn-space">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script defer>
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


</script>
</body>
</html>