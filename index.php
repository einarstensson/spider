<?php
  include 'models/vertice.php';
  include 'services/scraper.php';

  $root_url = "http://wiprodigital.com/";
  $stack = array();
  $history = array();

  $scraper = new Scraper($root_url);

  $current_vertice = new Vertice( "/" );
  $current_vertice->find_neighbors($scraper);
  $stack[] = $current_vertice;

  $search = true;
  while($search){
    $history[] = $current_vertice->name;
    echo "<br>--------------<br>";
    echo $current_vertice->name;
    echo "<br>";
    $stack = update_stack($current_vertice->neighbors, $stack, $history);
    array_shift($stack);

    if(count($stack) == 0){
      $search = false;
      echo "Done!";
    }else{

      $current_vertice = $stack[0];
      $current_vertice->find_neighbors($scraper);
    }
  }

  function update_stack($new_neighbors, $stack, $history){
    if($new_neighbors == NULL){
      return $stack;
    }

    foreach($new_neighbors as $neighbor){
      if(!in_array($neighbor->name, $history)){
        echo "Neighbor:";
        echo $neighbor->name;
        echo "<br>";
        echo "History:<br>";
        foreach($history as $name){
          echo $name;
          echo "<br>";
        }

        $stack[] = $neighbor;
      }
    }

    return $stack;
  }
?>
