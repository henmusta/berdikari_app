"use strict";$(document).ready(function(){var i=$(window).width();i>768&&$("body").niceScroll({cursorborder:"1px solid transparent",scrollspeed:200,mousescrollstep:50,horizrailenabled:!1}),AOS.init({duration:1500}),$(".owl-carousel-news-list").owlCarousel({loop:!0,margin:15,nav:!0,dots:!1,navText:[],responsive:{0:{items:2},600:{items:3},1e3:{items:4}}}),$(".owl-infografis-news").owlCarousel({loop:!0,margin:15,nav:!0,dots:!1,navText:[],responsive:{0:{items:1.5},600:{items:2.5},1e3:{items:3.5}}}),$(".carousel-image").owlCarousel({loop:!0,margin:10,nav:!0,navText:[],dots:!1,responsive:{0:{items:3},600:{items:3},1e3:{items:4}}}),$(".navTrigger").click(function(){$(this).parent().next().addClass("mobile-active")}),i<991.98&&($(".menu-list").prepend('<li class="header"><div class="cage-image"><img src="uploads/logo.png"></div><button id="close-menu"><i class="fas fa-times-circle"></i></button></li>'),$(".menu-list").find("li").has("ul").addClass("child"),$(".menu-list").find("li.child > a").addClass("child-link"),$(".menu-list").find("li.child").append('<span><i class="fas fa-plus"></i></span>'),$(".menu-list").find("li.child > span").each(function(){$(this).insertAfter($(this).parent().find("a.child-link"))})),$("#close-menu").click(function(){$(this).closest(".menu-list").removeClass("mobile-active")}),$(".menu-list").find("li > ul > li").has("ul > li").addClass("child"),$(".menu-list").find("li").has("ul").find("span").click(function(){$(this).find("i").toggleClass("fa-plus fa-minus"),$(this).next().toggleClass("active"),$(this).parent().toggleClass("changed")}),$(window).scroll(function(){$(this).scrollTop()>=150?$("#return-to-top").addClass("active"):$("#return-to-top").removeClass("active")}),$("#return-to-top").click(function(e){e.preventDefault(),$("body,html").animate({scrollTop:0},1e3)})});