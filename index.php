<html>
  <head>
  <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/application.css">
  </head>
  <body>
    <div class="results-list">
      <?php
        include 'models/vertice.php';
        include 'services/scraper.php';

        echo "<div class='row'>";
          echo "<div class='col-md-12'>";
            echo "<h1>Welcome to the Site Map Spider</h1>";
          echo "</div>";
        echo "</div>";

        $root_url = "http://wiprodigital.com";
        $stack = array();
        $history = array();

        $scraper = new Scraper( $root_url );

        $current_vertice = new Vertice( "/" );
        $current_vertice->find_neighbors($scraper);
        $stack[] = $current_vertice;

        $search = true;
        while($search){

          echo "<div class='row'>";
            echo "<h2>" . $current_vertice->name . "</h2>";
            echo "<div class='col-md-3'>";
              echo "<h2>Internal Neighbors</h2>";
              foreach($current_vertice->internal_neighbors as $neighbor){
                echo $neighbor->name;
                echo "<br>";
              }
            echo "</div>";
            echo "<div class='col-md-3'>";
              echo "<h2>External Neighbors</h2>";
              foreach($current_vertice->external_neighbors as $neighbor){
                echo $neighbor->name;
                echo "<br>";
              }
            echo "</div>";
            echo "<div class='col-md-3'>";
              echo "<h2>Images</h2>";
              foreach($current_vertice->image_links as $image){
                echo $image->name;
                echo "<br>";
              }
            echo "</div>";
            echo "<div class='col-md-3'>";
              echo "<h2>New Neighbors:</h3>";
              foreach($current_vertice->internal_neighbors as $neighbor){
                if(in_array($neighbor->name, $history) == false){
                  if(in_array($neighbor, $stack) == false){
                    echo $neighbor->name;
                    echo "<br>";
                  }
                }
              }
            echo "</div>";
          echo "</div>";


          $history[] = $current_vertice->name;

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
    </div>
  </body>
</html>
