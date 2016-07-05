var getInternalNeighbors = function(vertice, limit){
  internalNeighbors = "";

  vertice["internal_neighbors"].forEach(function(internalNeighbor){
    internalNeighbors += internalNeighbor["name"] + "<br>";
  })

  return internalNeighbors;
}

var getExternalNeighbors = function(vertice){
  externalNeighbors = "";

  vertice["external_neighbors"].forEach(function(externalNeighbor){
    externalNeighbors += externalNeighbor["name"] + "<br>";
  })

  return externalNeighbors;
}

var getImages = function(vertice){
  imageLinks = "";

  vertice["image_links"].forEach(function(imageLink){
    imageLinks += imageLink["name"] + "<br>";
  })

  return imageLinks;
}
