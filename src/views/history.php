<div class="container">
    <div class="stats">
        <div class="stat stat-info">
            <h2 class="stat-title">1527€</h2>
            <p class="stat-desc">Valeur du stock</p>
        </div>
        <div class="stat stat-success">
            <h2 class="stat-title">1512€</h2>
            <p class="stat-desc">Benefice total</p>
        </div>
        <div class="stat stat-warning">
            <h2 class="stat-title">213</h2>
            <p class="stat-desc">Articles vendus</p>
        </div>
        <div class="stat stat-danger">
            <h2 class="stat-title">760</h2>
            <p class="stat-desc">Articles en stock</p>
        </div>
    </div>
    <div class="history-form">
        <div>
            <label for="begin-date">Date de debut: </label>
            <input type="date" name="begin-date" id="begin-date">
        </div>
        <div>
            <label for="end-date">Date de fin: </label>
            <input type="date" name="end-date" id="end-date">
        </div>
        <div>
            <label for="history-filter">Filtré par: </label>
            <select name="history-filter" id="history-filter">
                <option value="by-category">Categorie</option>
                <option value="by-product">Article</option>
            </select>
        </div>
        <input type="submit" value="Generer" class="btn btn-red">
    </div>
    <div class="chart-container">
        <canvas id="barCanvas" role="img"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        <script src="/scripts/chartScript.js"></script>
    </div>
</div>