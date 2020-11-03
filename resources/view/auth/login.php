<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" value="<?= makeCsrf() ?>">
    <title><?= $this->title ?? 'Registration' ?></title>
</head>
<body>
    <h1>Sign up</h1>
    <form action="<?= router('login') ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= getCsrf() ?>">

        <div>
            Name: <input type="text" name="user_name">
        </div>

        <div>
            Email: <input type="email" name="user_email">
        </div>

        <div>
            Password: <input type="password" name="user_password">
        </div>

        <div>
            Repeat password: <input type="password" name="user_password_repeat">
        </div>

        <input type="submit" value="Register">
    </form>
</body>
</html>