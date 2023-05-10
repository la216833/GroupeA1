<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title">Ajouter un utilisateur</h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="">Nom</label>
            <input type="text">
        </div>
        <div class="form-group">
            <label for="">Prénom</label>
            <input type="text">
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
    <button class="btn btn-md btn-dark">Annuler</input>
</div>