$(document).ready(function() {
    $("#biopanel img, #github, #linkedin, #elance, #monster, #angel, #fork, #form_failure, #form_success, #project_nav .project_accord, #project_nav2 .project_accord,#topbar2, #warpContainer, #wrapper3").hide();
    $(".controls").append("<img src='assets/images/logo.svg' alt='Open Site Overview' id='logo_menu' class='pointer'>")
    $("#logo_menu").click(function(){
        Reveal.toggleOverview();
    })
    $("#welcome").click(function(){
        Reveal.slide(3);
    })
    $(".controls").popover({
        animation: true,
        template: "<div class='popover'><div class='arrow'></div><div class='popover-inner'><h6 class='popover-title'></h6><div class='popover-content'></div></div></div>",
        title: "Navigation",
        content: "Use these buttons or the arrows on your keyboard to navigate through the site.",
        placement: "left",
        delay: {
            show: 500,
            hide: 5e3
        }
    });
    setTimeout(function() {
        $(".controls").popover("hide")
    }, 5e3);
    $(".nav_open").popover({
        animation: true,
        template: "<div class='popover'><div class='arrow'></div><div class='popover-inner'><h6 class='popover-title'></h6><div class='popover-content'></div></div></div>",
        title: "Portfolio Explorer",
        content: "To learn more about a project that interests you click on it, or use the side navigation bar to explore different projects.",
        placement: "right",
        delay: {
            show: 500,
            hide: 5e3
        }
    });
    Reveal.addEventListener("bio", function() {
        setTimeout(function() {
            $("#biopanel img").show().addClass("animated rollIn")
        }, 2000)
    });
    $("#portfolio").click(function() {
        Reveal.configure({
            37: null,
            38: null,
            39: null,
            40: null
        });
        $("#wrapper2").animate({
            opacity: ".6"
        }, 1e3).slideUp("slow");
        $("#topbar").delay(2e3).slideDown();
        $("#project_nav").delay(2e3).slideToggle();
        $("#fork").delay(3e3).slideDown();
        $("#warpContainer").delay(3e3).fadeToggle()
        $(".nav_open").popover("show")
        setTimeout(function() {
            $(".nav_open").popover("hide")
        }, 8e3);
    });
    Reveal.addEventListener("portfolio", function() {
        Reveal.configure({
            37: null,
            38: null,
            39: null,
            40: null
        });
        $("#wrapper2").delay(2e3).animate({
            opacity: ".6"
        }, 1e3).slideUp("slow", function() {
            $("#topbar").delay(2e3).slideDown();
            $("#project_nav").delay(2e3).slideToggle();
            $("#fork").delay(3e3).slideDown();
            $("#warpContainer").delay(3e3).fadeToggle()
            $(".nav_open").popover("show")
            setTimeout(function() {
                $(".nav_open").popover("hide")
            }, 5e3);
        })
    });
    $(".nav").click(function() {
        Reveal.configure({
            37: "prev",
            38: "up",
            39: "next",
            40: "down"
        });
        $("#project_nav").slideToggle();
        $("#project_nav .project_accord").hide();
        $("#warp_display").slideUp();
        $("#wrapper2").slideDown(2e3).animate({
            opacity: ".9"
        }, 1e3);
        $("#warpContainer").slideToggle();
        $("#fork").slideToggle();
        $("#topbar").slideUp();
        setTimeout(function() {
            Reveal.initialize();
        }, 3000);
        $(".controls").popover("destroy")
    });
    $("#resume h1").click(function() {
        $("#resumeviewer").attr("src", "/resume.html");
        $("#resumepanel").delay(2e3).fadeIn("slow")
    });
    Reveal.addEventListener("resume", function() {
        $("#resumeviewer").attr("src", "/resume.html");
        $("#resumepanel").delay(2e3).fadeIn("slow")
    });
    $(".close").click(function() {
        $(this).parent().slideToggle("fast")
    });
    $("#pi").click(function(e) {
        if (e.altKey) {
            $(".info").hide;
            $("#controlpanelallowed").slideToggle()
        } else {
            $(".info").hide;
            $("#controlpanel").slideToggle()
        }
    });
    Reveal.addEventListener("slidechanged", function() {
        $(".info").hide();
        $(".controls").popover("destroy")
    });
    $(".controls").popover("show");
    $(document).click(function(e) {
        $(".controls").popover("destroy")
    });
    $(document).on("click", ".proj_link", function() {
        $("#project_nav").slideToggle();
        $("#project_nav2 .project_accord").accordion({
            active: parseInt($(this).attr("id"))
        });
        $("#project_nav2 .project_accord").accordion("refresh");
        $("#project_view_screen").attr("src", $(this).attr("data-link"));
        $("#topbar").slideToggle();
        $("#topbar2").slideToggle();
        $("#project_nav2").slideToggle();
        $("#warpContainer").fadeToggle();
        $("#wrapper3").slideToggle()
    });
    $("#project_view_screen").ready(function() {
        $("#loading").css("display", "none")
    });
    $("#project_view_screen").load(function() {
        $("#loading").css("display", "block")
    });
    $(document).on("click", ".proj_link_a", function() {
        $("#project_view_screen").attr("src", $(this).attr("data-link"))
    });
    $("#project_nav").mouseenter(function() {
        $("#project_nav").animate({
            width: "25%"
        }, 350);
        $(".project_accord").slideDown();
        $(".open_panel").hide();
    });
    $("#project_nav").mouseleave(function() {
        if ($(window).width()<768){
          width={width: "1.5em"};
        } else if ($(window).width()<1200){
          width={width: "2em"};
        } else {
          width={width: "2.5em"};
        }
        $("#project_nav").animate(width, 350);
        $(".project_accord").slideUp()
        $(".open_panel").show();
    });
    $("#project_nav2").mouseenter(function() {
        $("#project_nav2").animate({
            width: "25%"
        }, 350);
        $(".project_accord").slideDown();
        $(".open_panel").hide();
    });
    $("#project_nav2").mouseleave(function() {
        if ($(window).width()<768){
          width={width: '1.5em'};
        } else if ($(window).width()<1200){
          width={width: '2em'};
        } else {
          width={width: '2.5em'};
        }
        $("#project_nav2").animate(width, 350);
        $(".project_accord").slideUp()
        $(".open_panel").show();
    });
    $("#back_to_warp").click(function() {
        $("#project_nav2").slideToggle("fast");
        $("#topbar2").slideToggle("fast");
        $("#wrapper3").slideToggle("fast");
        $("#topbar").slideToggle("fast");
        $("#project_nav").slideToggle("fast");
        $("#warpContainer").fadeToggle("slow")
    });
    $("#contact_form").submit(function() {
        $.post($(this).attr("action"), $(this).serialize(), function(e) {
            if (e.status == "success") {
                $("#form_success").fadeIn()
            } else if (e.status == "failure") {
                $("#form_failure").fadeIn()
            }
        }, "json");
        $("input[type=text]").val("");
        $("input[type=email]").val("");
        $("textarea").val("");
        return false
    });
    Reveal.addEventListener("profiles", function() {
        setTimeout(function() {
            $("#monster").show().addClass("animated zoomInUp")
        }, 2e3);
        setTimeout(function() {
            $("#linkedin").show().addClass("animated zoomInLeft")
        }, 2500);
        setTimeout(function() {
            $("#angel").show().addClass("animated zoomInRight")
        }, 2500);
        setTimeout(function() {
            $("#github").show().addClass("animated zoomInLeft")
        }, 3e3);
        setTimeout(function() {
            $("#elance").show().addClass("animated zoomInRight")
        }, 3e3)
    })
})