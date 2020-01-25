<h2 class="text-primary">Вход</h2>
<?php if(isset($_SESSION['authError'])) {;?>
  <div class="laert-danger">
    <?php echo $_SESSION['authError'] ;?>
  </div>
<?php } ;?>
<form method="POST" action="/user/login">
  <div class="form-group">
    <label for="exampleInputEmail1">Имэйл адрес</label>
    <input
      name="email"
      type="text"
      class="form-control"
      id="exampleInputEmail1"
      value="<?php if(isset($data['email'])) echo $data['email'] ;?>"
      novalidate>
  </div>
  <p class="text-danger"><?php if(isset($data['error'])) echo $data['error'];?></p>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary">Login</button>
</form>