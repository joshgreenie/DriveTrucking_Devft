//on scroll add a .small class to the masthead
(function ($) {
    jQuery.fn.center = function () {
        this.css("position", "absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2)) + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2)) + "px");
        return this;
    };
    $(window).scroll(function () {
        var value = jQuery(this).scrollTop();
        if (value > 90) {
            // $("#masthead").addClass('small');
            // $("#masthead").removeClass("large");
        } else {
            // $("#masthead").removeClass("small");
            // $("#masthead").addClass('large');
        }
    });


    $(document).ready(function () {
        $('#hamburgler').click(function () {
            $(this).toggleClass('open');
            $('#site-navigation').toggleClass('close');
        });
        $('.login-drop').click(function (e) {
            e.preventDefault();
            $('#login-drop').slideToggle(200);
        });

        $('.profile-sub-head').click(function (e) {
            e.preventDefault();
            $('#account-drop').slideToggle(200);
        });

        var edit_team = false;
        $('.edit-team-btn').click(function (e) {
            e.preventDefault();
            var teambutton = $('.edit-team-btn');
            $('#team-form').slideToggle(300, function () {
                var formlocal = $("#edit-form").offset().top;
                if (edit_team === false) {
                    edit_team = true;
                    teambutton.text('Show Team');
                    $('html, body').animate({scrollTop: formlocal}, 300);
                } else {
                    edit_team = false;
                    teambutton.text('Edit Team');
                }
            });
            $('.players').slideToggle();
            //

        });
        /*$(function() {
         $('a[href*=#]:not([href=#])').click(function() {
         if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
         var target = $(this.hash);
         target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
         if (target.length) {
         $('html,body').animate({
         scrollTop: target.offset().top - 145
         }, 1000);
         return false;
         }
         }
         });
         });*/
        function parseVideoURL(url) {
            function getParm(url, base) {
                var re = new RegExp("(\\?|&)" + base + "\\=([^&]*)(&|$)");
                var matches = url.match(re);
                if (matches) {
                    return (matches[2]);
                } else {
                    return ("");
                }
            }

            var retVal = {};
            var matches;
            if (url.indexOf("youtube.com/watch") !== -1) {
                retVal.provider = "youtube";
                retVal.id = getParm(url, "v");
            } else if (matches = url.match(/vimeo.com\/(\d+)/)) {
                retVal.provider = "vimeo";
                retVal.id = matches[1];
            }
            return (retVal);
        }

        var attachedbackground = false;
        $('a[rel="video"]').click(function (e) {
            e.preventDefault();
            var link = $(this).data('url');
            var videoid = parseVideoURL(link);
            var lightbox = "<div class='lightbox-background'><div class='holder'><div class='icon-close'></div><div class='video-wrapper'></div></div></div>";
            if (attachedbackground === false) {
                attachedbackground = true;
                // console.log('attaching lightbox');
                $(document.body).append(lightbox);
            }
            console.log(videoid.id);
            $('.lightbox-background').animate({opacity: 1});
            $('.lightbox-background').css({display: 'block'});
            $('.video-wrapper').append('<iframe src="//player.vimeo.com/video/' + videoid.id + '?title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
            $('.close, .lightbox-background').click(function () {
                $('.lightbox-background').animate({opacity: 0}, function () {
                    $('.videoWrapper').empty();
                    $(this).css({display: 'none'});
                });
            });
            $('.holder').center();
            $(document).keyup(function (e) {
                if (e.keyCode === 27) {
                    $('.lightbox-background').animate({opacity: 0}, function () {
                        $('.videoWrapper').empty();
                        $(this).css({display: 'none'});
                    });
                }
            });
        });
        $(window).resize(function () {
            $('.holder').center();
        });

        $("#select-location, #select-driver, #select-freight").select2({
            placeholder: 'Select an option'

        });

        $("#submit-job-sort").click(function (event) {
            event.preventDefault();
            var location = $("#select-location option:selected").val();
            var type = $("#select-freight option:selected").val();
            var driver = $("#select-driver option:selected").val();

            var error = 0;

            if (location == -1) {
                $("#select-location").next('.select2-container').find('.select2-selection').css({'border-color': 'red'});
                error += 1;
            } else {
                error = 0;
            }
            if (type == -1) {
                $("#select-freight").next('.select2-container').find('.select2-selection').css({'border-color': 'red'});
                error += 1;
            } else {
                error = 0;
            }
            if (driver == -1) {
                $("#select-driver").next('.select2-container').find('.select2-selection').css({'border-color': 'red'});
                error += 1;
            } else {
                error = 0;
            }
            if (error === 0) {
                window.location.href = "/jobs/location/" + location + "/freight_type/" + type + "/driver_type/" + driver + "/";
            }
        });
        $(".apply a").click(function (event) {
            event.preventDefault();
            $(".apply-application").height($(document).height());
            $(".apply-application").fadeToggle();
            $('body').animate({scrollTop: $('.apply-application').offset().top}, 500);


            $windowHeight = $(window).height();
            $applyHeight = $(".apply-application").height();
            if ($applyHeight < $windowHeight) {
                $(".application").height($windowHeight - 20);
            }

        });
        $(".write-review").click(function (event) {
            event.preventDefault();
            $(".apply-application").height($(document).height());
            $(".apply-application").fadeToggle();
            $('body').animate({scrollTop: $('.apply-application').offset().top}, 500);

        });
        $(".gform_button").click(function (event) {
            $('body').animate({scrollTop: $('.apply-application').offset().top}, 500);

        });
        $(".close-button").click(function (event) {
            event.preventDefault();
            $('.apply-application').fadeToggle();
        });

    });
})(jQuery);
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};