<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome</h1>

    <form action="/register" method="post">
        <input type="text" name="name">
        <input type="hidden" name="csrf_token" value="<?= session('csrf_token') ?>" id="">
        <input type="submit" value="submit">
    </form>
</body>
</html>