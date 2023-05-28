<?php if (isset($params['errors']) && !is_array($params['errors'])): ?>
    <div class="alert-error"><?= $params['errors'] ?></div>
<?php endif; ?>
<div class=" container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params['category']) ? 'Ajouter une catégorie' : 'Modifier la catégorie '?></h2>
    <form method="post" class="form category-container">
        <div class="form-group">
            <label for="name">Nom
                <input type="text" name="name" value="<?=
                empty($params['category']) ? '':
                    $params['category']->getName()
                ?><?=
                empty($params['data']) ? '':
                    $params['data']['name']?>">
                <?php if (isset($params['errors']['name'])): ?>
                    <span class="input-error">*<?= $params['errors']['name'] ?></span>
                <?php endif;?>
            </label>
        </div>
        <div class="form-group">
            <label for="description">Description
                <input type="text" name="description" value="<?=
                empty($params['data']) ? '':
                    $params['data']['description']?>">
                <?php if (isset($params['errors']['description'])): ?>
                    <span class="input-error">*<?= $params['errors']['description'] ?></span>
                <?php endif;?>
            </label>
        </div>
        <div class="form-group">
            <label for="status">Statut
                <select name="status">
                    <option value="0" <?= isset($params["category"]) && $params["category"]->getActive() == 0 ? 'selected="selected"' : ''
                    ?>>NON ACTIF</option>
                    <option value="1" <?= isset($params["category"]) && $params["category"]->getActive() == 1 ? 'selected="selected"' : ''
                    ?>>ACTIF</option>
                </select>
            </label>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/categories'">Annuler</button>
</div>