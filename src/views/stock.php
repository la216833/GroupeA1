<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title"><?= count($params['stocks'])?></h2>
            <p class="stat-desc">Stock totale</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title"><?= $params['stock_available'] ?></h2>
            <p class="stat-desc">Stocks en vente</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title"><?= $params['selled_stock'] ?></h2>
            <p class="stat-desc">Stocks vendus</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title"><?= $params['stock_unavailable'] ?></h2>
            <p class="stat-desc">Stocks non mis en vente</p>
        </div>
    </div>
    <a href="/stock" class="btn btn-dark btn-page">+ Ajouter un nouvel stock</a>
    <form>
        <label>
            <select class="form-select" name="article" id="artChoice">
                <option value="0">Toute les articles</option>
                <?php foreach ($params['articles'] as $article): ?>
                    <option value="<?= $article->getID()?>"><?= $article->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </form>

    <div class="list">
        <table>
            <thead>
            <tr>
                <th class="table-right">Produit</th>
                <th class="table-right">Statut</th>
                <th class="table-right">Quantité</th>
                <th class="table-right">Date d'achat</th>
                <th class="table-right">Prix d'achat</th>
                <th class="table-right">En activite</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['stocks'] as $stock): ?>
                <tr>
                    <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
