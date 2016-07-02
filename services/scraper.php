<?php
  include 'assets/simple_html_dom.php';

  class Scraper {
    public $root = '';
    public $links = array();
    private $html = '';

    public function __construct( $root_url ) {
        $this->root = $root_url;
    }

    private function parse_html($url){
      return file_get_html($url);
    }

    public function fetch_links($path){
      $url = $this->root . $path;
      $this->html = $this->parse_html($url);
      $this->populate_links();
    }

    private function populate_links(){
      foreach($this->html->find('a') as $element){
        if($this->is_internal($element->href)){
          $this->links[] = $element->href;
        }
      }

      $this->links = array_unique($this->links);
    }

    private function is_internal($link){
      if($link[0] == "/"){
        return true;
      }else{
        return false;
      }
    }

  }
?>
