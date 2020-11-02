<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
</head>
<body>
    <h1>Page Not Found</h1>
        <form action="/register" method="post">
        <input type="text" name="name">
        <input type="hidden" name="csrf_token" value="<?= 12 ?>" id="">
        <input type="submit" value="submit">
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>