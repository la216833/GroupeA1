<?php global $session; ?>

<div class="modal" id="modal">
    <div class="modal-content">
        <h1></h1>
        <form id="modalForm" name="modalForm" action="" method="post">
            <div class="form-group">
                <label for="value"></label>
                <input id="value" name="value" type="text">
            </div>
            <?php if (!empty($params['saved'])): ?>
            <div class="form-group">
                <label for="save"></label>
                <select name="save" id="save">
                    <?php foreach($params['saved'] as $name => $value): ?>
                    <option value="<?= $name ?>"><?= explode("_", $name)[1] . ' : '. $value . '€'?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>
            <br>
            <input class="btn btn-large btn-dark btn-space" type="submit" value="Valider">
        </form>
        <button id="closeModal" class="btn btn-large btn-red btn-space">Annuler</button>
    </div>
</div>

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
            <img class="table-img" src="https://armetiss.be/img/logo-active.png" alt="Nom de l'entreprise">
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
                                    <label>
                                        <input type="number" name="<?= $product->name ?>" value="<?= $product->id ?>">
                                    </label>
                                </td>
                                <td class="hide">
                                    <label>
                                        <input type="number" name="<?= $product->name ?>_QNT" value="<?= $product->quantity ?>">
                                    </label>
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
