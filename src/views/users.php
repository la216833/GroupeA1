<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title">35</h2>
            <p class="stat-desc">Nombre d'utilisateurs</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title">29</h2>
            <p class="stat-desc">Nombre de vendeurs</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title">4</h2>
            <p class="stat-desc">Nombre de responsables</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title">1</h2>
            <p class="stat-desc">Nombre d'administrateurs</p>
        </div>
    </div>
    <a href="/product" class="btn btn-dark btn-page">+ Ajouter un nouvel utilisateur</a>

    <form method="post">
        <select class="form-select" name="role">
            <option value="all">Tous les roles</option>
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
            <tr>
                <td class="hide">1</td>
                <td class="list-large">JKaouass</td>
                <td class="table-right status status-success">Actif</td>
                <td class="table-right">Administrateur</td>
                <td class="table-right">
                    <a class="btn btn-action btn-info" href="/user/:id">Modifier</a>
                    <a class="btn btn-action btn-red" href="/user-del/:id">Supprimer</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>