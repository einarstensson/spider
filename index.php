<?php
  include 'models/vertice.php';
  include 'services/scraper.php';

  echo "<h1>Welcome to the Site Map Spider</h1>";

  $root_url = "http://wiprodigital.com";
  $stack = array();
  $history = array();

  $scraper = new Scraper( $root_url );

  $current_vertice = new Vertice( "/" );
  $current_vertice->find_neighbors($scraper);
  $stack[] = $current_vertice;

  $search = true;
  while($search){
    $history[] = $current_vertice->name;
    echo "-----------------------------<br>";
    echo "<h2>" . $current_vertice->name . "</h2>";

    $stack = update_stack($current_vertice->neighbors, $stack, $history);

    array_shift($stack);

    if(count($stack) == 0){
      $search = false;
      echo "---------------------------<br>";
      echo "History:<br>";
      foreach($history as $name){
        echo $name;
        echo "<br>";
      }

      echo "Done!";
    }else{

      $current_vertice = $stack[0];
      if($current_vertice->visited == false){
        $current_vertice->find_neighbors($scraper);
        $current_vertice->visited = true;
      }
    }
  }

  function update_stack($new_neighbors, $stack, $history){
    if($new_neighbors == NULL){
      return $stack;
    }
    echo "<br>";
    echo "<h3>History:</h3>";
    foreach($history as $name){
      echo $name;
      echo "</br>";
    }

    echo "<br>";
    echo "<h3>New Neighbors:</h3>";
    foreach($new_neighbors as $neighbor){
      if(in_array($neighbor->name, $history) == false){
        if(in_array($neighbor, $stack) == false){
          echo $neighbor->name;
          echo "<br>";
          $stack[] = $neighbor;
        }
      }
    }

    return $stack;
  }
?>
