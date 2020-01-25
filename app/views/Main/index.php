<div class="container">
  <div class="jumbotron mt-3">
    <h1>Добро пожаловать на мой сайт.</h1>
    <p class="lead">Это тестовый сайт для финального проекта по учебе.</p>
    <p>Подробнее в разделе <a href="main/about" class="text-primary">о нас</a>.</p>
    <?php if (!isset($_SESSION['user'])) {;?>
      <a class="btn btn-lg btn-primary" href="/user/login" role="button">Вход</a>
      <a class="btn btn-lg btn-primary" href="/user/register" role="button">Регистрация</a>
    <?php };?>
    <?php if (isset($_SESSION['user'])) {;?>
      <h3>
        Здравствуйте, вы вошли как
        <small class="text-muted"><?php echo $_SESSION['user']->email ;?></small>
        .
      </h3>
    <?php };?>
  </div>
</div>