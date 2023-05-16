<?php if(isset($params['errors'])): ?>
    <div class="alert-error"><?= $params['errors'] ?></div>
<?php endif; ?>
<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params['product']) ? 'Créer un article' : 'Modifier l\'article '?></h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="name">Nom
                <input type="text" name="name" value="<?= empty($params['product']) ?'': $params['product']->getName() ?>">
            </label>
        </div>
        <div class="form-group">
            <label for="description">Description
                <input type="text" name="description" value="<?= empty($params['product']) ?'':
                    $params['product']->getDescription()
                ?>">
            </label>
        </div>
        <div class="form-group">
            <label for="buyPrice">Prix de d'achat
                <input type="number" name="buyPrice" value="0" step="0.1">
            </label>
        </div>
        <div class="form-group">
            <label for="salePrice">Prix de vente
                <input type="number" name="salePrice" value="0" step="0.1">
            </label>
        </div>
        <div class="form-group">
            <label for="">Catégorie
                <select name="category">
                    <?php foreach ($params['categories'] as $cat): ?>
                        <option value="<?= $cat->getName() ?>" ><?= $cat->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="">Statut
                <select name="status">
                    <option value="1">ACTIF</option>
                    <option value="0">NON ACTIF</option>
                </select>
            </label>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/products'">Annuler</button>
</div>