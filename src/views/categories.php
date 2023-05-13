<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title"><?= count($params['categories'])?></h2>
            <p class="stat-desc">Nombre de catégories</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title"><?= $params['category_active']?></h2>
            <p class="stat-desc">Catégories actives</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title"><?= $params['category_empty']?></h2>
            <p class="stat-desc">Catégories vides</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title"><?= $params['category_inactive']?></h2>
            <p class="stat-desc">Catégories inactives</p>
        </div>
    </div>
    <a href="/product" class="btn btn-dark btn-page">+ Ajouter une nouvelle catégorie</a>

    <div class="list">
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th class="table-right">Statut</th>
                <th class="table-right">Nombre d'articles</th>
                <th class="table-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['categories'] as $category): ?>
            <tr>
                <td class="hide"><?= $category->getID()?></td>
                <td class="list-large"><?= $category->getName()?></td>
                <td class="table-right status status-success <?= $category->getActive() ? 'status-success': 'status-danger'?>">
                    <?= $category->getActive() ? 'actif': 'Inactif'?>
                </td>
                <td class="table-right">36</td>
                <td class="table-right">
                    <a class="btn btn-action btn-info" href="/category/<?= $category->getID()?>">Modifier</a>
                    <a class="btn btn-action btn-red" href="/category-del/<?= $category->getID()?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>