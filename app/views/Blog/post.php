<div class="card mt-3">
  <div class="card-body">
    <h5 class="card-title"><?php echo $post->post_title ;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Автор <?php echo $post->email ;?></h6>
    <p class="card-text"><?php echo $post->post_body ;?></p>
    <p class="mt-2 mb-2">Создан <?php echo $post->created_at ;?></p>
    <div class="card-footer">
        <a href="#" class="card-link">Назад</a>
    </div>

  </div>
</div>