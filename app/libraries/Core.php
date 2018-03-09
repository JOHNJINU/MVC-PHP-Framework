<?php
 /*

  - App Core Class
  - Creates URL & loads core controller
  - URL Format - /Controller/method/params

 */

 class Core {
   protected $currentController = "Pages"; //default
   protected $currentMethod = "index"; //default
   protected $params = [];

   public function __construct() {
     //print_r($this->getUrl());
     $url = $this->getUrl();

     // look in controller for first value
     if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
       // if exists, set as controller
       $this->currentController = ucwords($url[0]);
       // unset 0 index
       unset($url[0]);
     }

     // require controller
     require_once "../app/controllers/" . $this->currentController . ".php";
     // instantiate controller class
     $this->currentController = new $this->currentController; // contains class

     // Check for method in url - second value
     if (isset($url[1])) {
       //check to see if method exist in controller file class
       if (method_exists($this->currentController, $url[1])) {
         $this->currentMethod = $url[1];
         // unset 1 index
         unset($url[1]);
       }
     }

     //get params
     $this->params = $url ? array_values($url) : [];

     // call a callback with array of params
     call_user_func_array([$this->currentController,
     $this->currentMethod], $this->params);
     // Calls instantiated $currentController Class with $currentMethod,
     // passes array of arguments in $params.
   }

   public function getUrl() {
     if (isset($_GET["url"])) {
       $url = rtrim($_GET["url"], "/"); // removes end slash/ on a url
       $url = filter_var($url, FILTER_SANITIZE_URL); // removes uknown characters
       $url = explode("/", $url); // creates array of items seperated by /slash/
       return $url;
     }
   }

 }

?>
