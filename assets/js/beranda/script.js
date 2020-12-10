/*!
    * Start Bootstrap - Creative v6.0.3 (https://startbootstrap.com/themes/creative)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
    */
(function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 72)
                }, 1500, "easeInOutExpo");
                return false;
            }
        }
    });
    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        $('.navbar-collapse').collapse('hide');
    });
    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: 75
    });
    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-scrolled");
        } else {
            $("#mainNav").removeClass("navbar-scrolled");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

    // Magnific popup calls
    $('#portfolio').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });

})(jQuery); // End of use strict


$(window).on('load', function () {
    $('.uty').addClass('uty-go');
});

$(window).scroll(function () {
    var wScroll = $(this).scrollTop();
    // console.log(wScroll);
    // about
    if (wScroll > $('.about').offset().top - 500) {
        $('.head-about').addClass('head-about-go');
    }
    if (wScroll > $('.about').offset().top - 400) {
        $('.content-about').addClass('content-about-go');
    }

    // services
    if (wScroll > $('.services').offset().top - 370) {
        $('.head-services').addClass('head-services-go');
    }
    if (wScroll > $('.services').offset().top - 350) {
        $('.card-1').addClass('card-1-go');
    }
    if (wScroll > $('.services').offset().top - 300) {
        $('.card-2').addClass('card-2-go');
    }
    if (wScroll > $('.services').offset().top - 250) {
        $('.card-3').addClass('card-3-go');
    }

    // contact
    if (wScroll > $('.contact').offset().top - 500) {
        $('.head-contact').addClass('head-contact-go');
    }
    if (wScroll > $('.contact').offset().top - 450) {
        $('.alamat').addClass('alamat-go');
    }
    if (wScroll > $('.contact').offset().top - 400) {
        $('.hp').addClass('hp-go');
    }
    if (wScroll > $('.contact').offset().top - 420) {
        $('.email').addClass('email-go');
    }
    if (wScroll > $('.contact').offset().top - 380) {
        $('.maps').addClass('maps-go');
    }
});



$(document).keypress(
    function (event) {
        if (event.which == '13') {
            event.preventDefault();
        }
    });

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
var currentTab = 0;

$(".next").click(function () {
    if (validateForm()) {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = now * 50 + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });

                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
        currentTab += 1;
    }
});

$(".previous").click(function () {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({
        opacity: 0
    }, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = (1 - now) * 50 + "%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
                'left': left
            });
            previous_fs.css({
                'transform': 'scale(' + scale + ')',
                'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
    currentTab -= 1;
});

$(".submit").click(function () {
    var submit = false;
    if (validateForm()) {
        submit = true;
    };
    return submit;
});

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    z = x[currentTab].getElementsByTagName("select");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            if (y[i].className != "invalid") {
                y[i].className = "form-control is-invalid invalid";
            }
            // and set the current valid status to false
            valid = false;
        } else {
            y[i].className = "form-control is-valid";
        }
    }

    for (i = 0; i < z.length; i++) {
        // If a field is empty...
        if (z[i].value == "0" && !$("span#cek2").hasClass("disable-select")) {
            // add an "invalid" class to the field:
            if (z[i].className != "invalid") {
                z[i].className = "form-control is-invalid invalid";
            }
            // and set the current valid status to false
            valid = false;
        } else {
            z[i].className = "form-control is-valid";
        }
    }
    return valid; // return the valid status
}

function ConfirmPW() {
    pw1 = $('input#pw1').val();
    pw2 = $('input#pw2').val();
    $(".Confirm-pw").text("");

    if (pw1 != pw2) {
        $(".Confirm-pw").text("Konfirmasi password salah!");
    }
}


function CekInput() {
    a = $("select#cek option").filter(":selected").val();
    console.log(a);
    if (a == 1) {
        $("span#cek2").attr("class", "");
    } else if (a == 2) {
        $("span#cek2").attr("class", "");
    } else {
        $("span#cek2").attr("class", "disable-select");
    }
}
