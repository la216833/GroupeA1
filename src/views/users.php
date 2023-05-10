<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title"><?= count($params['categories'])?></h2>
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
    <a href="/product" class="btn btn-dark btn-page">+ Ajouter un nouvel utilisateur</a>

    <form method="post">
        <select class="form-select" name="role">
            <option value="all">Tous les roles</option>
            <?php foreach ($params['roles'] as $role): ?>
                <option value="<?= $role->getID()?>"><?= $role->getName(); ?></option>
            <?php endforeach; ?>
        </select>
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
                <td class="list-large"><?= $user->getName()?></td>
                <td class="table-right status <?= $user->getActive() ? 'status-success': 'status-danger'?>">
                    <?= $user->getActive() ? 'actif': 'Inactif'?>
                <td class="table-right"><?= $user->getRole()?></td>
                <td class="table-right">
                    <a class="btn btn-action btn-info" href="/product/<?= $user->getID()?>">Modifier</a>
                    <a class="btn btn-action btn-red" href="/product/<?= $user->getID()?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>