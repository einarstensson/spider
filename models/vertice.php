<?php
  class Vertice {
      public $name = '';
      public $visited = false;
      public $neighbors = array();

      public function __construct( $name ) {
          $this->name = $name;
      }

      public function find_neighbors($scraper){
        $scraper->fetch_links($this->name);

        $fetched_links = $scraper->links;
        $this->populate_neighbors($fetched_links);
      }

      private function populate_neighbors($fetched_links){
        foreach($fetched_links as $link){
          if($link && $link != $this->name){
            $neighbor = new Vertice( $link );
            $this->neighbors[] = $neighbor;
          }
        }
      }
  }
?>
