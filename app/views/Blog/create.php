<h1>Создать пост</h1>
<form method="POST" action="/blog/create">
  <div class="form-group">
    <label for="exampleInputEmail1">Название</label>
    <input
      name="post_title"
      type="text"
      class="form-control"
      id="exampleInputEmail1"
      value="<?php if(isset($data['post_title'])) echo $data['post_title'] ;?>"
      novalidate>
    <p class="text-danger"><?php if(isset($data['titleError'])) echo $data['titleError'];?></p>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Текст поста</label>
    <textarea name='post_body' class="form-control" id="exampleFormControlTextarea1" value="<?php if(isset($data['post_body'])) echo $data['post_body'] ;?>" rows="3"></textarea>
  </div>
  <p class="text-danger"><?php if(isset($data['bodyError'])) echo $data['bodyError'];?></p>


  <button type="submit" class="btn btn-primary">Создать</button>
</form>