<?php
  include '../libraries/simple_html_dom.php';
  include '../libraries/robots_parser.php';

  ini_set('user_agent', 'NameOfAgent (Einar)');

  class Scraper {
    public $root = '';
    public $internal_links = array();
    public $external_links = array();
    public $image_links = array();
    private $html = '';

    public function __construct( $root_url ) {
      $this->root = $root_url;
    }

    private function parse_html($url){
      if(robots_allowed($url, "NameOfAgent")) {
        $result = @file_get_html($url);
        return $result;
      }
    }

    public function fetch_links($path){
      if(substr($path,0,23) == "http://wiprodigital.com"){
        $url = $path;
      }else{
        $url = $this->root . $path;
      }

      $this->html = $this->parse_html($url);

      $this->populate_internal_links();
      $this->populate_external_links();
      $this->populate_image_links();
    }

    private function populate_internal_links(){
      if($this->html != ""){
        foreach($this->html->find('a') as $element){
          if($this->is_internal_link($element->href)){
            $this->internal_links[] = $element->href;
          }
        }
      }

      $this->internal_links = array_unique($this->internal_links);
    }

    private function populate_external_links(){
      if($this->html != ""){
        foreach($this->html->find('a') as $element){
          if($this->is_internal_link($element->href) == false){
            $this->external_links[] = $element->href;
          }
        }
      }

      $this->external_links = array_unique($this->external_links);
    }

    private function populate_image_links(){
      if($this->html != ""){
        foreach($this->html->find('img') as $element){
          $this->image_links[] = $element->src;
        }
      }

      $this->image_links = array_unique($this->image_links);
    }

    private function is_internal_link($link){
      // Use || substr($link, 0,23) == "http://wiprodigital.com" to deal
      // with hard coded links. This currently breaks the code however
      // because some of the links are broken (404).
      if($link[0] == "/" ){
        return true;
      }else{
        return false;
      }
    }
  }
?>
