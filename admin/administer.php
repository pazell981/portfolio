<!doctype html>
<html>
  <?php    
    session_start();
    include 'dbConnection.php';
    if(!isset($_SESSION['userid'])){
      header('location: 401.shtml');
      die();
    } else {
      $userid = $_SESSION['userid'];
      if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = "";
      }
      if (!isset($_SESSION['success'])) {
        $_SESSION['success'] = "";
      }
    }
  ?>
  <head>
    <meta charset="utf-8">

    <title>Paul's Launchpad - Administer</title>

    <meta name="description" content="Paul Zellmer's Portfolio">
    <meta name="author" content="Paul Zellmer">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="../lib/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/reveal.css">
    <link rel="stylesheet" href="../lib/css/theme/default.css" id="theme">
    <link rel="stylesheet" href="../lib/css/zenburn.css">
    <link rel="stylesheet" href="../lib/css/jquery-ui-1.9.2.custom.min.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">

    <script src="../lib/js/jquery-2.1.1.min.js" charset="utf-8"></script>
    <script src="../lib/js/jquery-ui.min.js" charset="utf-8"></script>
    <script src="../lib/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="../lib/js/transition.js" charset="utf-8"></script>
    <script src="../lib/js/tooltip.js" charset="utf-8"></script>
    <script src="../lib/js/popover.js" charset="utf-8"></script>
    <script src="../lib/js/d3.min.js" charset="utf-8"></script>
  </head>
  <body>
    <div class='row-fluid'>
      <div id = 'wrapper1' class='span-12'>
        <script charset="utf-8">
          var size = 3;
          var arrayC=[];
          for (var j=1; j<size; j++){
            arrayC[j]=[];
            for(i=0; i<500*j; i++){
              arrayC[j].push({
                "x_axis": parseInt(Math.random()*$("#wrapper1").width()),
                "y_axis": parseInt(Math.random()*$("#wrapper1").height()), 
                "radius": (size-j)
              });
            }
          }
          var container = d3.select("#wrapper1").append("svg").attr("width", "100%").attr("height", "100%").attr("xmlns", "http://www.w3.org/2000/svg").attr("id", "starry");

          for (var i=1; i<size; i++ ){
            var circles = 
            container.selectAll("circle")
            .data(arrayC[i]).enter()
            .append("circle")
            var circleAttributes = circles
            .attr("cx", function (d){return d.x_axis;})
            .attr("cy", function (d){return d.y_axis;})
            .attr("r", function (d){return d.radius;})
            .style("fill", function(){
              return "rgb("+parseInt(Math.random()*125)+","+parseInt(Math.random()*125)+","+parseInt(Math.random()*125)+")";
            });
          };
          var container2 = d3.select("#starry").append("svg").attr("width", "100%").attr("height", "100%").attr("xmlns", "http://www.w3.org/2000/svg").attr("id", "overlay");
          var counter = 1;
          for (var i=1; i<size; i++ ){
            var overlay = 
            container2.selectAll("circle")
            .data(arrayC[i]).enter()
            .append("circle")
            var overlayAttributes = overlay
            .attr("cx", function (d){return d.x_axis;})
            .attr("cy", function (d){return d.y_axis;})
            .attr("r", function (d){return d.radius;})
            .attr("class", function(){
              if (counter == 1){
                counter++
                return "stars1"
              } else if (counter == 2) {
                counter++
                return "stars2"
              } else if (counter == 3){
                counter++
                return "stars3"
              } else {
                counter=1
                return "stars4"
              }
            })
            .style("fill", "rgb(255,255,255)")
          };
        </script>
      </div>
      <div id = 'wrapper2' class='span-12'>
      </div>
      <div id='administration'>
        <a href='logoff.php' class='pull-right'>Log off</a>
        <?php 
          if($_SESSION['errors']){
            echo "<h3 class='alert alert-error'>" . $_SESSION['errors'] . "</h3>";
          }
          if($_SESSION['success']){
            echo "<h3 class='alert alert-success'>" . $_SESSION['success'] . "</h3>";
          }
        ?>
        <h4 class='center'><a href="addsite.php">Add a project</a></h4>
        <h5>or</h5>
        <h4>Select a project to edit:</h4>
          <form action='loadsite.php' method='post'>
            <input type='hidden' name='secure' value='secure'>
            <select name='id' class="form-control input-block-level">
              <?php 
                $proj_query = "SELECT * FROM projects ORDER BY date DESC";
                $projects = fetch_all($proj_query);
                if(!is_null($projects)){
                  foreach ($projects as $project) {
                    echo "<option value='".$project['id']."'>".$project['title']."</option>";
                  }
                }
              ?>
            </select>
            <input type='submit' value='Edit Site' class='btn btn-info btn-large pull-right'>
          </form>
      </div>
    </div>
    <script src="../lib/js/head.min.js"></script>
    <script src="../lib/js/reveal.min.js"></script>
    <script src="../assets/javascripts/warp.js" charset="utf-8"></script>
    <script src="../assets/javascripts/portfolio.js" charset="utf-8"></script>
  </body>
</html>