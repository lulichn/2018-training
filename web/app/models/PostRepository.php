<?php

namespace models;

interface PostRepository {
    public function findById($id);
    public function findAll();
    public function incrementViewCount($id);
}

?>

