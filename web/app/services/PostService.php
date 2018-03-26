<?php

namespace services;

require_once 'models/PostRepository.php';

class PostService {
    private $postRepository;

    public function __construct(
        \models\PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPost($id) {
        $this->postRepository->incrementViewCount($id);
        $post = $this->postRepository->findById($id);
        return $post;
    }

    public function getPosts() {
        $posts = $this->postRepository->findAll();
        return $posts;
    }
}

?>

