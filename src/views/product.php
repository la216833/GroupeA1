<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params) ? 'Ajouter une article' : 'Modifier l\'article '?></h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="name">Nom
                <input type="text" name="name" value="<?= empty($params) ?: $params['product']->getName() ?>">
            </label>
        </div>
        <div class="form-group">
            <label for="">Description
                <input type="text" value="<?= empty($params) ?: $params['product']->getDescription() ?>">
            </label>
        </div>
        <div class="form-group">
            <label for="">Prix de vente
                <input type="number">
            </label>
        </div>
        <div class="form-group">
            <label for="">Prix de d'achat
                <input type="number">
            </label>
        </div>
        <div class="form-group">
            <label for="">Catégorie
                <select name="category">
                    <option value="" ><?= empty($params) ?: $params['product']->getCategory()->getName() ?></option>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="">Statut
                <select name="status">
                    <option value="1">Actif</option>
                    <option value="0">Non actif</option>
                </select>
            </label>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/products'">Annuler</button>
</div>