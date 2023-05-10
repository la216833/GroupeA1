<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title">35</h2>
            <p class="stat-desc">Nombre de catégories</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title">29</h2>
            <p class="stat-desc">Catégories actives</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title">4</h2>
            <p class="stat-desc">Catégories vides</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title">1</h2>
            <p class="stat-desc">Catégories inactives</p>
        </div>
    </div>
    <a href="/product" class="btn btn-dark btn-page">+ Ajouter une nouvelle catégorie</a>

    <div class="list">
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th class="table-right">Statut</th>
                <th class="table-right">Nombre d'articles</th>
                <th class="table-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="hide">1</td>
                <td class="list-large">Boissons</td>
                <td class="table-right status status-success">Actif</td>
                <td class="table-right">2</td>
                <td class="table-right">
                    <a class="btn btn-action btn-info" href="/category/:id">Modifier</a>
                    <a class="btn btn-action btn-red" href="/category-del/:id">Supprimer</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>