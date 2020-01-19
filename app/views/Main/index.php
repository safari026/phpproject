
<div class="container">
<?php if(!empty($users)):?>
<?php foreach($users as $user):?>
<div class="panel panel-default">
  <div class="panel-heading"><?=$user['login']?></div>
  <div class="panel-body">
  <?=$user['email']?>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
</div>
