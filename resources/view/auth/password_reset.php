<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" value="<?= makeCsrf() ?>">
    <title><?= $this->title ?? 'Password reset' ?></title>
</head>
<body>
    <h1>Password reset</h1>
    <form action="<?= router('password_reset') ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= getCsrf() ?>">

        <p>
            <input type="email" name="user_email" placeholder="Емайл" value="<?= input('user_email') ?>">
            <p><?= session('user_email_error') ?></p>
        </p>
        <p><?= session('db_error') ?></p>
        <input type="submit" value="Register">
    </form>
</body>
</html>