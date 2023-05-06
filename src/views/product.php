<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title">Ajouter une acticle</h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="">Nom</label>
            <input type="text">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <input type="text">
        </div>
        <div class="form-group">
            <label for="">Prix de vente</label>
            <input type="number">
        </div>
        <div class="form-group">
            <label for="">Prix de d'achat</label>
            <input type="number">
        </div>
        <div class="form-group">
            <label for="">Catégorie</label>
            <select name="category">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Statut</label>
            <select name="status">
                <option value="">Actif</option>
                <option value="">Repture de stock</option>
                <option value="">Non actif</option>
            </select>
        </div>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark">Annuler</button>
</div>