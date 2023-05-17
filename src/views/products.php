<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title"><?= count($params['products'])?></h2>
            <p class="stat-desc">Nombre d'article total</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title"><?= $params['product_available'] ?></h2>
            <p class="stat-desc">Articles en vente</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title"><?= $params['product_out_of_stock'] ?></h2>
            <p class="stat-desc">Articles en rupture de stock</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title"><?= $params['product_unavailable'] ?></h2>
            <p class="stat-desc">Articles non mis en vente</p>
        </div>
    </div>
    <a href="/product" class="btn btn-dark btn-page">+ Ajouter un nouvel article</a>
    <form>
        <label>
            <select class="form-select" name="category" id="catChoice">
                <option value="0">Toute les categories</option>
                <?php foreach ($params['categories'] as $category): ?>
                    <option value="<?= $category->getID()?>"><?= $category->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </form>

    <div class="list">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="table-right">Statut</th>
                    <th class="table-right">Quantité</th>
                    <th class="table-right">Prix</th>
                    <th class="table-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params['products'] as $product): ?>
                <tr>
                    <td class="hide"><?= $product->getID()?></td>
                    <td class="hide"><?= $product->getCategory()->getID()?></td>
                    <td class="list-large"><?= $product->getName()?></td>
                    <td class="table-right status <?= $product->getActive() ? 'status-success': 'status-danger'?>">
                        <?= $product->getActive() ? 'ACTIF': 'INACTIF'?>
                    </td>
                    <td class="table-right"><?= $params['quantities'][$product->getName()]?></td>
                    <td class="table-right"><?= $product->getPrice()?></td>
                    <td class="table-right">
                        <a class="btn btn-action btn-info" href="/product/<?= $product->getID()?>">Modifier</a>
                        <?php if($product->getActive()): ?>
                        <a class="btn btn-action btn-red"
                            href="/product/delete/<?= $product->getID()?>"
                            onclick="return confirm('Êtes vous sure de supprimer <?= $product->getName() ?>')
                            ">Supprimer</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>