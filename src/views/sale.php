<div class="container">
    <nav class="nav">
        <?php foreach ($params['categories'] as $category): ?>
        <button class="btn btn-lg btn-light"><?= $category->getName(); ?></button>
        <?php endforeach; ?>
    </nav>
    <div class="grid" id="products">
        <?php foreach ($params['products'] as $product): ?>
            <div class="card" id="<?= $product->getID(); ?>">
                <img class="card-img" src="<?= $product->getImagePath(); ?>" alt="<?= $product->getName(); ?>">
                <h2 class="card-title"><?= $product->getName(); ?></h2>
                <h3 class="card-price"><?= $product->getPrice(); ?>€</h3>
                <p class="card-desc"><?= $product->getDescription(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="table">
        <div class="table-container">
            <img class="table-img" src="https://armetiss.be/img/logo-active.png" alt="Nom de l'entreprise">
            <h2 class="table-title">Ticket n°27897</h2>
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
                    </tbody>
                </table>
            </div>
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
