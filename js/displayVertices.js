function displayInternalVertices(vertice){
  var showMoreButton = "<br><button onclick='showAll('"+vertice["name"]+"','internal-neighbors')'>Show All</button>";
  return getInternalNeighbors(vertice, 3) + showMoreButton;
}
