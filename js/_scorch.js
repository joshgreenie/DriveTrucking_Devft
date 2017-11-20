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

        var targets = $('#isotope-select select');

        targets.each(function () {
            const $thisID = $(this).attr('name');
            const $thisOption = $(this).find('option');
            const $thisOptionValue = $(this).find('option').attr('value');
            const $thisOptionFirst = $(this).find('option:first-child');

            $(this).attr('data-filter-group', '.' + $thisID );

            $thisOption.each(function () {
                const $optValue = $(this).attr('value');
                $(this).attr('data-filter-value', '.' + $thisID + '-' + $optValue);
            });
            $thisOptionFirst.attr('data-filter-value', '');
        });

        var itemSelector = '.jobs.type-jobs',
            filters = {};

        var $container = $('#isotope-container').isotope({
            itemSelector: itemSelector,

        });

        //Ascending order
        var responsiveIsotope = [
            [500, 4],
            [768, 8]
        ];

        var itemsPerPageDefault = 10;
        var $selects = $('#isotope-select select');
        var $checkboxes = $('#isotope-select .custom-check input');
        // var $checkboxWrapper = $('#isotope-select .custom-check');
        var itemsPerPage = defineItemsPerPage();
        var currentNumberPages = 1;
        var currentPage = 1;
        var currentFilter = '*';
        var filterAtribute = 'data-filter';
        var pageAtribute = 'data-page';
        var pagerClass = 'isotope-pager';
        var pagerClassBottom = 'isotope-pager-bottom';
        var filterAtributeGroup = 'data-filter-group';



        function changeFilter(selector) {
            $container.isotope({
                filter: selector
            });
        }

        function goToPage(n) {
            currentPage = n;
            var exclusives = [];
            var inclusives = [];
            $selects.each( function( ) {
                var $this = $(this);
                var selectValue = $this.find(':selected').attr('data-filter-value');
                exclusives.push( selectValue )
            });
            $checkboxes.each( function( i, elem ) {
                var checkValue = $(this).attr('data-filter-value');
                // if checkbox, use value if checked
                if ( elem.checked ) {
                    inclusives.push( checkValue );
                }
            });
            exclusives = exclusives.join('');
            exclusives += '['+pageAtribute+'="'+currentPage+'"]';
            var currentFilter;
            if ( inclusives.length ) {
                currentFilter = $.map( inclusives, function( value ) {
                    return value + exclusives;
                });
                currentFilter = currentFilter.join(', ');
            } else {
                currentFilter = exclusives;
            }
            var selector = itemSelector;
            selector += ( currentFilter != '*' ) ? currentFilter : '';
            // console.log(selector);
            changeFilter(selector);
        }




        function defineItemsPerPage() {
            var pages = itemsPerPageDefault;
            for( var i = 0; i < responsiveIsotope.length; i++ ) {
                if( $(window).width() <= responsiveIsotope[i][0] ) {
                    pages = responsiveIsotope[i][1];
                    break;
                }
            }
            return pages;
        }

        function setPagination() {
            var SettingsPagesOnItems = function(){

                var itemsLength = $container.children(itemSelector).length;
                var pages = Math.ceil(itemsLength / itemsPerPage);
                var item = 1;
                var page = 1;
                var exclusives = [];
                var inclusives = [];

                $selects.each( function( ) {
                    var $this = $(this);
                    var selectValue = $this.find(':selected').attr('data-filter-value');
                    exclusives.push( selectValue )
                });

                $checkboxes.each( function( i, elem ) {
                    var $value = $(this).attr('data-filter-value');
                    // if checkbox, use value if checked
                    if ( elem.checked ) {
                        inclusives.push( $value );
                    }
                });

                exclusives = exclusives.join('');

                var currentFilter;
                if ( inclusives.length ) {
                    currentFilter = $.map( inclusives, function( value ) {
                        return value + exclusives;
                    });
                    currentFilter = currentFilter.join(', ');
                } else {
                    currentFilter = exclusives;
                }

                var selector = itemSelector;
                selector += ( currentFilter != '*' ) ? currentFilter : '';
                $container.children(selector).each(function(){
                    if( item > itemsPerPage ) {
                        page++;
                        item = 1;
                    }
                    $(this).attr(pageAtribute, page);
                    item++;
                });

                if($container.children(selector).length == 0){
                    $container.find('h2.heading.main').addClass('active');
                    $('[class*=isotope-pager]').addClass('no-results');
                } else {
                    $container.find('h2.heading.main').removeClass('active');
                    $('[class*=isotope-pager][class*=no-results]').removeClass('no-results');
                }

                currentNumberPages = page;
            }();

            var CreatePagers = function() {
                var $isotopePager = ( $('.'+pagerClass).length == 0 ) ? $('<div class="'+pagerClass+'"></div>') : $('.'+pagerClass);
                var $isotopePagerBottom = ( $('.'+pagerClassBottom).length == 0 ) ? $('<div class="'+pagerClassBottom+'"></div>') : $('.'+pagerClassBottom);
                $isotopePager.html('');
                $isotopePagerBottom.html('');
                for( var i = 0; i < currentNumberPages; i++ ) {
                    var $pager = $('<a href="javascript:void(0);" class="pager" '+pageAtribute+'="'+(i+1)+'"></a>');
                    $pager.html(i+1);
                    $pager.click(function(){
                        var page = $(this).eq(0).attr(pageAtribute);
                        var data = $(this).data('page');
                        // $(this).addClass('page-'+data);
                        $('[class*=isotope-pager] a.active').removeClass('active');
                        $('[class*=isotope-pager] a[data-page="'+data+'"]').addClass('active');
                        $(this).addClass('active');
                        goToPage(page);
                    });
                    $pager.appendTo($isotopePager);
                }
                for( var j = 0; j < currentNumberPages; j++ ) {
                    var $pager2 = $('<a href="javascript:void(0);" class="pager" '+pageAtribute+'="'+(j+1)+'"></a>');
                    $pager2.html(j+1);
                    $pager2.click(function(){
                        var page2 = $(this).eq(0).attr(pageAtribute);
                        var data2 = $(this).data('page');
                        // $(this).addClass('page-'+data);
                        $('[class*=isotope-pager] a.active').removeClass('active');
                        $('[class*=isotope-pager] a[data-page="'+data2+'"]').addClass('active');
                        $(this).addClass('active');
                        goToPage(page2);
                    });
                    $pager2.appendTo($isotopePagerBottom);
                }
                $container.before($isotopePager);
                $container.after($isotopePagerBottom);
                var $main = $('.tax-location main#main');
                var pagerHeight = $isotopePager.outerHeight() + 10;
                var pagerBottomHeight = $isotopePagerBottom.outerHeight() + 10;
                $main.css('padding-top', pagerHeight);
                $main.css('padding-bottom', pagerBottomHeight);
                $('[class*=isotope-pager] a:first-child').addClass('active');
            }();
        }
        setPagination();
        goToPage(1);

        $selects.add( $checkboxes ).change( function() {

            var exclusives = [];
            var inclusives = [];

            $selects.each( function( ) {
                var $this = $(this);
                var selectValue = $this.find(':selected').attr('data-filter-value');
                exclusives.push( selectValue )
            });

            $checkboxes.each( function( i, elem ) {
                var checkValue = $(this).attr('data-filter-value');
                // if checkbox, use value if checked
                if ( elem.checked ) {
                    inclusives.push( checkValue );
                }
            });

            exclusives = exclusives.join('');

            var currentFilter;
            if ( inclusives.length ) {
                currentFilter = $.map( inclusives, function( value ) {
                    return value + exclusives;
                });
                currentFilter = currentFilter.join(', ');
            } else {
                currentFilter = exclusives;
            }

            setPagination();
            goToPage(1);
        });


        $(window).resize(function(){
            itemsPerPage = defineItemsPerPage();
            setPagination();
            goToPage(1);
        });



        ///////////////////////////////////////////
        //////////     Tables      ////////////////
        ///////////////////////////////////////////

        $('.table-wrapper.closed .table-content').hide();
        $('.table-wrapper h3.table-title').on("click", function () {
            $(this).toggleClass('active');
            $(this).next('.table-content').slideToggle();
        });



        $('.owl-carousel-content').owlCarousel({
            dots: true,
            autoplay: false,
            items: 4,
            nav: true,
            navText: ["<span class='arrow left'></span>", "<span class='arrow right'></span>"],
            responsive: {
                0: {
                    items: 1,
                },
                500: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                980: {
                    items: 3,
                },
                1200: {
                    items: 4,
                },
            }
        });
    });



    $(document).ready(function () {

        $('input[value="Ship Within 3 Business Days|5"]').closest('li.gfield').addClass('gfield_visibility_hidden');

        jQuery("#gform_XX").attr("target", "_blank");

        $('input#user_login').attr("placeholder", "Username");
        $('input#user_pass').attr("placeholder", "Password");

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

        $("#select-location, #select-driver, #select-freight, #select-run").select2({
            placeholder: 'Select an option'
        });

        $(".custom-select.select2").select2({
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