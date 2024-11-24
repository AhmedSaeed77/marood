/*global $, alert, console */


var $affectedElements = $("p, h1, h2, h3, h4, h5, h6, li, a"); // Can be extended, ex. $("div, p, span.someClass")

// Storing the original size in a data attribute so size can be reset
$affectedElements.each(function() {
    var $this = $(this);
    $this.data("orig-size", $this.css("font-size"));
});

$("#btn-increase").click(function() {
    changeFontSize(1);
})

$("#btn-decrease").click(function() {
    changeFontSize(-1);
})


function changeFontSize(direction) {
    $affectedElements.each(function() {
        var $this = $(this);
        $this.css("font-size", parseInt($this.css("font-size")) + direction);
    });
}


/* ===============================  Smooth scroll into second section  =============================== */

$('.smoothscroll').on('click', function() {

    $('html, body').animate({

        scrollTop: $($(this).attr('href')).offset().top
    }, 1000, 'easeInOutExpo')
})

/* ===============================  show and hide answer  =============================== */

$('.qa_wrapper .q').on('click', function() {
    $(this).parent().find('.answer').toggleClass('show');
})

$('.question span').on('click', function() {
    $(this).parent().find('.answer').toggleClass('show');
})



/*================================== hide and show options_button ======================================*/

$('.options_button.settings').on('click', function() {
    $(this).find('#options').toggle();
})

/* ===============================  venobox  =============================== */
$('.venobox').venobox({
    bgcolor: '',
    overlayColor: 'rgba(6, 12, 34, 0.85)',
    closeBackground: '',
    closeColor: '#fff'
});


/* =============================== input radio =============================== */

$('input:radio[name="price"]').change(
    function() {
        if (this.checked && this.value == 'false') {
            $('#priceInput').hide();
        } else if (this.checked && this.value == 'true') {
            $('#priceInput').show();
        }
    }
);

$('input:radio[name="typeOfPost"]').change(
    function() {
        if (this.checked && this.value == '1') {
            $('#sellCar').removeClass("d-none")
            $("#installment").addClass('d-none')

        } else if (this.checked && this.value == '2') {
            $("#installment").removeClass('d-none')
            $('#sellCar').addClass("d-none")
        }
    }
);

/* =============================== dropdown in navbar after login =============================== */

$('.header-login .user-actions span').on('click', function() {
    $(this).parent().find('.dropdown').toggleClass('d-none')
})


/* =============================== Settings of QR Modal =============================== */
$('#ModalQR .control-btns button').on('click', function(e) {

    e.preventDefault();

    $(this).addClass('active').siblings().removeClass('active');

    var id = $(this).attr('data-content')

    $('#ModalQR .box-content[id="' + id + '"]').addClass('active').siblings().removeClass('active')

    console.log(id)

})





/* =============================== Settings of QR Modal =============================== */
$('.tag-filters__item').on('click', function(e) {

    e.preventDefault();

    // $('.main-content .box-content').toggleClass('active');
    $('.postOneImage, .PostImagesCarousel').toggleClass('d-none');

})

/* ===============================  question carousel  =============================== */
$(".main-content  .owl-carousel").owlCarousel({
    autoplay: false,
    nav: true,
    dots: true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    loop: true,
    items: 1
});


/* ===============================  showBoxSearch  =============================== */
function showBoxSearch() {
    document.querySelector('.react-autosuggest__container').classList.toggle('show')
}


/* ===============================  dropdown =============================== */
$('.dropdown-btn').on('click', function() {
    $(this).parent('.toolbar').find('.dropdown').toggleClass('show');
})





/* ===============================  خيارات اضافية =============================== */

$('.add-chooses').on('click', function() {
    $(this).find('.ddm_wrapper').toggleClass('show')
})


$('.add-chooses .ddm_option.map').on('click', function(e) {
    e.stopPropagation();
    var text = $('.add-chooses .ddm_option.map').text();
    $('.add-chooses .ddm_option.map').text(
        text == "اخفاء على الخريطه" ? "إظهار على الخريطه" : "اخفاء على الخريطه");
});



/* ===============================  settings of fav icon =============================== */

// $('.fav-btn').on('click', function() {
//     $(this).toggleClass('toggle');
//     var fav = $(this).find('.num')
//     var numFav = fav.text();

//     if ($(this).hasClass('toggle')) {
//         var sum = parseInt(numFav) - 1;
//     } else {
//         var sum = parseInt(numFav) + 1;
//     }
//     fav.text(sum);

// })


$('.add_rate_wrapper .ask_wrapper .options_wrapper_type2 .option').on('click', function() {
    $(this).addClass('active').siblings().removeClass('active')
})

$('.options_wrapper label').on('click', function() {
    $(this).addClass('active').siblings().removeClass('active')
})

$(".h_input").keyup(function() {
    var value = $(this).val();
    if (value.length > 0 && value != "Default text") {

    } else {
        console.log('no')
    }
})

$('.btn-location').on('click', function() {
    $(this).parent().find('.ddm_wrapper').toggleClass('d-none');
})


$('.show_filter').on('click', function() {
    $(this).toggleClass('active');
    $('.remove-filter').toggleClass('d-none');
})

$('.show_filter_2').on('click', function() {
    $(this).toggleClass('active');
})

$('.remove-filter').on('click', function() {
    $(this).addClass('d-none');
    $('.show_filter').toggleClass('active')
})


var my_svg = $('#qr_download'),
    value_svg = my_svg.html();
    
function downloadSVG() {
    let svgData = `${value_svg}`;

    /// Create a fake <a> element
    let fakeLink = document.createElement("a");
    /// Add image data as href
    fakeLink.setAttribute('href', 'data:image/svg+xml;base64,' + window.btoa(svgData));
    /// Add download attribute
    fakeLink.setAttribute('download', 'imageName.svg');
    /// Simulate click
    fakeLink.click();

}

    /* ===============================  slick slider  =============================== */
    
    /* ===============================  banner carousel  =============================== */
    $(".banner__slider .owl-carousel").owlCarousel({
        autoplay: true,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        loop: true,
        items: 1
    });
    
    $('.sideToggleIcon').on('click', function() {
        $('.marks-side').slideToggle();
     })




// $('.home-content .tagMain .list-catig ul .tab').on('click', function() {
//     $('.show_marka:not([data-main_cat="4"])').hide();
// })

;
