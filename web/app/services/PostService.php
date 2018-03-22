<?php

namespace services;

class PostService {
    private $postRepository;

    public function __construct(
        $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPost($id) {
        $post = $this->postRepository->findById($id);
        return $post;
    }

    public function getPosts() {
        $posts = $this->postRepository->findAll();
        return $posts;
    }
}

?>
