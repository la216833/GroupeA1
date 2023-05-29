<?php if (isset($params['errors'])): ?>

<div class="alert-error">
    <?= $params['errors']; ?>
</div>

<?php endif; ?>


<div class="container center">
    <h1 style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase; margin: 20px 0 50px">Welcome to
        installation</h1>
    <p style="font-size: 1.5rem; margin-bottom: 20px">Please fill the required fields</p>

    <form action="" method="post">
        <div class="form-group">
            <label for="hostname">Database hostname / IP
                <input type="text" name="hostname" placeholder="127.0.0.1"
                    <?= isset($params['data']['hostname']) ? 'value="'.$params['data']['hostname'].'"' : '' ?>
                >
            </label>
        </div>
        <div class="form-group">
            <label for="name">Database name
                <input type="text" name="database" placeholder="myapp"
                    <?= isset($params['data']['database']) ? 'value="'.$params['data']['database'].'"' : '' ?>
                >
            </label>
        </div>
        <div class="form-group">
            <label for="username">Database username
                <input type="text" name="username" placeholder="root"
                    <?= isset($params['data']['username']) ? 'value="'.$params['data']['username'].'"' : '' ?>
                >
            </label>
        </div>
        <div class="form-group">
            <label for="password">Database password
                <input type="password" name="password" placeholder="root">
            </label>
        </div>
        <div class="form-group">
            <label for="initDB" class="switch">Initiate database
                    <input type="checkbox" id="initDB" name="init_db">
                    <span></span>
            </label>
            <span style="color: #E14545; font-size: .75rem; font-style: italic"> (caution: this will remove
                everything)</span>
        </div>
        <br> <br> <br>
        <div class="form-group">
            <label for="password">Administrator password
                <input type="password" name="admin_password" minlength="6" maxlength="6" autocomplete="off"
                       inputmode="numeric" pattern="^[0-9]{1,6}$" required>
            </label>
        </div>
        <div class="form-group">
            <label for="password">Confirm administrator password
                <input type="password" name="admin_confirm" minlength="6" maxlength="6" autocomplete="off"
                       inputmode="numeric" pattern="^[0-9]{1,6}$" required>
            </label>
        </div>
        <br> <br> <br>
        <button class="btn btn-lg btn-dark">Install</button>
    </form>
</div>