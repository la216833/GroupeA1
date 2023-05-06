<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title">35</h2>
            <p class="stat-desc">Nombre d'article total</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title">29</h2>
            <p class="stat-desc">Articles en vente</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title">4</h2>
            <p class="stat-desc">Articles en rupture de stock</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title">1</h2>
            <p class="stat-desc">Articles non mis en vente</p>
        </div>
    </div>
    <a href="/product" class="btn btn-dark btn-page">+ Ajouter un nouvel article</a>
    <form method="post">
        <select class="form-select" name="category">
            <option value="all">Toute les categories</option>
        </select>
    </form>

    <div class="list">
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th class="table-right">Statut</th>
                <th class="table-right">Quantité</th>
                <th class="table-right">Prix</th>
                <th class="table-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="hide">1</td>
                <td class="list-large">Mug</td>
                <td class="table-right status status-success">Actif</td>
                <td class="table-right">19</td>
                <td class="table-right">1,90</td>
                <td class="table-right">
                    <a class="btn btn-action btn-info" href="/product/:id">Modifier</a>
                    <a class="btn btn-action btn-red" href="/product-del/:id">Supprimer</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>