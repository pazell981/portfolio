            (function() {
              function CalculateStarPoints(centerX, centerY, arms, outerRadius, innerRadius){
               var results = "";
               var angle = Math.PI / arms;
               for (var i = 0; i < 2 * arms; i++){
                var r = (i & 1) == 0 ? outerRadius : innerRadius;
                var currX = centerX + Math.cos(i * angle) * r;
                var currY = centerY + Math.sin(i * angle) * r;
                if (i == 0){
                 results = currX + "," + currY;
               } else {
                 results += ", " + currX + "," + currY;
               }
             }
             return results;
           }
           function TwinklingStar(){
            var n = Math.floor(Math.random()*size);
            var x = Math.floor(Math.random()*((n+1)*500));
            var d = arrayC[n][x];
            var multiplier = Math.ceil(Math.random()*2);
            var rotation = (Math.round(Math.random()));
            if (rotation == 0){
              rotation = -1;
            }
            var start_rotate = Math.round(Math.random()*rotation*45);
            var svg = container
            .append("g")
            .attr("transform", "translate("+d.x_axis+", "+d.y_axis+")")
            .attr("class", "star_"+id);
            var star = svg.append("polygon")
            .attr("class", "star_"+id)
            .attr("visibility", "visible")
            .attr("points", CalculateStarPoints(0, 0, 4, d.radius*4*multiplier, d.radius*multiplier))
            .style("fill", "rgb(255,255,255)")
            .style("opacity", 0)
            .attr("transform","rotate("+start_rotate+")");
            star.transition().duration(4000).attr("transform", function(d, i, a) { return d3.interpolateString(a, "rotate("+(rotation*180)+")"); }).style("opacity", .85);
            star.transition().delay(2000).duration(2000).attr("transform", function(d, i, a) { return d3.interpolateString(a, "rotate("+(rotation*180)+")"); }).style("opacity",0);
            setTimeout(function(){
              d3.selectAll(".star_"+rid).remove();
              TwinklingStar();
              rid++;
            }, 4000)
            id++
          }
          function ShootingStar(){
            var n = Math.floor(Math.random()*size);
            var x = Math.floor(Math.random()*((n+1)*500));
            var d = arrayC[n][x];
            var multiplier = Math.ceil(Math.random()*2)
            var rotation = (Math.round(Math.random()));
            if (rotation == 0){
              rotation = -1;
            }
            var svg = container
            .append("g")
            .attr("transform", "translate("+d.x_axis+", "+d.y_axis+")")
            .attr("class", "sstar_"+sid);
            svg.transition().duration(6000).attr("transform", "translate("+arrayC[n][Math.floor(Math.random()*500)].x_axis+", "+arrayC[n][Math.floor(Math.random()*500)].y_axis+")").ease("circle");
            var star = svg.append("polygon")
            .attr("class", "sstar_"+sid)
            .attr("visibility", "visible")
            .attr("points", CalculateStarPoints(d.x_axis, d.y_axis, 8, d.radius*4*multiplier, d.radius*multiplier))
            .style("fill", "rgb(255,255,255)")
            .style("opacity", 0)
            .attr("transform", function(d){ return "rotate("+rotation+")"})
            star.transition().duration(4000).attr("transform", function(d, i, a) { return d3.interpolateString(a, "rotate("+(rotation*180)+")"); }).style("opacity", .95);
            star.transition().delay(2000).duration(2000).attr("transform", function(d, i, a) { return d3.interpolateString(a, "rotate("+(rotation*180)+")"); }).style("opacity",0);             
            setTimeout(function(){
              d3.select(".sstar_"+srid).remove();
              ShootingStar();
              srid++;
            }, 6000)
            sid++;
          }
          var id = 0;
          var rid = 0;
          var sid = 0;
          var srid =0;
          var size;
          if ($(window).width()<481){
            size=1;
          } else if ($(window).width()<768){
            size=2;
          } else if ($(window).width()<1200){
            size=3;
          } else {
            size=4;
          }
          if(navigator.userAgent.match(/(iPhone)|(iPod)|(android)|(webOS)/i)){
            var radius = 2;
          }else{
            var radius = 1;
          }
          var arrayC=[];
          for (var j=0; j<size; j++){
            arrayC[j]=[];
            for(i=0; i<(500*(j+1)); i++){
              arrayC[j].push({
                "x_axis": parseInt(Math.random()*$("#wrapper1").width()),
                "y_axis": parseInt(Math.random()*$("#wrapper1").height()), 
                "radius": radius
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
          var container2 = d3.select("#starry").append("svg").attr("width", "100%").attr("height", "100%").attr("xmlns", "http://www.w3.org/2000/svg").attr("id", "starry_overlay");
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
          if ($(window).width()<481){
            TwinklingStar()
            setTimeout(TwinklingStar(),2000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),3000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            ShootingStar();
          } else if ($(window).width()<768){
            TwinklingStar()
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),4000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),5000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),5000);
            ShootingStar();
            setTimeout(ShootingStar(),4000);
          } else if ($(window).width()<1200){
            TwinklingStar()
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),4000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),4000);
            setTimeout(TwinklingStar(),6000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),4000);
            setTimeout(TwinklingStar(),5000);
            setTimeout(TwinklingStar(),6000);
            ShootingStar();
            setTimeout(ShootingStar(),2000);
            setTimeout(ShootingStar(),4000);
          } else {
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),4000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),4000);
            setTimeout(TwinklingStar(),5000);
            TwinklingStar()
            setTimeout(TwinklingStar(),1000);
            setTimeout(TwinklingStar(),2000);
            setTimeout(TwinklingStar(),3000);
            setTimeout(TwinklingStar(),4000);
            setTimeout(TwinklingStar(),5000);
            setTimeout(TwinklingStar(),6000);
            ShootingStar();
            setTimeout(ShootingStar(),2000);
            setTimeout(ShootingStar(),3000);
            setTimeout(ShootingStar(),4000);
          }
        }());