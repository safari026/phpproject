
<h2 class="text-primary">Регистрация</h2>
<form method="POST" action="/user/register">
  <div class="form-group">
    <label for="exampleInputEmail1">Имэйл адрес</label>
    <input
      name="email"
      type="text"
      class="form-control"
      id="exampleInputEmail1"
      value="<?php if(isset($data['email'])) echo $data['email'] ;?>"
      novalidate>
    <p class="text-danger"><?php if(isset($data['emailError'])) echo $data['emailError'];?></p>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
    <p class="text-danger"><?php if(isset($data['pwdError'])) echo $data['pwdError'];?></p>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">Подтверждение пароля</label>
    <input name="confPassword" type="password" class="form-control" id="exampleInputPassword2">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>