const btn = document.getElementById('showMore');                // Btn to show more options on ticket
const plusContent = document.getElementById('plusContent');     // Additional command related to btn
const products = document.getElementById('products');           // Products in the grid
const table = document.getElementById('table');                 // Ticket table
const totalText = document.getElementById('total');             // Text to modify current amount
const sidebar = document.getElementById('sidebar');             // Sidebar menu content
const sidebarBtn = document.getElementById('sidebarBtn');       // Sidebar button to show menu
const navBtns = document.getElementById('nav');                 // Category navigation on sale products
const catChoice = document.getElementById('catChoice');         // Select input to chose category
const userChoice = document.getElementById('userChoice');       // Select input to chose role
const productChoice = document.getElementById('artChoice');     // Select input to chose role
const clearCartBtn = document.getElementById('clearCartBtn');   // Clear Cart
const waitBtn = document.getElementById('waitBtn');             // Wait
const backBtn = document.getElementById('backBtn');             // Back
const soldBtn = document.getElementById('soldBtn');             // Sold
const modal = document.getElementById('modal');                 // Modal
const closeBtn = document.getElementById('closeModal');         // Close modal
const amountModal = document.getElementById('amount');          // Amount modal
const clientBtn = document.getElementById('clientBtn');         // Client
const printTicket = document.getElementById('printTicket');     // Button for ticket
const printInvoice = document.getElementById('printInvoice');   // Button for invoice
const jsonProduct = document.getElementById('json');            // JSON for data
const clientSelect = document.getElementById('clientSelect');   // JSON for data
const clientFrom = document.getElementById('clientFrom');       // JSON for data

if (printTicket !== null) {
    printTicket.addEventListener('click', () => {
        const json = JSON.parse(jsonProduct.value);
        const { jsPDF } = window.jspdf;

        const doc = new jsPDF();
        doc.text("Armetiss", 10, 10);
        doc.text("Rue Joseph Lambillotte 138B", 10, 16);
        doc.text("6040 JUMET", 10, 22);
        doc.text("0489/41.96.85", 10, 28);
        doc.text("Ticket numéro : " + json[json.length-1].number.toString(), 85, 36);
        // HEADER TICKET
        doc.text("Nom du produit", 10, 55);
        doc.text("Quantité", 120, 55);
        doc.text("Prix unitaire", 145, 55);
        doc.text("Montant", 185, 55);
        doc.text('--------------------------------------------------------------------------------------------------------', 10, 60);

        // ARTICLES
        let y = 70;
        for (let i = 0; i < json.length - 1; i++) {
            doc.text(json[i].name.toString(), 10, y);
            doc.text(json[i].quantity.toString(), 120, y);
            doc.text(json[i].price.toString(), 145, y);
            doc.text((json[i].quantity * json[i].price).toString(), 185, y);
            y += 6;
        }
        doc.text('--------------------------------------------------------------------------------------------------------', 10, y + 15);
        doc.text("TOTAL", 10, y + 20);
        doc.text(json[json.length-1].total.toFixed(2).toString(), 185, y + 20);

        doc.text("DATE : " + json[json.length-1].date.toString(), 10, y + 40);
        doc.text("Vous avez été servi par : " + json[json.length-1].served.toString(), 10,  y + 50);

        doc.save("ticket_"+ json[json.length-1].number.toString() +".pdf");
    })
}

if (printInvoice !== null) {
    printInvoice.addEventListener('click', () => {
        const json = JSON.parse(jsonProduct.value);
        const { jsPDF } = window.jspdf;

        const doc = new jsPDF();
        doc.text("Armetiss", 10, 10);
        doc.text("Rue Joseph Lambillotte 138B", 10, 16);
        doc.text("6040 JUMET", 10, 22);
        doc.text("0489/41.96.85", 10, 28);
        doc.text("FACTURE (" + json[json.length-1].number.toString() + ")", 85, 45);

        const id = parseInt(clientSelect.value);

        let name;
        let address;
        let city
        let TVA;

        if (!isNaN(id)) {
            for (let i = 1; i < clientSelect.children.length; i++) {
                if (id === parseInt(clientSelect.children[i].value)) {
                    let array = clientSelect.children[i].innerHTML
                    array = array.split(' | ')
                    name = array[0] + ' ' + array[1]
                    TVA = array[2]
                    address = array[3]
                    city = array[4]
                    break;
                }
            }
        } else {
            name = clientFrom.children[2].children[1].value + ' ' + clientFrom.children[3].children[1].value
            TVA = clientFrom.children[4].children[1].value
            address = clientFrom.children[6].children[1].value
            city = clientFrom.children[7].children[1].value;
        }

        // INVOICE
        doc.text(name, 110, 10);
        doc.text(address, 110, 16);
        doc.text(city, 110, 22);
        doc.text(TVA, 110, 28);

        // HEADER TICKET
        doc.text("Nom du produit", 10, 55);
        doc.text("Quantité", 120, 55);
        doc.text("Prix unitaire", 145, 55);
        doc.text("Montant", 185, 55);
        doc.text('--------------------------------------------------------------------------------------------------------', 10, 60);
        // ARTICLES
        let y = 70;
        for (let i = 0; i < json.length - 1; i++) {
            doc.text(json[i].name.toString(), 10, y);
            doc.text(json[i].quantity.toString(), 120, y);
            doc.text(json[i].price.toString(), 145, y);
            doc.text((json[i].quantity * json[i].price).toString(), 185, y);
            y += 6;
        }
        doc.text('--------------------------------------------------------------------------------------------------------', 10, y + 15);
        doc.text("TOTAL", 10, y + 20);
        doc.text(json[json.length-1].total.toFixed(2).toString(), 185, y + 20);

        doc.text("DATE : " + json[json.length-1].date.toString(), 10, y + 40);
        doc.text("Vous avez été servi par : " + json[json.length-1].served.toString(), 10,  y + 50);

        doc.save("facture_"+ json[json.length-1].number.toString() +".pdf");
    })
}

if (clientBtn !== null) {
    clientBtn.addEventListener('click', e => {
        document.clientFrom.action = '/sale/client';
    })
}


if (amountModal !== null) {
    const amount = amountModal.children[0].children[0].children[2].children[0].innerHTML
    const given = amountModal.children[0].children[0].children[0].children[1]
    const back = amountModal.children[0].children[0].children[1];
    const backInput = amountModal.children[0].children[0].children[2].children[1].children[0]
    const close = amountModal.children[0].children[3];

    back.addEventListener('click', () => {
        const givenAmount = parseFloat(given.value);
        const returnAmount = givenAmount - amount
        if (isNaN(returnAmount)) backInput.innerHTML = '0.00'
        else backInput.innerHTML = returnAmount.toFixed(2).toString();
    })

    close.addEventListener('click', () => {
        amountModal.style.display = 'none';
    })
}


if (closeBtn !== null) {
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
}

function cartContent() {
    let id = new Date().getTime().toString()

    let json = {
        id: id,
        products: [],
        total: 0,
    }

    for (let i = 0; i < table.children.length; i++) {
        let product = {
            id: parseInt(table.children[i].children[0].innerHTML),
            name: table.children[i].children[1].innerHTML,
            quantity: parseInt(table.children[i].children[2].innerHTML),
            price: parseFloat(table.children[i].children[3].innerHTML) / parseInt(table.children[i].children[2].innerHTML)
        }
        json.products.push(product)
        json.total += parseFloat(table.children[i].children[3].innerHTML)
    }

    return json;
}


if (waitBtn !== null) {
    waitBtn.addEventListener('click', e => {
        e.preventDefault();

        if (waitBtn.innerHTML === 'Reprendre un ticket') {
            modal.children[0].children[0].innerHTML = 'Reprendre un ticket en attente';
            modal.children[0].children[1].children[1].style.display = 'inline-block'
            modal.children[0].children[1].children[0].style.display = 'none'
            modal.children[0].children[1].children[1].children[0].innerHTML = 'Sélectionner un ticket';
            modal.style.display = 'block';
            document.modalForm.action = '/sale/resume/1';
        } else {
            modal.children[0].children[0].innerHTML = 'Confirmez la mise en attente';
            modal.children[0].children[1].children[1].style.display = 'none'
            modal.children[0].children[1].children[0].style.display = 'none'
            modal.children[0].children[1].children[2].style.marginTop = '50px';
            modal.style.display = 'block';

            const json = cartContent();

            modal.children[0].children[1].children[0].children[1].value = JSON.stringify(json);

            document.modalForm.action = '/sale/save/' + json.id;
        }
    })
}

if (backBtn !== null) {
    backBtn.addEventListener('click', e => {
        e.preventDefault();
        document.modalForm.action = '/sale/return/1';
        modal.children[0].children[0].innerHTML = 'Retour article(s)';
        modal.children[0].children[1].children[0].style.display = 'inline-block'
        modal.children[0].children[1].children[1].style.display = 'none'
        modal.children[0].children[1].children[0].children[0].innerHTML = 'Entrez le numéro de ticket';
        modal.children[0].children[1].children[0].children[1].value = ''
        modal.children[0].children[1].children[1].children[1].children[0].value = JSON.stringify(cartContent());
        modal.style.display = 'block';
    })
}

if (soldBtn !== null) {
    soldBtn.addEventListener('click', e => {
        e.preventDefault();
        if (soldBtn.innerHTML === 'Avancer les articles') {
            modal.children[0].children[0].innerHTML = 'Confirmer l\'avance';
            modal.children[0].children[1].children[1].style.display = 'none'
            modal.children[0].children[1].children[0].style.display = 'none'
            modal.children[0].children[1].children[0].children[1].value = ''
            modal.children[0].children[1].children[1].children[1].children[0].value = JSON.stringify(cartContent());
            modal.style.display = 'block';
            document.modalForm.action = '/sale/advance';
        } else {
            modal.children[0].children[0].innerHTML = 'Payer un retard';
            modal.children[0].children[1].children[0].style.display = 'inline-block'
            modal.children[0].children[1].children[1].style.display = 'none'
            modal.children[0].children[1].children[0].children[0].innerHTML = 'Entrez le numéro de ticket';
            modal.children[0].children[1].children[0].children[1].value = ''
            modal.children[0].children[1].children[2].style.marginTop = '50px';
            modal.children[0].children[1].children[1].children[1].children[0].value = ''
            modal.style.display = 'block';
            document.modalForm.action = '/sale/advance/1';
        }
    })
}

/*
* Remove all element from table
*
* Event Listener that clear the table
*
* */
if (clearCartBtn !== null) {
    clearCartBtn.addEventListener('click', e => {
        e.preventDefault();
        table.innerHTML = ''
        totalText.innerHTML = '0.00 €'
    })
}

/*
* Show or hide content
*
* Event Listener that hides and shows more content
*
* */
if (btn != null) {
    btn.addEventListener('click', e => {
        e.preventDefault();
        plusContent.classList.toggle('show');
        btn.innerHTML = btn.innerHTML === "+" ? "-": "+";
        table.children.length === 0 ? waitBtn.innerHTML = 'Reprendre un ticket' : waitBtn.innerHTML = 'Mettre en' +
            ' attente' ;

        table.children.length === 0 ?  soldBtn.innerHTML = 'Payer un retard' : soldBtn.innerHTML = 'Avancer les' +
            ' articles' ;
    })
}

/*
*
*  Add product to cart
*
* */
if (products != null) {
    products.addEventListener('click', event => {
        let card = event.target.closest('.card');
        addToCart(card)
        total();
    })
}

/*
*
*  Delete or remove one by one product from cart
*
* */
if (table != null) {
    table.addEventListener('click', event => {
        if(event.target.classList.value === 'table-delete') {
            const row = event.target.closest('tr')
            let quantity = parseInt(row.children[2].innerHTML)
            let price = parseFloat(row.children[3].innerHTML)
            if (quantity === 1) {
                table.removeChild(row)
            }

            row.children[2].innerHTML = (quantity - 1)
            row.children[6].children[0].value -= 1;
            row.children[3].innerHTML = (price - price/quantity).toFixed(2)
            total();
        }

    })
}

/*
* Show or hide sidebar menu
*
* Event Listener that hides and shows sidebar menu on click event
*
* */
if (sidebarBtn != null) {
    sidebarBtn.addEventListener('click', () => {
        sidebarBtn.classList.toggle('enable');
        sidebar.classList.toggle('show');
        sidebarBtn.innerHTML = sidebarBtn.classList.contains('enable') ? "<": ">";
    })
}


/*
* Load products by category in sale view
*
* Event Listener that hides and shows products in grid
* depending on the category selected
*
* */
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

/*
* Load products by category
*
* Event Listener that hides and shows products in list (table tag)
* depending on the category selected
*
* */
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

/*
* Load users by role
*
* Event Listener that hides and shows users in list (table tag)
* depending on the role selected
*
* */
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

/*
* Load users by role
*
* Event Listener that hides and shows users in list (table tag)
* depending on the role selected
*
* */
if (productChoice != null) {
    productChoice.addEventListener('change', () => {
        const type = productChoice.value
        const table = document.getElementsByTagName('table')
        const products = table[0].children[1].children;
        for (let i = 0; i < products.length; i++) {
            const productType =  products[i].children[0].innerHTML;
            if (type !== '0') {
                if (productType !== type) {
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

/*
* Add to cart
*
* Add product to cart or increase quantity it is
* already in cart
*
* */
function addToCart(card) {
    let exist = false;
    let quantity = 1;
    let price = parseFloat(card.children[2].innerHTML.slice(0, -1));
    for (let i = 0; i < table.children.length; i++) {
        for (let j = 0; j < table.children[i].children.length; j++) {
            if (table.children[i].children[0].innerHTML === card.id) {
                quantity = parseInt(table.children[i].children[2].innerHTML) + 1;
                table.children[i].children[2].innerHTML = quantity.toString();
                table.children[i].children[6].children[0].value = quantity.toString();
                table.children[i].children[3].innerHTML = (quantity * price).toFixed(2);
                exist = true;
                break;
            }
        }
    }

    // HTML generating
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


/*
*
*  Get the sum of all products
*
* */
function total() {
    let priceTot = 0;
    for (let i = 0; i < table.children.length; i++)
        priceTot += parseFloat(table.children[i].children[3].innerHTML)

    totalText.innerHTML = priceTot.toFixed(2) + " €"
}