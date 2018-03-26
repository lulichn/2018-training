<?php

require_once 'infrastructure//PostDataBaseRepository.php';
require_once 'services/PostService.php';

/**
  * /api/posts
  */
class Posts {
    /**
      * Method: GET
      */
    public function get() {
        $repo = new models\PostDataBaseRepository();
        $service = new services\PostService($repo);

        $posts = $service->getPosts();

        $toArray = function($post) {
            return $post->toArray();
        };

        $arrayValues = array_map($toArray, $posts);
    
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($arrayValues);
  }
}

?>
