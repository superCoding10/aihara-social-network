<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" value="<?= makeCsrf() ?>">
    <title><?= $this->title ?? 'Password create' ?></title>
</head>
<body>
    <h1>Password create</h1>
    <form action="<?= router('password_create') ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= getCsrf() ?>">

        <p>
          <input type="password" name="user_password" placeholder="Пароль">
        <p><?= session('user_password_error') ?></p>
        <p>
          <input type="password" name="user_password_repeat" placeholder="Повторите пароль">
        <p><?= session('user_password_repeat_error') ?></p>
        </p>
        <p><?= session('db_error') ?></p>
        <input type="submit" value="Register">
    </form>
</body>
</html>