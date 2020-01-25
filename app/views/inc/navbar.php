<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <a class="navbar-brand" href="#">My Site</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Главная</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/blog">Блог</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/main/about">О нас</a>
      </li>
    </ul>
    <ul class="navbar-nav mr-right">
      <?php if (!isset($_SESSION['user'])) {;?>
      <li class="nav-item">
        <a class="nav-link" href="/user/login">Вход</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/user/register">Регистрация</a>
      </li>
      <?php };?>
      <?php if (isset($_SESSION['user'])) {;?>
        <li class="nav-item">
          <a href="/user/logout" class="nav-link">Выход</a>
        </li>
      <?php } ;?>
      </ul>

  </div>
</nav>