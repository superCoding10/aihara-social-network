<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf_token" value="<?= makeCsrf() ?>">
  <script src="https://www.google.com/recaptcha/api.js?render=6LcYq94ZAAAAAAHeZsT3Edk-slVN-OWTCF9gzYM6"></script>
  <script>
   function onSubmit(token) {
     document.getElementById("form").submit();
   }
 </script>
  <title>Document</title>
</head>
<body>
  <h1>Register</h1>
  <form action="<?= router('register') ?>" method="POST" id="form">
    <input type="hidden" name="csrf_token" value="<?= getCsrf() ?>">
    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-input">

    <p>
      <input type="text" name="user_name" placeholder="Имя" value="<?= session('input.user_name') ?>">
      <p><?= session('errors.user_name') ?></p>
    </p>
    <p>
      <input type="email" name="user_email" placeholder="Емайл" value="<?= session('input.user_email') ?>">
      <p><?= session('errors.user_email') ?></p>
    </p>
    <p>
      <input type="password" name="user_password" placeholder="Пароль">
      <p><?= session('errors.user_password') ?></p>
    </p>
    <p>
      <input type="password" name="user_password_repeat" placeholder="Повторите пароль">
      <p><?= session('errors.user_password_repeat') ?></p>
    </p>

    <p><?= session('errors.db') ?></p>
    <button class="g-recaptcha" 
      data-sitekey="6LcYq94ZAAAAAAHeZsT3Edk-slVN-OWTCF9gzYM6" 
      data-callback='onSubmit' 
      data-action='submit'>Submit</button>
  </form>

  
  <script>
        grecaptcha.ready(function() {
          grecaptcha.execute('6LcYq94ZAAAAAAHeZsT3Edk-slVN-OWTCF9gzYM6', {action: 'submit'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token
          });
        });
  </script>
</body>
</html>