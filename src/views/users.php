<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title"><?= count($params['users'])?></h2>
            <p class="stat-desc">Nombre d'utilisateurs</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title"><?= $params['users_seller'] ?></h2>
            <p class="stat-desc">Nombre de vendeurs</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title"><?= $params['users_manager'] ?></h2>
            <p class="stat-desc">Nombre de responsables</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title"><?= $params['users_admin'] ?></h2>
            <p class="stat-desc">Nombre d'administrateurs</p>
        </div>
    </div>
    <a href="/user" class="btn btn-dark btn-page">+ Ajouter un nouvel utilisateur</a>

    <form>
        <label>
            <select class="form-select" name="role" id="userChoice">
                <option value="0">Tous les roles</option>
                <?php foreach ($params['roles'] as $role): ?>
                    <option value="<?= $role->getID()?>"><?= $role->getName(); ?></option>
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
                <th class="table-right">Role</th>
                <th class="table-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['users'] as $user): ?>
            <tr>
                <td class="hide"><?= $user->getID()?></td>
                <td class="hide"><?= $user->getRole()->getID()?></td>
                <td class="list-large"><?= $user->getName()?></td>
                <td class="table-right status <?= $user->getStatus() ? 'status-success': 'status-danger'?>">
                    <?= $user->getStatus() ? 'ACTIF': 'INACTIF'?>
                <td class="table-right"><?= strtoupper($user->getRole()->getName()) ?></td>
                <td class="table-right">
                    <a class="btn btn-action btn-info" href="/user/<?= $user->getID()?>">Modifier</a>
                    <a class="btn btn-action btn-red" href="/user/<?= $user->getID()?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>