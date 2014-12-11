<!doctype html>
<html>
  <?php    
    session_start();
    include 'dbConnection.php';
    if (isset($_SESSION['userid'])) {
      $userid = $_SESSION['userid'];
    }
    if(!isset($_SESSION['error'])){
      $_SESSION['error']=FALSE;
    }
    if(!isset($_SESSION['success'])){
      $_SESSION['success']=FALSE;
    }
  ?>
  <head>
    <meta charset="utf-8">

    <title>Paul's Launchpad - Edit Project</title>

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

    <script>
      $(function() {
        $("#datepicker").datepicker({showAnim: "slideDown", maxDate: 0});
      });
    </script>
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
        <div class='pull-right'>
          <a href='administer.php'>Back</a>  |    
          <a href='logoff.php'>Log off</a>
        </div>
        <?php 
          if($_SESSION['error']){
            echo "<h3 class='alert alert-error'>" . $_SESSION['error'] . "</h3>";
          }
          if($_SESSION['success']){
            echo "<h3 class='alert alert-success'>" . $_SESSION['success'] . "</h3>";
          } 
          $project = $_SESSION["project"];
        ?>
        <h3>Edit <?php echo $project["title"] ?> project:</h3>

        <form action='edit.php' method='post' enctype="multipart/form-data" class='form-horizontal'>
          <input type='hidden' value='secure' name='secure'>
          <input type='hidden' value='<?php echo $userid; ?>' name='user_id'>
          <input type='hidden' value='<?php echo $project['id']; ?>' name='project_id'>
          <div class='form-group'>
            <label for="title" class="col-md-4 col-lg-4">Title:  </label>
            <input type='text' value='<?php echo $project["title"] ?>'name='title' class="input-block-level col-md-8 col-lg-8">
          </div>
          <div class='form-group'>
            <label for='url' class="col-md-4 col-lg-4">URL:  </label>
            <input type='text' value='<?php echo $project["url"] ?>' name='url' class="input-block-level col-md-8 col-lg-8">
          </div>
          <div class='form-group'>
            <label for='description' class="col-md-4 col-lg-4">Description:  </label>
            <textarea name='description' rows='4' class="input-block-level col-md-8 col-lg-8"><?php echo $project["description"] ?></textarea>
          </div>
          <div class='form-group'>
            <label for='date' class="col-md-4 col-lg-4">Date:  </label>
            <input type='text' value='<?php echo $project["date"] ?>' name='date' id='datepicker'  class="span3">
          </div>
          <div class='form-group'>
            <label for='image' class="col-md-4 col-lg-4">Image File:  </label>
            <input type='file' name='image' value='<?php echo $project["image_location"] ?>' class="span5">
          </div>
          <div class='form-group'>
            <label for='active' class="col-md-4 col-lg-4">Project Active in Portfolio?</label>
            <select name='active'>
              <option value='1' <?php if ($project["active"]==1){echo "selected='selected'";} ?>>Yes</option>
              <option value='0' <?php if ($project["active"]==0){echo "selected='selected'";} ?>>No</option>
            </select>
          </div>
          <div class='form-group'>
            <label for='tech_info' class="col-md-4 col-lg-4">Technical Description:  </label>
            <textarea name='tech_info' rows='4' class="input-block-level col-md-8 col-lg-8"><?php echo $project["tech_info"] ?></textarea>
          </div>
          <div class='form-group'>
            <label for='github_address' class="col-md-4 col-lg-4">Github URL:  </label>
            <input type='text' value='<?php echo $project["github_address"] ?>' name="github_address"  class="input-block-level col-md-8 col-lg-8">
          </div>
          <input type='submit' value='Submit' class='btn btn-info pull-right'>
        </form>
      </div>
    </div>
    <script src="../lib/js/head.min.js"></script>
    <script src="../lib/js/reveal.min.js"></script>
    <script src="../assets/javascripts/warp.js" charset="utf-8"></script>
    <script src="../assets/javascripts/portfolio.js" charset="utf-8"></script>
  </body>
</html>