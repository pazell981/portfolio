<!doctype html>
<html>
  <?php     
    include 'dbConnection.php';
  ?>
  <head>
    <meta charset="utf-8">

    <title>Paul's Launchpad</title>

    <meta name="description" content="Paul Zellmer's Portfolio">
    <meta name="author" content="Paul Zellmer">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="lib/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/reveal.css">
    <link rel="stylesheet" href="lib/css/theme/default.css" id="theme">
    <link rel="stylesheet" href="lib/css/zenburn.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">

    <script src="/lib/js/jquery-2.1.1.min.js" charset="utf-8"></script>
    <script src="/lib/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="/lib/js/transition.js" charset="utf-8"></script>
    <script src="/lib/js/tooltip.js" charset="utf-8"></script>
    <script src="/lib/js/popover.js" charset="utf-8"></script>
    <script src="/lib/js/d3.min.js" charset="utf-8"></script>
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
        <div id="topbar">
          <ul>
            <li><a href="#/bio" class='nav inset'>Bio</a></li>
            <li><a href="#/skills" class='nav inset'>Skills</a></li>
            <li><a href="#/resume" class='nav inset'>Resume</a></li>
            <li><a href="#/contact" class='nav inset'>Contact</a></li>
            <li><a href="#/social" class='nav inset'>Social</a></li>
          </ul>
        </div>
        <div id='warpContainer'>
          <?php 
            $proj_query = "SELECT * FROM projects ORDER BY date DESC";
            $projects = fetch_all($proj_query);
            if(!is_null($projects)){
              foreach ($projects as $project) {
                ?>
                <div class="warp" class='span-12' id='<?php $project['id']?>'>
                  <img src="<?php $project['image_location'] ?>" class='img-rounded'>
                  <div class='warp_desc'>
                    <h5><a href="<?php $project['url'] ?>" target='project_view_screen'><?php $project['title'] ?></a></h5>
                    <label>Date: </label><p><?php $project['date'] ?></p>
                    <label>Description: </label><p><?php $project['description'] ?></p>
                  </div>
                </div>
                <?php
              }
            }
          ?>
        </div>
      </div>
      <div id='wrapper3'>
        <div id="project_nav">
          <div class='pull-right'>
            <i class='icon-plus icon-white'></i>
          </div>
          <div id="project_accord">
            <h3 id="back_to_warp"><i class="icon-arrow-left icon-white"></i>Back</h3>
            <?php 
              $proj_query = "SELECT * FROM projects ORDER BY date DESC";
              $projects = fetch_all($proj_query);
              if(!is_null($projects)){
                foreach ($projects as $project) {
                  ?>
                  <h3 id="project<?php $project['id'] ?>"><a href="<?php $project['url'] ?>" target="project_view_screen" ><?php $project['title'] ?></a></h3>
                    <div>
                      <p>Technical description:  <?php $project['tech_info'] ?></p>
                    </div>
                  <?php
                }
              }
            ?>
          </div>
        </div>
        <iframe src="" name="project_view_screen"></iframe>
      </div>
      <div id = 'wrapper2' class='span-12'>
        <div class='reveal'>
          <div class = 'slides row-fluid'> 
            <section id='home' class='span-12'>
              <h2>Coming soon</h2>
              <h1>Paul's Launchpad</h1>
            </section>
          </div>
        </div>
      </div>
    </div>
    <script src="lib/js/head.min.js"></script>
    <script src="lib/js/reveal.min.js"></script>
    <script src="/assets/javascripts/warp.js" charset="utf-8"></script>
    <script src="/assets/javascripts/portfolio.js" charset="utf-8"></script>
    <script>
      // Full list of configuration options available here:
      // https://github.com/hakimel/reveal.js#configuration
      Reveal.initialize({
        controls: true,
        progress: false,
        history: false,
        center: true,
        loop: true,
        keyboard: true,
        overview: true,
        viewDistance: 3,

          theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
          transition: Reveal.getQueryHash().transition || 'default', // default/cube/page/concave/zoom/linear/fade/none

          // Optional libraries used to extend on reveal.js
          dependencies: [
          { src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
          { src: 'plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
          { src: 'plugin/tagcloud/tagcloud.js', async: true},
          { src: 'plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
          { src: 'plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
              // 
              ]
            });
    </script>
  </body>
</html>