<?php if(isset($params['errors']) && !is_array($params['errors'])): ?>
    <div class="alert-error"><?= $params['errors'] ?></div>
<?php endif; ?>
<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params['product']) ? 'Créer un article' : 'Modifier l\'article '?></h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="name">Nom
                <input type="text" name="name" value="<?=
                empty($params['product']) ?'':
                    $params['product']->getName()
                ?><?=
                empty($params['data']) ?'':
                    $params['data']['name']?>">
                <?php if (isset($params['errors']['name'])): ?>
                    <span class="input-error">*<?= $params['errors']['name'] ?></span>
                <?php endif; ?>
            </label>
        </div>
        <div class="form-group">
            <label for="description">Description
                <input type="text" name="description" value="<?=
                    empty($params['product']) ?'':
                        $params['product']->getDescription()
                    ?><?=
                    empty($params['data']) ?'':
                        $params['data']['description']?>">
                <?php if (isset($params['errors']['description'])): ?>
                    <span class="input-error">*<?= $params['errors']['description'] ?></span>
                <?php endif; ?>
            </label>
        </div>
        <div class="form-group">
            <label for="date">Date d'achat
                <input type="date" name="date" value="<?=
                empty($params['data']) ?'':
                    $params['data']['date']?>">
            </label>
        </div>
        <div class="form-group">
            <label for="quantity">Quantité
                <input type="number" name="quantity" value="<?=
                empty($params['data']) ?'':
                    $params['data']['quantity']?>" step="1">
                <?php if (isset($params['errors']['quantity'])): ?>
                    <span class="input-error">*<?= $params['errors']['quantity'] ?></span>
                <?php endif; ?>
            </label>
        </div>
        <div class="form-group">
            <label for="buyPrice">Prix de d'achat
                <input type="number" name="buyPrice" value="<?=
                empty($params['data']) ?'':
                    $params['data']['buyPrice']?>" step="0.01">
                <?php if (isset($params['errors']['buyPrice'])): ?>
                    <span class="input-error">*<?= $params['errors']['buyPrice'] ?></span>
                <?php endif; ?>
            </label>
        </div>
        <div class="form-group">
            <label for="salePrice">Prix de vente
                <input type="number" name="salePrice" value="<?=
                empty($params['data']) ?'':
                    $params['data']['salePrice']?>" step="0.01">
                <?php if (isset($params['errors']['salePrice'])): ?>
                    <span class="input-error">*<?= $params['errors']['salePrice'] ?></span>
                <?php endif; ?>
            </label>
        </div>
        <div class="form-group">
            <label for="category">Catégorie
                <select name="category">
                    <?php foreach ($params['categories'] as $cat): ?>
                        <option value="<?= $cat->getName() ?>" ><?= $cat->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="tva">TVA
                <select name="tva">
                    <?php foreach ($params['tva'] as $tva): ?>
                        <option value="<?= $tva->getName() ?>" ><?= $tva->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="status">Statut
                <select name="status">
                    <option value="1">ACTIF</option>
                    <option value="0">NON ACTIF</option>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="image">Image du produit
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/products'">Annuler</button>
</div>