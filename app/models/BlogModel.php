<?php
namespace app\models;

use vendor\core\base\QueryBuilder;
class BlogModel extends QueryBuilder {

    public $table = 'posts';

    public function savePost($post) {
        $this->insert($this->table, $post);
    }
    public function getPosts() {
        $posts = $this->table($this->table)->select('post_id, post_title, created_at')->orderBy('created_at', 'DESC')->Qget();
        return $posts;
    }
    public function findPost($postId) {
        $post = $this->query('SELECT * FROM posts JOIN users on users.user_id = posts.author_id WHERE posts.post_id = ?', [(int)$postId], true);
        // debug($post);
        // die();
    //     $post = $this->table($this->table)->select('*')->where('post_id', '=', $postId)->Qget();
        if (!count($post)) {
            return false;
        }
       return $post[0];
    }
}