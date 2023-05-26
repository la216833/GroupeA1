<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title"><?= count($params['stocks'])?></h2>
            <p class="stat-desc">Stock totale</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title"><?= $params['stock_available'] ?></h2>
            <p class="stat-desc">Stocks d'article actif</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title"><?= $params['stock_sold'] ?></h2>
            <p class="stat-desc">Stocks ecoule</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title"><?= $params['stock_unavailable'] ?></h2>
            <p class="stat-desc">Stocks d'article inactif</p>
        </div>
    </div>
    <a href="/stock" class="btn btn-dark btn-page">+ Ajouter un nouveau stock</a>
    <form class="stock-form">
        <label>
            <select class="form-select" name="article" id="artChoice">
                <option value="0">Tous les articles</option>
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
                <th class="table-center">Produit</th>
                <th class="table-left">Quantité</th>
                <th class="table-left">Date d'achat</th>
                <th class="table-left">Prix d'achat</th>
                <th class="table-left">En activite</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['stocks'] as $stock):?>
            <tr>
                <td class="table-center"><?= $stock->getProduct()->getName() ?></td>
                <td class="table-center"><?= $stock->getQuantity() ?></td>
                <td class="table-center"><?= $stock->getDate() ?></td>
                <td class="table-center"><?= $stock->getBuyPrice() ?></td>
                <td class="table-center"><?= $stock->getActive() ?></td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
