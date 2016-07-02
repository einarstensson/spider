<?php
  include 'models/vertice.php';
  include 'services/scraper.php';

  $root_url = "http://dn.se";

  $vertice = new Vertice( "/" );
  $scraper = new Scraper($root_url);

  $vertice->find_neighbors($scraper);
?>
