<div class=" container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params) ? 'Ajouter une catégorie' : 'Modifier la catégorie '?></h2>
    <form method="post" class="form category-container">
        <div class="form-group">
            <label for="">Nom
                <input type="text" name="name" value="<?= empty($params) ? '': $params['category']->getName() ?>">
            </label>
        </div>
        <div class="form-group">
            <label for="">Description
                <input type="text" value="<?= empty($params) ? '': $params['category']->getDescription() ?>">
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
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/categories'">Annuler</button>
</div>