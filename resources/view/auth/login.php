<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" value="<?= makeCsrf() ?>">
    <title><?= $this->title ?? 'Login' ?></title>
</head>
<body>
    <h1>Login</h1>
    <form action="<?= router('login') ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= getCsrf() ?>">

        <p>
            <input type="email" name="user_email" placeholder="Емайл" value="<?= session('input.user_email') ?>">
            <p><?= session('errors.user_email_error') ?></p>
        </p>
        <p>
            <input type="password" name="user_password" placeholder="Пароль" value="<?= session('input.user_password') ?>">
            <p><?= session('errors.user_password_error') ?></p>
        </p>
        <p><?= session('errors.db_error') ?></p>
        <input type="submit" value="Register">
    </form>
</body>
</html>