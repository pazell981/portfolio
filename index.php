<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!doctype html>
<html>
  <?php     
    session_start();
    include "dbConnection.php";
    if (isset($_SESSION["userid"])) {
        $userid = $_SESSION["userid"];
    }
    if (isset($_SESSION["errors"])) {
      $errors = $_SESSION["errors"];
    } else{
      $errors = [];
      $errors["email"] = FALSE;
      $errors["password"] = FALSE;
    }
  ?>
  <head>
    <meta charset="utf-8">

    <title>Paul's Launchpad - Portfolio of a Web Developer</title>

    <meta name="description" content="The portfolio of Front End/Web Developer, Paul Zellmer.  ">
    <meta name="keywords" content="Paul Zellmer, Web Developer, Front End Developer, Portfolio, Resume, HTML, HTML5, CSS, CSS3, PHP, CodeIgniter, jQuery, D3 JS, JavaScript, Node JS, Express JS, Angular JS, MongoDB, PostgreSQL, MySQL, SQL, Ruby, Ruby on Rails, Git">
    <meta name="robots" content="index">
    <meta name="copyright" content="Copyright © 2014 Paul Zellmer. All Rights Reserved.">
    <meta name="author" content="Paul Zellmer">
    <meta name="revisit-after" content="7">
    <meta http-equiv="cache-control" content="public, max-age=86400">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="http://www.pazellmer.com/assets/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="http://www.pazellmer.com/assets/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="http://www.pazellmer.com/assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="http://www.pazellmer.com/assets/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="http://www.pazellmer.com/assets/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="http://www.pazellmer.com/assets/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="Paul's Launchpad"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="http://www.pazellmer.com/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="http://www.pazellmer.com/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="http://www.pazellmer.com/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="http://www.pazellmer.com/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="http://www.pazellmer.com/mstile-310x310.png" />


    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/lib/js/head.min.js" charset="utf-8"></script>
  </head>
  <body>
    <div id="curtain" style="margin:0;padding:0;position: absolute;background: -moz-radial-gradient(center,circle cover,rgba(255,255,255,1) 0,rgba(187,187,187,1) 100%);background: -webkit-gradient(radial,center center,0,center center,100%,color-stop(0,rgba(255,255,255,1)),color-stop(100%,rgba(187,187,187,1)));background: -webkit-radial-gradient(center,circle cover,rgba(255,255,255,1) 0,rgba(187,187,187,1) 100%);background: -o-radial-gradient(center,circle cover,rgba(255,255,255,1) 0,rgba(187,187,187,1) 100%);background: -ms-radial-gradient(center,circle cover,rgba(255,255,255,1) 0,rgba(187,187,187,1) 100%);background: radial-gradient(center,circle cover,rgba(255,255,255,1) 0,rgba(187,187,187,1) 100%);height: 100vh;width: 100vw;top: 0;left: 0;z-index: 1200;">
    </div>
    <div class='container-fluid'>
      <div class='row'>
        <div id = 'wrapper1' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
          <div class='row'>
            <div id='topbar'>
              <div id='topbarlarge' class='col-sm-12 col-md-12 col-lg-12'>
                <ul>
                  <li><a href='#/bio' class='nav inset'>Bio</a></li>
                  <li><a href='#/skills' class='nav inset'>Skills</a></li>
                  <li><a href='#/resume' class='nav inset'>Resum&eacute;</a></li>
                  <li><a href='#/contact' class='nav inset'>Contact</a></li>
                  <li><a href='#/profiles' class='nav inset'>Profiles</a></li>
                </ul>
              </div><!-- end of #topbarlarge -->
              <div id='topbartop' class='topbarsmall col-xs-12'>
                <ul>
                  <li><a href='#/bio' class='nav inset'>Bio</a></li>
                  <li><a href='#/skills' class='nav inset'>Skills</a></li>
                  <li><a href='#/resume' class='nav inset'>Resum&eacute;</a></li>
                </ul>
              </div><!-- end of #topbar pt1 smallscreen -->
              <div id='topbarbottom' class='topbarsmall col-xs-12'>
                <ul>
                  <li><a href='#/contact' class='nav inset'>Contact</a></li>
                  <li><a href='#/profiles' class='nav inset'>Profiles</a></li>
                </ul>
              </div><!-- end of #topbar pt2 smallscreen -->
            </div>
          </div><!-- end of .row -->
          <div class='row'>
            <a href="https://github.com/pazell981/warp.js" id='fork' class='hidden-xs hidden-sm' target='_blank'><img style="position: absolute; top: 40px; right: 0; border: 0;" src="/assets/images/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f77686974655f6666666666662e706e67.png" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png"></a>
            <div id='project_nav' class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
              <div class='nav_open' class='pull-right'>
                <img src='assets/fonts/svgs/fi-list.svg' alt='Open Navigation Panel' id='open_panel'>
              </div><!-- end of #nav_open -->
              <div class='project_accord'>
                <!-- start php script for project accordion -->
                <?php 
                  $proj_query = "SELECT * FROM projects ORDER BY date";
                  $projects = fetch_all($proj_query);
                  if(!is_null($projects)){
                    $i = 0;
                    foreach ($projects as $project) {
                      ?>
                      <h3 class='proj_link' id='<?php echo $i; ?>' data-link='<?php echo $project['url']; ?>' class='proj_link_a'><?php echo $project['title']; ?></h3>
                        <div>
                          <p>Description: <?php echo $project['description']; ?></p>
                          <p>Technical description:  <?php echo $project['tech_info']; ?></p>
                          <p>GitHub Address: <a href='<?php echo $project['github_address'] ?>' target='_blank'> <?php if ($project['github_address'] == "#"){ echo "Not Available"; } else { echo $project['github_address']; } ?></a></p>
                        </div>
                      <?php
                      $i++;
                    }
                  }
                ?>
              </div><!-- end of #project_accord -->
            </div><!-- end of #project nav -->
            <div id='warpContainer'       
                  data-xOffset='30'   
                  data-yOffset='20' 
                  data-shape='circle' 
                  data-continuous='TRUE' 
                  data-xSize='100' 
                  data-ySize='100' 
                  class='col-xs-10 col-sm-10 col-md-10 col-lg-10'>
              <!-- start php script for project display -->
              <?php 
                $proj_query = "SELECT * FROM projects ORDER BY date";
                $projects = fetch_all($proj_query);
                if(!is_null($projects)){
                  $i = 0;
                  foreach ($projects as $project) {
                    ?>
                    <div class='warp'>
                      <div class='warp_img'>
                        <img src='<?php echo $project['image_location']; ?>' class='img-rounded' alt='<?php echo $project['title'] ?>'>
                        <span class='proj_overlay_title'><?php echo $project['title'] ?></span>
                      </div>
                      <div class='warp_desc'>
                        <h3><?php echo $project['title'] ?></h3>
                        <label>Date: </label><p><?php echo $project['date']; ?></p>
                        <label>Description: </label><p><?php echo $project['description']; ?></p>
                        <p data-link='<?php echo $project['url']; ?>' class='proj_link link' id='<?php echo $i; ?>'>View Project</p>
                      </div>
                    </div>
                    <?php
                    $i++;
                  }
                }
              ?>
            </div><!-- end of #warpContainer -->
          </div><!-- end of .row -->
        </div><!-- end of #wrapper1 -->
        <div id='wrapper3' class='row'>
          <div id='topbar2' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <ul>
              <li id='back_to_warp'><a href='#'><span class="glyphicon glyphicon-arrow-left white"></span>Back to Portfolio</a></li>
            </ul>
          </div><!-- end of #topbar2 .col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
          <div class='row'>
            <div id='project_nav2' class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
              <div class='nav_open' class='pull-right'>
                <img src='assets/fonts/svgs/fi-list.svg' alt='Open Navigation Panel' id='open_panel'>
              </div><!-- end of #nav_open -->
              <div class='project_accord'>
                <!-- start php script for project accordion -->
                <?php 
                  $proj_query = "SELECT * FROM projects ORDER BY date";
                  $projects = fetch_all($proj_query);
                  if(!is_null($projects)){
                    $i = 0;
                    foreach ($projects as $project) {
                      ?>
                      <h3 id='project<?php echo $i; ?>' data-link='<?php echo $project['url']; ?>' class='proj_link_a'><?php echo $project['title']; ?></h3>
                        <div>
                          <p>Description: <?php echo $project['description']; ?></p>
                          <p>Technical description:  <?php echo $project['tech_info']; ?></p>
                          <p>GitHub Address: <a href='<?php echo $project['github_address'] ?>' target='_blank'> <?php if ($project['github_address'] == "#"){ echo "Not Available"; } else { echo $project['github_address']; } ?></a></p>
                        </div>
                      <?php
                      $i++;
                    }
                  }
                ?>
              </div><!-- end of #project_accord -->
            </div><!-- end of #project nav2 -->
            <div id='iframe' class='col-xs-10 col-sm-10 col-md-10 col-lg-10'>
              <iframe src='loading.html' id='project_view_screen' sandbox='allow-same-origin allow-scripts allow-forms allow-top-navigation'></iframe>
            </div><!-- end of #iframe -->
          </div><!-- end of .row -->
        </div><!-- end of #wrapper3 .row -->
        <div id = 'wrapper2' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
          <div class='reveal'>
            <div class = 'slides row'> 
              <section id='home' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <div id='welcome' class='pointer'>
                  <h2>Welcome to</h2>
                  <h1>Paul's Launchpad</h1>
                </div>
              </section>
              <section id='portfolio' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' data-state='portfolio'>
                <h2>My</h2>
                <h1 class='pointer'>Portfolio</h1>
              </section>
              <section id='bio' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' data-state='bio'>
                <h1 class='pointer'>Bio</h1>
                <div id='biopanel' class='row'>
                  <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <img src="assets/images/paulzellmerbio.jpg" alt="Paul Zellmer Junior Web Developer" class="pull-left img-circle img-responsive">
                    <div id="bio_text" class='pull-right'>
                      <p>Hello there!!! My name is Paul Zellmer and I am a recent alumnus of the coding boot camp Coding Dojo.  During my time in the boot camp I trained and developed skills in:</p>
                        <ul>
                          <li>JavaScript</li>
                          <li>Python</li>
                          <li>Ruby</li>
                          <li>PHP</li>
                        </ul>
                      <p>I have found a love for not only the problem solving and troubleshooting aspects of web development but also the design aspect... even if troubleshooting sometimes makes you want to pull out your hair.</p>
                      <p>So please explore my site, if you have any questions or are interested in hiring me please <a href="index.php#/contact">contact me</a>.</p>
                    </div>
                  </div>
                </div>
              </section>
              <section id='skills' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <h1>Skill Set</h1>
                <div tagcloud bw>
                  <?php 
                    $skills = array('Website Design', 'HTML5', 'CSS3', 'd3 JS', 'Foundation', 'jQuery UI', 'Twitter Bootstrap', 'jQuery', 'Responsive Design', 'JavaScript', 'Node JS', 'Express', 'Angular', 'MongoDB', 'npm', 'socket.io', 'Passport.js', 'Git', 'Ruby', 'PHP', 'AJAX', 'Ruby on Rails', 'Database Design', 'MySQL','SQLite', 'CodeIgniter', 'PostgreSQL', 'Adobe Photoshop','Python', 'Django');
                    shuffle($skills);
                    foreach ($skills as $skill) {
                        echo "$skill \n";
                    }
                  ?>
                </div>
              </section>
              <section id='resume' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' data-state='resume'>
                <div class='row'>
                  <h1 class='pointer'>Resum&eacute;</h1>
                </div><!-- end of row -->
              </section>
              <section id='contact' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <h1 class='pointer'>Contact</h1>
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <table id='contactinfo'>
                            <tbody>
                              <tr>
                                <td><a href='mailto:paul@pazellmer.com'><img src='/assets/fonts/svgs/fi-mail.svg' alt='Mail Me'></a></td>
                                <td><span class='small'>Mail Me: <a href='mailto:paul@pazellmer.com'>paul@pazellmer.com</a></span></td>
                              </tr>
                              <tr>
                                <td><a href='http://www.linkedin.com/in/paulzellmer9/'><img src='/assets/images/linkedin.svg' alt='Connect with me LinkedIn'></a></td>
                                <td><span class='small'>LinkedIn: <a href='http://www.linkedin.com/in/paulzellmer9/'>paulzellmer9</a></span></td>
                              </tr>
                              <tr>
                                <td><a href='skype:paul.zellmer?chat'><img src='/assets/fonts/svgs/fi-social-skype.svg' alt='Skype me'></a></td>
                                <td><span class='small'>Skype: <a href='skype:paul.zellmer?chat'>paul.zellmer</a></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td>
                          <div id='contactpanel'>
                            <div class='alert alert-success' id='form_success'>
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <p>Thank you for your interest, your message has been sent!</p>
                            </div><!-- end of #form_success -->
                            <div class='alert alert-error' id='form_failure'>
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <p>I am sorry there was an issues sending your message please try again.</p>
                            </div><!-- end of #form_failure -->
                            <form id='contact_form' class='form-horizontal' action='email.php' method='post'>
                              <input type='hidden' name='secure' value='secure'>
                              <input type='text' name='name' placeholder='Your Name' class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' required>
                              <input type='email' name='email' placeholder='Your E-mail Address' class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' required>
                              <input type='text' name='subject' class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' placeholder='Subject'>
                              <textarea name='message' rows='4' class='form-control col-xs-12 col-sm-12 col-md-12 col-lg-12' placeholder='Message' required></textarea>
                              <input type='submit' value='Send' class='btn btn-lg btn-info pull-right'>
                            </form>
                          </div><!-- end of #contactpanel -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </section>
              <section id='profiles' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' data-state='profiles'>
                <h1 class='pointer'>Profiles</h1>
                <a href='http://github.com/pazell981' id='github' class='offscreen' target="_blank"><img src='/assets/images/github.svg' alt='GitHub'></a>
                <a href='http://www.linkedin.com/in/paulzellmer9/' id='linkedin' class='offscreen' target="_blank"><img src='/assets/images/linkedin.svg' alt='LinkedIn'></a>
                <a href='http://www.beknown.com/paul-zellmer' id='monster' class='offscreen' target="_blank"><img src='/assets/images/monster.svg' alt='Monster'></a>
                <a href='http://www.angel.co/paul-zellmer' id='angel' class='offscreen' target="_blank"><img src='/assets/images/angellist.svg' alt='Angel List'></a>
                <a href="http://paulzellmer.elance.com" id='elance' class='offscreen' target="_blank"><img src="/assets/images/elance.svg" alt='Elance'>
                </a>
              </section>
            </div><!-- end of #slides .row -->
          </div><!-- end of .reveal -->
          <div id='control' >
            <p id='pi' class='pointer'>&pi;</p>
            <div id='controlpanel' class='info'>
              <button class='close pull-right'>&times;</button>
              <h1>I am sorry you are not allowed to administer this site!</h1>
            </div><!-- end of #controlpanel -->
            <div id='controlpanelallowed' class='info'>
              <button class='close pull-right'>&times;</button>
              <?php
                if($errors["email"]==TRUE){
                  echo "<h3 class='error'>There was an error verifying your e-mail, please try to log-in again.</h3>";
                }
                if($errors["password"]==TRUE){
                  echo "<h3 class='error'>There was an error verifying your password, please try to log-in again.</h3>";
                }
              ?>
              <h3 class='pull-left'>Please login:</h3>
                <form action='login.php' method='post'>
                  <input type='hidden' value='secure' name='secure'>
                  <input type='text' placeholder='E-mail' name='email'>
                  <input type='password' placeholder='Password' name='password'>
                  <input type='submit' class='btn btn-info btn-large'>
                </form>
            </div><!-- end of #controlpanelallowed -->
          </div><!-- end of #control -->
          <div class = 'footer'>
            <ul id='footer-nav'>
              <li><a href='#/bio'>Bio</a></li>
              <li><a href='#/skills'>Skills</a></li>
              <li><a href='#/portfolio'>Portfolio</a></li>
              <li><a href='#/resume'>Resum&eacute;</a></li>
              <li><a href='#/contact'>Contact</a></li>
              <li><a href='#/profiles'>Profiles</a></li>
            </ul>
            <p>© 2014 Paul Zellmer All Rights Reserved</p>
          </div>
        </div><!-- end of #wrapper2 .col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
      </div>
    </div><!-- end of .container-fluid -->
    <div id='resumepanel' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      <button class='close pull-right'>&times;</button>
      <iframe src="" id='resumeviewer'></iframe>
    </div><!-- end of #resumepanel -->

    <script>
      head.load(
        [{jQuery:"/lib/js/jquery-2.1.1.min.js"},
        {d3:"/lib/js/d3.min.js"}]
      );
      head.ready("jQuery", function(){
        head.load({veil:"/lib/js/jquery.unveil.min.js"})
      })
      head.ready("d3", function () {
          head.load("/assets/javascripts/starryfield.min.js");
      });
      head.ready("veil", function(){
        $(function() {
            $("img").unveil();
        });
      })
      head.ready("jQuery", function () {
          head.load([{jQueryUI:"/lib/js/jquery-ui.min.js"}, {bootstrap:"/lib/js/bootstrap.min.js"}, {warpJs:"assets/javascripts/warp.min.js"}, {Reveal:"lib/js/reveal.min.js"}]);
      });
        head.ready("bootstrap", function () {
          head.load(["/lib/js/transition.min.js","/lib/js/tooltip.min.js",{popover:"/lib/js/popover.min.js"}]);
        });
        head.ready("Reveal", function () {
          Reveal.initialize({
            controls: true,
            progress: true,
            history: false,
            center: true,
            loop: true,
            touch: true,
            keyboard: true,
            overview: true,
            viewDistance: 3,

            theme: Reveal.getQueryHash().theme,
            transition: Reveal.getQueryHash().transition || 'default', // default/cube/page/concave/zoom/linear/fade/none

            dependencies: [
              { src: 'lib/js/classList.min.js', condition: function() { return !document.body.classList; } },
              { src: 'plugin/markdown/marked.min.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
              { src: 'plugin/tagcloud/tagcloud.min.js', async: true},
              { src: 'plugin/markdown/markdown.min.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
              { src: 'plugin/highlight/highlight.min.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } }
            ]
          });
          Reveal.addEventListener("ready",function(event){
              setTimeout(function(){
                  $("#curtain").fadeOut("")
              },2000);
          });
        });
        head.ready("popover", function () {
          head.load({portfolio:"assets/javascripts/portfolio.min.js"});
        });
        head.ready("jQueryUI", function () {
          $(document).ready(function (){
            $(".project_accord").accordion({ 
              header: "h3",
              heightStyle: "content"
            });
          });
        });
        head.ready(function (){
            head.load(["lib/css/normalize.min.css", "lib/css/bootstrap-responsive.min.css", "lib/css/bootstrap.min.css", "lib/css/jquery-ui-vader.min.css", "lib/css/reveal.min.css", "lib/css/theme/default.min.css", "lib/css/zenburn.min.css", "lib/css/animate.min.css"]);
        });
        if(head.screen.width<=767 && head.mobile==true){
          head.load("assets/css/stylesheet-mobile.min.css")
        }
        if(head.screen.width>=768 && head.screen.width<=1199 && head.mobile==true){
          head.load("assets/css/stylesheet-tablet.min.css")
        }
        if(head.screen.width>=1200 || head.desktop==true){
          head.load("assets/css/stylesheet-desktop.min.css")
        }
    </script>
    <script>
      (function(i, s, o, g, r, a, m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function() {
              (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
              m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.pazellmer.com/analytics.js', 'ga');
      ga('create', 'UA-55360839-1', 'auto');
      ga('require', 'linkid', 'linkid.js');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');
    </script>
  </body>
</html>