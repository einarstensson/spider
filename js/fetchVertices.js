function fetchVertices(){
  $.ajax({
    url: "services/crawler.php",
    method: "GET",
    datatype: "json",
    success: function(response){
      $('.results-list').html("");
      var results = JSON.parse(response);
      appendVertices(results);
    }
  })
}
