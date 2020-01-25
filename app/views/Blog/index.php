<h1>Welcome to Blog</h1>
<?php if(isset($_SESSION['success'])) {;?>
    <div class="alert-success mt-3 mb-3">
        <h3><?php echo $_SESSION['success'] ;?></h3>
    </div>
<?php } unset($_SESSION['success']);?>
<?php if(isset($_SESSION['alert'])) {;?>
    <div class="alert-danger mt-3 mb-3">
        <h3><?php echo $_SESSION['alert'] ;?></h3>
    </div>
<?php } unset($_SESSION['alert']);?>
<?php if (isset($posts)) { ;?>
    <ul class="list-group">
        <?php foreach($posts as $post) {;?>
            <li class="list-group-item">
                <a href="/blog/post?id=<?php echo $post->post_id;?>"><?php echo $post->post_title;?></a>
                <p class="float-right">Создан: <b><?php echo $post->created_at ;?></b></p>
            </li>
        <?php };?>
    </ul>
<?php } else {;?>
    <p>Постов пока нет.</p>
<?php };?>
<a href="/blog/create" class="btn btn-primary mt-4">Создать пост</a>