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
    <button class="sidebar-btn" id="sidebarBtn"> > </button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-container">
            <img src="https://armetiss.be/img/logo-active.png" class="sidebar-img">
            <div class="sidebar-content">
                <a class="btn btn-md btn-light" href="/categories">Categories</a>
                <a class="btn btn-md btn-light" href="/products">Articles</a>
                <a class="btn btn-md btn-light" href="/users">Utilisateurs</a>
                <a class="btn btn-md btn-light" href="/history">Historique</a>
                <a class="btn btn-md btn-light" href="/">Retour a la vente</a>
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

    {{content}}

</body>
</html>