<?php if (isset($params['errors']) && !is_array($params['errors'])): ?>
    <div class="alert-error"><?= $params['errors'] ?></div>
<?php endif; ?>
<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params) ? 'Ajouter un utilisateur' : 'Modifier l\'utilisateur' ?></h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" value="<?=
            empty($params['user']) ?'':
                $params['user']->getName()
            ?><?=
            empty($params['data']) ? '':
                $params['data']['name']?>">
            <?php if (isset($params['errors']['name'])): ?>
                <span class="input-error">*<?= $params['errors']['name'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" value="<?=
            empty($params['user']) ?'':
                $params['user']->getFirstName()
            ?><?=
            empty($params['data']) ? '':
                $params['data']['firstname']?>">
            <?php if (isset($params['errors']['firstname'])): ?>
                <span class="input-error">*<?= $params['errors']['firstname'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="accesscode">Code d'accès</label>
            <input type="password" name="accesscode" minlength="6" maxlength="6" autocomplete="off" required inputmode="numeric" pattern="^[0-9]{1,6}$">
            <?php if (isset($params['errors']['accesscode'])): ?>
                <span class="input-error">*<?= $params['errors']['accesscode'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="image">Photo de profile</label>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="">Role</label>
                <select name="role">
                    <?php foreach ($params['roles'] as $role): ?>
                        <option value="<?= $role->getName() ?>" <?= isset($params["user"]) && $role->getID() ==
                        $params["user"]->getRole()
                            ->getID()? 'selected="selected"' : ''
                        ?>><?= $role->getName() ?></option>
                    <?php endforeach; ?>
                </select>
        </div>
        <div class="form-group">
            <label for="">Statut</label>
                <select name="status">
                    <option value="0" <?= isset($params["user"]) && $params["user"]->getActive() == 0 ? 'selected="selected"' : ''
                    ?>>NON ACTIF</option>
                    <option value="1" <?= isset($params["user"]) && $params["user"]->getActive() == 1 ? 'selected="selected"' : ''
                    ?>>ACTIF</option>
                </select>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/users'">Annuler</button>
</div>