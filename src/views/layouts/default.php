<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Register</title>
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js" defer></script>
</head>
<body>
<button class="sidebar-btn" id="sidebarBtn"> > </button>

<div class="sidebar" id="sidebar">
    <div class="sidebar-container">
        <img src="https://armetiss.be/img/logo-active.png" class="sidebar-img">
        <div class="sidebar-content">
            <a class="btn btn-md btn-light" href="/categories">Categories</a>
            <a class="btn btn-md btn-light" href="/products">Articles</a>
            <a class="btn btn-md btn-light" href="/users">Utilisateurs</a>
            <a class="btn btn-md btn-light" href="/selles">Historique</a>
            <a class="btn btn-md btn-light">Retour a la vente</a>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-profile-pic">
                <img src="https://armetiss.be/img/logo-active.png" alt="Photo de profile">
            </div>
            <div class="sidebar-name">
                <h3>Username</h3>
            </div>
            <button class="btn btn-lg btn-red">Déconnexion</button>
        </div>
    </div>
</div>
</body>
</html>