/*!
 * warp.js
 *
 * MIT licensed
 *
 * Copyright (C) 2014 Paul Zellmer, http://pazellmer.com
 */
;

function position(c, d, time) {
    c.attr("id", "warp" + arrayCoord[d].index);
    c.animate({
        left: arrayCoord[d].x_axis,
        top: arrayCoord[d].y_axis,
        "z-index": arrayCoord[d].z_index,
        width: arrayCoord[d].width,
        height: arrayCoord[d].height,
        opacity: arrayCoord[d].opacity
    }, time)
}

function rndItems() {
    for (i = 0; i < 4; i++) {
        if ((numItems + i) % 4 == 0) {
            return (numItems + i)
        }
    }
}

function Coord(n, l, h, k, m, j, o) {
    this.index = n;
    this.x_axis = l;
    this.y_axis = h;
    this.z_index = k;
    this.width = m;
    this.height = j;
    this.opacity = o
}

function Continuous() {
    if (!navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i)) {
        $("#warpContainer").prepend($("#warpContainer").children(".warp:last"));
        $(".warp").each(function(a) {
            position($(this), a, 8000);
        })
        setTimeout(function() {
            if (continuous == true) {
                Continuous();
            }
        }, 8000);
    }
}

$("#warpContainer").parent().prepend("<div id='overlay'><div id='warp_display'></div></div>");
$(".warp_desc, #overlay").hide();
var yOffset = parseInt($("#warpContainer").attr("data-yOffset")) || 0;
var xOffset = parseInt($("#warpContainer").attr("data-xOffset")) || 0;
var ySize = parseInt($("#warpContainer").attr("data-ySize")) || 0;
var xSize = parseInt($("#warpContainer").attr("data-xSize")) || 0;
var shape = $("#warpContainer").attr("data-shape") || "diamond";
var continuous = $("#warpContainer").attr("data-continuous");

if (continuous == "true" || continuous == "TRUE") {
    continuous = true
} else {
    continuous = false
}
var numItems = $(".warp").length;
if (numItems > 0) {
    var width = $(".warp").width();
    var height = $(".warp").height();
    var xCenter = ($(window).width() + xOffset) / 2;
    var xLeft = $(window).width() / 4 + xOffset;
    var yTop = $(window).height() / 4 + yOffset;
    var yCenter = ($(window).height() + yOffset) / 2;
    var xInc = (xCenter - xLeft) / (numItems / 4);
    var xMov = xInc;
    var yInc = (yCenter - yTop) / (numItems / 4);
    var yMov = yInc;
    var counter = 1;
    var zIndex = 200;
    var zIndexInc = parseInt(800 / numItems);
    var limit = rndItems();
    var movOffset = limit - numItems + 1;
    arrayCoord = [];
    if (shape == "diamond") {
        for (var i = 0; i < limit; i++) {
            if (counter == 1) {
                xAxis = Math.round(((xCenter - xSize - xMov - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round((yCenter - (height * zIndex / 1000) / 2) / $(window).height() * 100)
            } else if (counter == 2) {
                xAxis = Math.round((xCenter - (width * zIndex / 1000) / 2) / $(window).width() * 100);
                yAxis = Math.round(((yCenter - ySize - yMov - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else if (counter == 3) {
                xAxis = Math.round(((xCenter + xSize + xMov - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round((yCenter - (height * zIndex / 1000) / 2) / $(window).height() * 100);
                xMov += xInc
            } else {
                xAxis = Math.round((xCenter - (width * zIndex / 1000) / 2) / $(window).width() * 100);
                yAxis = Math.round(((yCenter + ySize + yMov - (height * zIndex / 1000) / 2) / $(window).height()) * 100);
                yMov += yInc;
                counter = 0
            }
            arrayCoord[i] = new Coord(i, xAxis + "%", yAxis + "%", zIndex, (width * zIndex / 1000), (height * zIndex / 1000), (1 * zIndex / 1000));
            zIndex += zIndexInc;
            counter++
        }
    }
    if (shape == "circle") {
        for (var i = 0; i < limit; i++) {
            if (counter == 1) {
                xAxis = Math.round(((xCenter - xSize - xMov - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round((yCenter - (height * zIndex / 1000) / 2) / $(window).height() * 100)
            } else if (counter == 2) {
                xAxis = Math.round(((xCenter - xSize - xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter - ySize - yMov / 2 - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else if (counter == 3) {
                xAxis = Math.round((xCenter - (width * zIndex / 1000) / 2) / $(window).width() * 100);
                yAxis = Math.round(((yCenter - ySize - yMov - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else if (counter == 4) {
                xAxis = Math.round(((xCenter + xSize + xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter - ySize - yMov / 2 - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else if (counter == 5) {
                xAxis = Math.round(((xCenter + xSize + xMov - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round((yCenter - (height * zIndex / 1000) / 2) / $(window).height() * 100)
            } else if (counter == 6) {
                xAxis = Math.round(((xCenter + xSize + xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter + ySize + yMov / 2 - (height * zIndex / 1000) / 2) / $(window).height()) * 100);
            } else if (counter == 7) {
                xAxis = Math.round((xCenter - (width * zIndex / 1000) / 2) / $(window).width() * 100);
                yAxis = Math.round(((yCenter + ySize + yMov - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else {
                xAxis = Math.round(((xCenter - xSize - xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter + ySize + yMov / 2 - (height * zIndex / 1000) / 2) / $(window).height()) * 100);
                xMov += xInc;
                yMov += yInc;
                counter = 0;
            }
            arrayCoord[i] = new Coord(i, xAxis + "%", yAxis + "%", zIndex, (width * zIndex / 1000), (height * zIndex / 1000), (1 * zIndex / 1000));
            zIndex += zIndexInc;
            counter++
        }
    }
    if (shape == "triangle") {
        for (var i = 0; i < limit; i++) {
            if (counter == 1) {
                xAxis = Math.round((xCenter - (width * zIndex / 1000) / 2) / $(window).width() * 100);
                yAxis = Math.round(((yCenter - ySize - yMov - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else if (counter == 2) {
                xAxis = Math.round(((xCenter + xSize + xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter + ySize + yMov / 2 - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else {
                xAxis = Math.round(((xCenter - xSize - xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter + ySize + yMov / 2 - (height * zIndex / 1000) / 2) / $(window).height()) * 100);
                xMov += xInc;
                yMov += yInc;
                counter = 0
            }
            arrayCoord[i] = new Coord(i, xAxis + "%", yAxis + "%", zIndex, (width * zIndex / 1000), (height * zIndex / 1000), (1 * zIndex / 1000));
            zIndex += zIndexInc;
            counter++
        }
    }
    if (shape == "column") {
        for (var i = 0; i < limit; i++) {
            if (counter == 1) {
                xAxis = Math.round((xCenter + xSize + xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width() * 100);
                yAxis = Math.round(((yCenter - (height * zIndex / 1000) / 2) / $(window).height()) * 100)
            } else {
                xAxis = Math.round(((xCenter - xSize - xMov / 2 - (width * zIndex / 1000) / 2) / $(window).width()) * 100);
                yAxis = Math.round(((yCenter - (height * zIndex / 1000) / 2) / $(window).height()) * 100);
                xMov += xInc;
                yMov += yInc;
                counter = 0
            }
            arrayCoord[i] = new Coord(i, xAxis + "%", yAxis + "%", zIndex, (width * zIndex / 1000), (height * zIndex / 1000), (1 * zIndex / 1000));
            zIndex += zIndexInc;
            counter++
        }
    }
$($(".warp").get()).each(function(b) {
    $(this).attr("id", "warp" + arrayCoord[b].index);
    $(this).css("left", arrayCoord[b].x_axis);
    $(this).css("top", arrayCoord[b].y_axis);
    $(this).css("z-index", arrayCoord[b].z_index);
    $(this).css("width", arrayCoord[b].width);
    $(this).css("height", arrayCoord[b].height);
    $(this).css("opacity", arrayCoord[b].opacity)
});
$(document).on("keydown", function(b) {
    if (b.keyCode == 38) {
        continuous = false;
        $(".warp").stop(true);
        $("#warpContainer").append($("#warpContainer").children(".warp:first"));
        $(".warp").each(function(a) {
            position($(this), a, 2000)
        })
    } else if (b.keyCode == 40) {
        continuous = false;
        $(".warp").stop(true);
        $("#warpContainer").prepend($("#warpContainer").children(".warp:last"));
        $(".warp").each(function(a) {
            position($(this), a, 2000)
        })
    }
});
$(document).on("click", ".warp:not(.warp:last)", function() {
    continuous = false;
    $(".warp").stop(true);
    var that = $(this);
    var c = $(this).attr("id");
    var d = arrayCoord.length - parseInt(c.slice(4)) - movOffset;
    for (i = 0; i < d; i++) {
        $("#warpContainer").prepend($("#warpContainer").children(".warp:last"));
        $(".warp").each(function(a) {
            position($(this), a, 1000);
        })
    }
    setTimeout(function() {
        $("#warp_display").html(that.html());
        $("#warp_display").children().show();
        $("#overlay").fadeToggle();
    }, 2000)
});
$(document).on("click", ".warp:last", function() {
    $("#warp_display").html($(this).html());
    $("#warp_display").children().show();
    $("#overlay").fadeToggle();
});
$("#overlay").click(function() {
    $("#overlay").fadeOut(1000)
    setTimeout(function() {
        $("#overlay").hide();
        continuous = true;
        Continuous();
    }, 1000);
})
Continuous();
};