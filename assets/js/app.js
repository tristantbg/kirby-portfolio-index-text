/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    $root = '/';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {});
            $(document).ready(function($) {
                $body = $('body');
                // History.Adapter.bind(window, 'statechange', function() {
                //     var State = History.getState();
                //     console.log(State);
                //     var content = State.data;
                //     if (content.type == 'project') {
                //         $body.addClass('project loading');
                //         app.loadContent(State.url + '/ajax', slidecontainer);
                //     }
                // });
                $(document).keyup(function(e) {
                    //esc
                    if (e.keyCode === 27) app.goIndex();
                    //left
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                    //right
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                $(window).load(function() {
                    $(".loader").fadeOut("fast");
                });
                app.fullpage();
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    //location.reload();
                    isMobile = false;
                }
            }
        },
        fullpage: function() {
            $('#wrapper').fullpage({
                //Navigation
                // menu: '#menu',
                // lockAnchors: false,
                // anchors: ['firstPage', 'secondPage'],
                // navigation: false,
                // navigationPosition: 'right',
                // navigationTooltips: ['firstSlide', 'secondSlide'],
                // showActiveTooltip: false,
                // slidesNavigation: false,
                // slidesNavPosition: 'bottom',
                //Scrolling
                scrollingSpeed: 700,
                autoScrolling: false,
                fitToSection: false,
                fitToSectionDelay: 1000,
                verticalCentered: false,
                scrollBar: false,
                lazyLoading: false,
                scrollOverflow: false,
                //Custom selectors
                sectionSelector: 'section',
                //events
                onLeave: function(index, nextIndex, direction) {},
                afterLoad: function(anchorLink, index) {},
                afterRender: function() {},
                afterResize: function() {},
                afterResponsive: function(isResponsive) {},
                afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex) {},
                onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex) {}
            });
        },
        goIndex: function() {
            // History.pushState({
            //     type: 'index'
            // }, $sitetitle, window.location.origin + $root);
        },
        loadContent: function(url, target) {
            $.ajax({
                url: url,
                success: function(data) {
                    $(target).html(data);
                }
            });
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                }
            }
        }
    };
    app.init();
});