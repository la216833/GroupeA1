<div class="container center">
    <img src="https://armetiss.be/img/logo-active.png" alt="" class="add-img">
    <h2 class="title"><?= empty($params) ? "Gestion du stock":"" ?></h2>
    <form method="post" class="form">
        <div class="form-group">
            <label for="">Article</label>
            <select name="name">
                <?php foreach ($params["products"] as $product)?>
                    <option value="$index"><?= $product ?> </option>
                }
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantite</label>
            <input name="quantity" type="number">
        </div>
        <div class="form-group">
            <label for="">Date</label>
            <input name="date" type="date">
        </div>
        <div class="form-group">
            <label for="">Prix d'achat</label>
            <input name="buyPrice" type="number">
        </div>
        <div class="form-group">
            <label for="">Mettre ce stock par defaut?</label>
            <select name="actif">
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        <br>
        <input type="submit" value="Valider" class="btn btn-dark btn-md">
    </form>
    <button class="btn btn-md btn-dark" onclick="location.href='/stocks'">Annuler</button>
</div>