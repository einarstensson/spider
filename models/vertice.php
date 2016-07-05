<?php
  class Vertice {
      public $name = '';
      public $visited = false;
      public $internal_neighbors = array();
      public $external_neighbors = array();
      public $image_links = array();

      public function __construct( $name ) {
          $this->name = $name;
      }

      public function find_neighbors($scraper){
        $scraper->fetch_links($this->name);

        $fetched_internal_links = $scraper->internal_links;
        $fetched_external_links = $scraper->external_links;
        $fetched_image_links = $scraper->image_links;

        $this->internal_neighbors = $this->populate_neighbors($fetched_internal_links);
        $this->external_neighbors = $this->populate_neighbors($fetched_external_links);
        $this->image_links = $this->populate_neighbors($fetched_image_links);
      }

      private function populate_neighbors($fetched_links){
        $neighbors = array();

        foreach($fetched_links as $link){
          if($link && $link != $this->name){
            $neighbor = new Vertice( $link );
            $neighbors[] = $neighbor;
          }
        }

        return $neighbors;
      }
  }
?>
