<?php

  class Pages extends Controller {
    public function __construct() {
      //echo "Pages Loaded";
      $this->postModel = $this->model("Post");
    }

    public function index() {
      $posts = $this->postModel->getPosts();

      $data = [
        "title" => "Welcome",
        "posts" => $posts
      ];

      $this->view("pages/index", $data);
    }

    public function about($a=null) {
      $data = ["title" => "About"];
      $this->view("pages/about", $data);
      echo $a;
    }
  }

?>
