<?php
namespace app\controllers;
use vendor\libs\UserSession;
use app\models\BlogModel;
use vendor\libs\Validator;
class BlogController extends AppController
{
    public $layout = 'main';

    public function indexAction() {
        $model = new BlogModel;
        $posts = $model->getPosts();
        $this->set(['posts'=>$posts]);
    }

    public function createAction() {
        if(!UserSession::get('user')) {
            header('location: /user/login');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = ['post_title' => $_POST['post_title'], 'post_body' => $_POST['post_body']];
            $post['author_id'] = $_SESSION['user']->user_id;
            $post = Validator::validatePost($post);
            if (isset($post['titleError']) || isset($post['bodyError'])) {
                $this->set(['data' => $post]);
            }
            $model = new BlogModel;
            $model->savePost($post);
            UserSession::setMessage('success', 'Пост создан.');
            header('location: /blog');
            
        }
    }
    public function postAction() {
        $postId = $_GET['id'];
        $model = new BlogModel;
        $post = $model->findPost($postId);
        if (!$post) {
            UserSession::setMessage('alert', 'Пост не найден.');
            header('location: /blog');
        }
        $this->set(['post' => $post]);
    }
}