<?php
global$session;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Register</title>
    <link rel="stylesheet" href="/styles/fonts.css">
    <link rel="stylesheet" href="/styles/reset.css">
    <link rel="stylesheet" href="/styles/styles.css">
    <script src="/scripts/scripts.js" defer></script>
</head>
<body>
<?php if (!empty($session) && $session->get('USER')): ?>
    <button class="sidebar-btn" id="sidebarBtn"> > </button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-container">
            <img src="https://armetiss.be/img/logo-active.png" class="sidebar-img">
            <div class="sidebar-content">
                <?php if ($session->get('ROLE') === 'administrator'): ?>
                <a class="btn btn-md btn-light" href="/categories">Categories</a>
                <a class="btn btn-md btn-light" href="/products">Produits</a>
                <a class="btn btn-md btn-light" href="/stocks">Stocks</a>
                <a class="btn btn-md btn-light" href="/users">Utilisateurs</a>
                <?php endif; ?>
                <a class="btn btn-md btn-light" href="/history">Historique</a>
                <a class="btn btn-md btn-light" href="/">Retour a la vente</a>
            </div>
            <div class="sidebar-footer">
                <div class="sidebar-profile-pic">
                    <img src="images/<?= $session->get('IMG_PATH')?>" alt="Photo de profile">
                </div>
                <div class="sidebar-name">
                    <h3><?= $session->get('USERNAME')?></h3>
                </div>
                <button class="btn btn-lg btn-red" onclick="location.href='logout/1'">Déconnexion</button>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($session) && $session->getFlash('error')) : ?>
<div class="alert-error">
    <h1>Erreur</h1>
    <p><?= $session->getFlash('error')?></p>
</div>
<?php endif; ?>

<?php if (!empty($session) && $session->getFlash('success')) : ?>
    <div class="alert-success">
        <h1>Réussi</h1>
        <p><?= $session->getFlash('success')?></p>
    </div>
<?php endif; ?>

{{content}}

</body>
</html>

<?php if (!empty($session)) $session->setFlash('error', '');?>
<?php if (!empty($session)) $session->setFlash('success', '');?>
