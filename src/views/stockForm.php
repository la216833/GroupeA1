<?php if (isset($params['errors'])): ?>

    <div class="alert-error">
        <?= $params['errors']; ?>
    </div>

<?php endif; ?>

<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"> Gestion du stock </h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="productId">Article</label>
            <select name="productId">
                <?php foreach ($params['products'] as $product):?>
                    <option value="<?= $product->getID() ?>"><?= $product->getName() ?> </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantite</label>
            <input name="quantity" type="number" min="1">
        </div>
        <div class="form-group">
            <label for="">Prix d'achat</label>
            <input name="buyPrice" type="number" min="0">
        </div>
        <br>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/stocks'">Annuler</button>
</div>