const btn = document.getElementById('showMore');
const plusContent = document.getElementById('plusContent')
const products = document.getElementById('products');
const table = document.getElementById('table');
const totalText = document.getElementById('total');

const sidebar = document.getElementById('sidebar');
const sidebarBtn = document.getElementById('sidebarBtn');

const navBtns = document.getElementById('nav');

const catChoice = document.getElementById('catChoice')
const userChoice = document.getElementById('userChoice')

if (catChoice != null) {
    catChoice.addEventListener('change', () => {
        const cat = catChoice.value
        const table = document.getElementsByTagName('table')
        const products = table[0].children[1].children;
        for (let i = 0; i < products.length; i++) {
            const productCat =  products[i].children[1].innerHTML;
            if (cat !== '0') {
                if (productCat !== cat) {
                    products[i].style.display = 'none';
                } else {
                    products[i].style.display = 'table-row';
                }
            } else {
                products[i].style.display = 'table-row';
            }
        }
    })
}

if (userChoice != null) {
    userChoice.addEventListener('change', () => {
        const type = userChoice.value
        const table = document.getElementsByTagName('table')
        const users = table[0].children[1].children;
        for (let i = 0; i < users.length; i++) {
            const userType =  users[i].children[1].innerHTML;
            if (type !== '0') {
                if (userType !== type) {
                    users[i].style.display = 'none';
                } else {
                    users[i].style.display = 'table-row';
                }
            } else {
                users[i].style.display = 'table-row';
            }
        }
    })
}

if (navBtns != null) {
    navBtns.addEventListener('click', event => {
        if(event.target.classList.value.includes('btn')) {
            const cat = event.target.innerHTML;
            products.childNodes.forEach(p => {
                if (p.nodeName === 'DIV') {
                    if (event.target.getAttribute('aria-details') === 'all') {
                        p.style.display = 'block';
                        return;
                    }
                    if (cat !== p.getAttribute('aria-details')) {
                        p.style.display = 'none';
                    } else {
                        p.style.display = 'block'
                    }
                }
            })
            navBtns.childNodes.forEach(btn => {
                if (btn.nodeName === 'BUTTON') {
                    if (cat === btn.innerHTML) {
                        if (btn.classList.value.includes('btn-light')) btn.classList.remove('btn-light')
                        if (!btn.classList.value.includes('btn-active')) btn.classList.add('btn-active')
                    } else {
                        if (!btn.classList.value.includes('btn-light')) btn.classList.add('btn-light')
                        if (btn.classList.value.includes('btn-active')) btn.classList.remove('btn-active')
                    }
                }
            })
        }

    })
}

if (sidebarBtn != null) {
    sidebarBtn.addEventListener('click', () => {
        sidebarBtn.classList.toggle('enable');
        sidebar.classList.toggle('show');
        sidebarBtn.innerHTML = sidebarBtn.classList.contains('enable') ? "<": ">";

    })
}

if (btn != null) {
    btn.addEventListener('click', () => {
        plusContent.classList.toggle('show');
        btn.innerHTML = btn.innerHTML === "+" ? "-": "+";
    })
}

if (products != null) {
    products.addEventListener('click', event => {
        let card = event.target.closest('.card');
        addToCart(card)
        total();
    })
}


if (table != null) {
    table.addEventListener('click', event => {
        if(event.target.classList.value === 'table-delete') {
            const row = event.target.closest('tr')
            let quantity = parseInt(row.childNodes[2].innerHTML)
            let price = parseFloat(row.childNodes[3].innerHTML)
            if (quantity === 1) {
                table.removeChild(row)
            }

            row.childNodes[2].innerHTML = (quantity - 1)
            row.childNodes[6].childNodes[0].value -= 1;
            row.childNodes[3].innerHTML = (price - price/quantity).toFixed(2)
            total();
        }

    })
}

function addToCart(card) {
    let exist = false;
    let quantity = 1;
    let price = parseFloat(card.childNodes[5].innerHTML.slice(0, -1));

    for (let i = 0; i < table.childNodes.length; i++) {
        if (table.childNodes[i].nodeName === 'TR') {
            for (let j = 0; j < table.childNodes[i].childNodes.length; j++) {
                if (table.childNodes[i].childNodes[j].nodeName === 'TD') {
                    if (table.childNodes[i].childNodes[j].classList[0] === 'hide')
                        if(table.childNodes[i].childNodes[j].innerHTML === card.id) {
                            quantity = parseInt(table.childNodes[i].childNodes[2].innerHTML) + 1;
                            table.childNodes[i].childNodes[2].innerHTML = quantity;
                            table.childNodes[i].childNodes[6].childNodes[0].value = quantity;
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

        let idHide = row.insertCell(5);
        let qntHide = row.insertCell(6);

        idHide.classList.add('hide');
        qntHide.classList.add('hide');

        idHide.innerHTML =`<input type="number" name="${card.children[1].innerHTML}" value="${card.id}">`
        qntHide.innerHTML =`<input type="number" name="${card.children[1].innerHTML}_QNT" value="1">`

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
        if (table.childNodes[i].nodeName === 'TR') {
            for (let j = 0; j < table.childNodes[i].childNodes.length; j++) {
                if (table.childNodes[i].childNodes[j].nodeName === 'TD') {
                    if (table.childNodes[i].childNodes[j].classList[0] === 'hide')
                        if (!isNaN(table.childNodes[i].childNodes[3].innerHTML))
                            priceTot += parseFloat(table.childNodes[i].childNodes[3].innerHTML);
                }
            }
        }
    }

    totalText.innerHTML = priceTot.toFixed(2) + " €"
}