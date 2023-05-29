<?php global $session; ?>

<div class="modal" id="modal">
    <div class="modal-content">
        <h1></h1>
        <form id="modalForm" name="modalForm" action="" method="post">
            <div class="form-group">
                <label for="value"></label>
                <input id="value" name="value" type="text">
            </div>
            <div class="form-group">
                <label for="save"></label>
                <select name="save" id="save">
                    <option value=""></option>
                    <?php foreach($params['saved'] as $name => $value): ?>
                    <option value="<?= $name ?>"><?= explode("_", $name)[1] . ' : '. $value . '€'?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <input class="btn btn-large btn-dark btn-space" type="submit" value="Valider">
        </form>
        <button id="closeModal" class="btn btn-large btn-red btn-space">Annuler</button>
    </div>
</div>

<?php if ($session->get('amount')): ?>
<div class="modal" id="amount" style="display: block">
    <div class="modal-content" style="height: 520px; width: 800px">
        <div class="modal-border">
            <div class="form-group">
                <label for="givenAmount">Montant reçu:</label>
                <input type="number" id="givenAmount">
            </div>
            <button class="btn btn-dark-active btn-space">A rendre</button>
            <h1>
                TOTAL : <b><?= $session->get('amount') ?></b>€
                <span style="margin-left: 10px">A RENDRE :
                    <b>0.00</b>€</span>
            </h1>
        </div>
        <div class="modal-border">
            <form action="" method="post" name="clientFrom" id="clientFrom">
                <div class="form-group">
                    <label for="clientSelect">Choisir un client</label>
                    <select name="client" id="clientSelect">
                        <option value=""></option>
                        <?php foreach($params['clients'] as $client): ?>
                            <option value="<?= $client->getID() ?>"><?= $client->getName()
                                .' | '. $client->getFirstname()
                                .' | '. $client->getTvaNumber()
                                .' | '. $client->getAddress()->getStreet()
                                .' '. $client->getAddress()->getNumber()
                                .' | '. $client->getAddress()->getCity()
                                .' '. $client->getAddress()->getCountry()
                                ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="clientName">Nom :</label>
                    <input type="text" name="clientName" id="clientName">
                </div>
                <div class="form-group">
                    <label for="clientFirstName">Prénom :</label>
                    <input type="text" name="clientFirstName" id="clientFirstName">
                </div>
                <div class="form-group">
                    <label for="clientTVA">TVA :</label>
                    <input type="text" name="clientTVA" id="clientTVA">
                </div>
                <div class="form-group">
                    <label for="clientEmail">Email :</label>
                    <input type="text" name="clientEmail" id="clientEmail">
                </div>
                <div class="form-group">
                    <label for="clientAddress">Adresse :</label>
                    <input type="text" name="clientAddress" id="clientAddress">
                </div>
                <div class="form-group">
                    <label for="clientCity">Ville :</label>
                    <input type="text" name="clientCity" id="clientCity">
                </div>
                <input class="btn btn-dark btn-space" type="submit" id="clientBtn" value="Enregistrer">
            </form>
        </div>
        <br>
        <button class="btn btn-red btn-lg">Fermer</button>
        <button class="btn btn-red btn-lg" id="printTicket">Imprimer ticket</button>
        <button class="btn btn-red btn-lg" id="printInvoice">Imprimer facture</button>
        <input id="json" class="hide" type="text" value='<?= json_encode($session->get('products')) ?>'>
    </div>
</div>
<?php if (!empty($session)) $session->remove('amount');?>
<?php if (!empty($session)) $session->remove('products');?>
<?php endif; ?>

<div class="container">
    <nav class="nav" id="nav">
        <button class="btn btn-lg btn-active" aria-details="all">Tous les produits</button>
        <?php foreach ($params['categories'] as $category): ?>
        <button class="btn btn-lg btn-light"><?= $category->getName(); ?></button>
        <?php endforeach; ?>
    </nav>
    <div class="grid" id="products">
        <?php foreach ($params['products'] as $product): ?>
            <div class="card" id="<?= $product->getID(); ?>" aria-details="<?= $product->getCategory()->getName(); ?>">
                <img class="card-img" src="/images/<?= $product->getImagePath(); ?>" alt="<?= $product->getName(); ?>">
                <h2 class="card-title"><?= $product->getName(); ?></h2>
                <h3 class="card-price"><?= $product->getPrice(); ?>€</h3>
                <p class="card-desc"><?= $product->getDescription(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <form method="post" class="table">
        <div class="table-container">
            <img class="table-img" src="/images/logo.svg" alt="Nom de l'entreprise">
            <h2 class="table-title">Ticket n°<?= $params['number'] ?></h2>
            <div class="table-wrapper">
                <table >
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th class="table-right">Qnte</th>
                        <th class="table-right">Total</th>
                    </tr>
                    </thead>
                    <tbody id="table">
                    <?php if ($session->get('save') !== null && $session->get('save') !== false): ?>
                        <?php $total = 0.00; ?>
                        <?php foreach ($session->get('save')->products as $product): ?>
                        <?php $total += $product->quantity * $product->price; ?>
                            <tr>
                                <td class="hide"><?= $product->id ?></td>
                                <td><?= $product->name ?></td>
                                <td class="table-right"><?= $product->quantity ?></td>
                                <td class="table-right"><?= $product->quantity * $product->price ?></td>
                                <td class="table-delete"></td>
                                <td class="hide">
                                    <input type="number" name="<?= $product->name ?>" value="<?= $product->id ?>">
                                </td>
                                <td class="hide">
                                    <input type="number" name="<?= $product->name ?>_QNT" value="<?= $product->quantity ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php $session->remove('save'); ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="table-footer">
                <div class="table-total">
                    <p>Total <span id="total"><?= $total ?? '0.00' ?> €</span></p>
                    <div class="table-btn">
                        <button id="" class="btn btn-md btn-red" type="submit">Total</button>
                        <button class="btn btn-sm btn-red" id="showMore">+</button>
                    </div>
                </div>
                <div class="table-plus" id="plusContent">
                    <button id="waitBtn" class="btn btn-md btn-dark btn-space">Mettre en
                        attente</button>
                    <button id="backBtn"  class="btn btn-md btn-dark btn-space">Retour
                        article</button>
                    <button id="soldBtn" class="btn btn-md btn-dark btn-space">Avancer les
                        articles</button>
                    <button id="clearCartBtn" class="btn btn-md btn-dark btn-space">Annuler</button>
                </div>
            </div>
        </div>
    </form>
</div>