"use strict";$(document).ready(function(){var e=$(window).width();e<769&&($(".logoandbanner-header").appendTo($("header")),$(".headline-news > .container > ul").removeClass("webview").addClass("mobileview"),$(".headline-news > .container > .mobileview").append('<li class="col-lg-4 move"></li>'),$(".headline-news > .container > .mobileview > .col-lg-4 > .content").next().appendTo($(".headline-news > .container > .mobileview > .move")),$(".headline-news > .container").addClass("full-container").removeClass("container"),$(".headline-news > .full-container > .mobileview").addClass("owl-carousel owl-theme").owlCarousel({autoplay:!0,loop:!0,margin:0,items:1,nav:!1,dots:!0}),$(".list-epapper").css("margin","0"),$(".list-epapper").addClass("owl-carousel owl-theme").owlCarousel({autoplay:!0,loop:!0,margin:0,items:1,nav:!0,dots:!1,navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]})),e>768&&$("body").niceScroll({cursorborder:"1px solid transparent",scrollspeed:200,mousescrollstep:50,horizrailenabled:!1}),AOS.init({duration:1500}),$(".owl-infografis-news").owlCarousel({autoplay:!0,loop:!0,margin:15,nav:!0,dots:!1,items:1,navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]}),$(".carousel-image").owlCarousel({loop:!0,margin:10,nav:!0,navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],dots:!1,responsive:{0:{items:3},600:{items:3},1e3:{items:4}}}),$(".navTrigger").click(function(){$(this).parent().next().next().addClass("mobile-active")}),$("#btn-search").click(function(e){e.preventDefault(),1==$(this).attr("data-click-state")?($(this).attr("data-click-state",0),$(this).html('<i class="fas fa-search"></i>'),$(this).closest(".menu-header").find(".search-form").removeClass("active")):($(this).attr("data-click-state",1),$(this).html('<i class="fas fa-times"></i>'),$(this).closest(".menu-header").find(".search-form").addClass("active"))}),e<991.98&&($(".menu-list").prepend('<li class="header"><div class="cage-image"><img src="assets/images/logo1.png"></div><button id="close-menu"><i class="fas fa-times-circle"></i></button></li>'),$(".menu-list").find("li").has("ul").addClass("child"),$(".menu-list").find("li.child > a").addClass("child-link"),$(".menu-list").find("li.child").append('<span><i class="fas fa-plus"></i></span>'),$(".menu-list").find("li.child > span").each(function(){$(this).insertAfter($(this).parent().find("a.child-link"))})),$("#close-menu").click(function(){$(this).closest(".menu-list").removeClass("mobile-active")}),$(".menu-list").find("li > ul > li").has("ul > li").addClass("child"),$(".menu-list").find("li").has("ul").find("span").click(function(){$(this).find("i").toggleClass("fa-plus fa-minus"),$(this).next().toggleClass("active"),$(this).parent().toggleClass("changed")}),$(window).scroll(function(){$(this).scrollTop()>=150?$("#return-to-top").addClass("active"):$("#return-to-top").removeClass("active")}),$("#return-to-top").click(function(e){e.preventDefault(),$("body,html").animate({scrollTop:0},1e3)})});