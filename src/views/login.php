<?php if (isset($params['errors'])): ?>

    <div class="alert-error">
        <?= $params['errors']; ?>
    </div>

<?php endif; ?>
<div class="container center">
    <div class="table-img">
        <img src="https://armetiss.be/img/logo-active.png" alt="" width="500px">
    </div>
    <div>
        <form class="login-form-container" method="post" action="">
            <input name="password" class="login-input" type="password" minlength="6" maxlength="6" autocomplete="off" required inputmode="numeric" pattern="^[0-9]{1,6}$" autofocus>
            <button class="btn btn-lg btn-red login-btn" type="submit" style="margin-top: 20px;">Se connecter</button>
        </form>
    </div>
</div>



