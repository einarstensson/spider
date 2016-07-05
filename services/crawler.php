<?php
  include '../models/vertice.php';
  include './scraper.php';

  $root_url = "http://wiprodigital.com";
  $stack = array();
  $history = array();
  $vertices = array();

  $scraper = new Scraper( $root_url );

  $current_vertice = new Vertice( "/" );
  $current_vertice->find_neighbors($scraper);
  $stack[] = $current_vertice;

  $search = true;
  while($search){
    $history[] = $current_vertice->name;
    $vertices[] = $current_vertice;

    $stack = update_stack($current_vertice->internal_neighbors, $stack, $history);
    array_shift($stack);

    if(count($stack) == 0){
      $search = false;
    }else{

      $current_vertice = $stack[0];
      if($current_vertice->visited == false){
        $current_vertice->find_neighbors($scraper);
        $current_vertice->visited = true;
      }
    }
  }

  echo json_encode($vertices);

  function update_stack($new_neighbors, $stack, $history){
    if($new_neighbors == NULL){
      return $stack;
    }

    foreach($new_neighbors as $neighbor){
      if(in_array($neighbor->name, $history) == false){
        if(in_array($neighbor, $stack) == false){
          $stack[] = $neighbor;
        }
      }
    }

    return $stack;
  }
?>
