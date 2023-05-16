<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params) ? 'Ajouter un utilisateur' : 'Modifier l\'utilisateur' ?></h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="">Nom</label>
            <input type="text" name="name" value="<?= empty($params) ?'': $params['user']->getName() ?>">
        </div>
        <div class="form-group">
            <label for="">Prénom</label>
            <input type="text" value="<?= empty($params) ?'': $params['user']->getFirstName() ?>">
        </div>
        <div class="form-group">
            <label for="">Code d'accès</label>
            <input type="password" minlength="6" maxlength="6" autocomplete="off" required inputmode="numeric" pattern="^[0-9]{1,6}$">
        </div>
        <div class="form-group">
            <label for="">Photo de profile</label>
            <input type="file">
        </div>
        <div class="form-group">
            <label for="">Role</label>
            <select name="role">
                <option value="0">Vendeur</option>
                <option value="1">Responsable</option>
                <option value="2">Administrateur</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Statut</label>
            <select name="status">
                <option value="1">ACTIF</option>
                <option value="0">NON ACTIF</option>
            </select>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/users'">Annuler</button>

</div>