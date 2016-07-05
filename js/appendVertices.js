function appendVertices(results){
  results.forEach(function(vertice){
    $('.results-list').append(
      "<div class='row'>" +
        "<h2>" + vertice["name"] + "</h2>" +
        "<div class='col-md-4'>" +
          "<h2>Internal Neighbors</h2>" +
          getInternalNeighbors(vertice) +
        "</div>" +
        "<div class='col-md-4'>" +
          "<h2>External Neighbors</h2>" +
          getExternalNeighbors(vertice) +
        "</div>" +
        "<div class='col-md-4'>" +
          "<h2>Images</h2>" +
          getImages(vertice) +
        "</div>" +
      "</div>"
    );
  })
}
