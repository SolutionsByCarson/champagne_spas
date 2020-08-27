import Bootstrap from '../../node_modules/bootstrap/js/src/index';

// START JQUERY
jQuery(function($) {

    $(document).ready(function () {
        var cards = $('#section_features_a .feature-card');
        var height = 0;
        var change = false;
        cards.each(function(){
            var this_height = $(this).find('.head').outerHeight();
            if (this_height > height){
                height = this_height;
                change = true;
            }
        });
        if (change == true){
            cards.find('.head').css('height', height);
        }
    });

    // get header vars
    let navHeight = $('#site_nav').outerHeight();


    // Apply sticky header
    $(window).scroll(function(){

        //store navHeight
        navHeight = $('#site_nav').outerHeight();

       if ($(this).scrollTop() > 0){
           $('#site_nav').addClass('sticky');
           $('body').addClass('stickyNav');
       } else {
           $('#site_nav').removeClass('sticky');
           $('body').removeClass('stickyNav');
       }
    });

    $('#site_nav button.navbar-toggler').on('click', function() {
        setTimeout(function(){
            if ($('#site_nav .navbar-collapse').hasClass('show')){
                $('#site_nav').addClass('mobile-menu-open');
            } else {
                $('#site_nav').removeClass('mobile-menu-open');
            }
        }, 450);
    });


    $(document).ready(function(){
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {

                if ($('#site_nav').hasClass('mobile-menu-open')){
                    $('#site_nav.mobile-menu-open .navbar-toggler').click();
                }

                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                if (hash == "#"){
                    var goTop = 0;
                } else {
                    var goTop = $(hash).offset().top - 56;
                }

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: goTop
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
            $(".navbar-collapse.collapse.show a.nav-link").on('click', function (event) {
                $('#top_nav').modal('hide');
            });
        });
    });
    $(".navbar-collapse.collapse.show a.nav-link").on('click', function (event) {
        $('#top_nav').modal('hide');
    });



    // DESIGN SLIDE ANIMATIONS

    // ON MOBILE - JUMP TO SLIDES IN ACCORDION
    function jumpToSlide(num) {

        if ($(window).width() <= 786) {
            // get vars
            var tabOffset = $('.option-slide[data-order="' + num + '"]').offset().top;
            var tabHeight = $('.option-slide[data-order="' + num + '"] .option-slide-header').outerHeight();
            var goTop = tabOffset - tabHeight - 51;

            $('html, body').animate({
                scrollTop: goTop
            }, 300);
        }
    }

    // BUILD SELECTIONS
    $('#get_vals').on('click',function(){
       buildSelections();
    });

    function buildSelections(){

        var return_val = "";

        // get all slides
        var slides = $('.option-slide');

        // loop through slides
        $.each(slides, function(){

            // get option id + name
            var id = $(this).attr('id');
            var input_id = id.replace('option_','') + '_val';
            // alert (input_id);
            var title = $(this).attr('data-title');
            var name = id.replace('option_','');

            // add name to return_val
            return_val ='';

            // get variant input fields
            var variants = $('input[name="' + name + '"]');

            // loop through variant
            $.each(variants, function(){
               
                // add to return_val if checked
                if ($(this).prop('checked')){
                    return_val = return_val + $(this).val() + ", ";
                }

            });

            // remove last comma space
            return_val = return_val.slice(0,-2);

            // add input value to
            $('#' + input_id).val(return_val);
        });

    }



    // SELECT DESIGN ITEM CHECKBOX
    $('.option-slide-option').on('click', function(event){

        event.preventDefault();

        // get input
        var input = $(this).find('input.design-option-input');
        var input_state = input.prop("checked");
        var input_val = input.val();
        var field_name = input.attr('name');
        var field_class = ".option-" + field_name;

        // if radio, uncheck others inputs
        if (input.hasClass('radio')){
            $(field_class).find('input.design-option-input').prop('checked', false);
            $(field_class).removeClass('checked');
        }

        // if checked, uncheck
        if (input_state == true){
            input.prop('checked', false);
            $(this).removeClass('checked');
        } else {
            input.prop('checked', true);
            $(this).addClass('checked');
        }

        // if radio, go to next slide
        if (input.hasClass('radio')){
            option_next_slide();
        }

        // build selections
        buildSelections();

        // show hide filter_by
        var o_filter_by = 'filter-by-' + input.attr('name');
        var v_filter_by = input.attr('data-id');
        var o_filter_fields = $('.option-slide[data-filter="' + o_filter_by + '"]');

        // if there is a filter_by option - hide all non-related fields
        if (o_filter_fields.length){
            o_filter_fields.find('.option-slide-option').hide();
            o_filter_fields.find('.option-slide-option[data-filter="' + v_filter_by + '"]').show();
        }

    });



    // DESIGN HEADER - OPEN ACCORDION
    $('.option-slide-header').on('click',function(){
        if (!$(this).parent().hasClass('current')){

            console.log('option slide header');

            // hide previous slide
            $('.option-slide.current').addClass('previous').removeClass('current');

            // hide previous tab
            $('.option-slide-tab').removeClass('current');

            // activate next slide
            var nextSlide = $(this).parent().attr('data-order');
            $('.option-slide[data-order="' + nextSlide + '"]').addClass('current');
            $('.option-slide-tab[data-order="' + nextSlide + '"]').addClass('current');

            // update slide number on outer container
            $('.option-slides').attr('data-current',nextSlide);

            jumpToSlide(nextSlide);
            $('.option-slide.previous').removeClass('previous');

        }
    });


    // next slide function
    function option_next_slide(){

        console.log('move to next slide');

        // get slide numbers
        var currSlide = parseInt($('.option-slides').attr('data-current'));
        var nextSlide = currSlide + 1;
        var maxSlide = parseInt($('.option-slides').attr('data-max'));

        // if not over max, go to next slide
        if (nextSlide <= maxSlide){

            // hide previous slide
            $('.option-slide.current').addClass('previous').removeClass('current');

            // hide previous tab
            $('.option-slide-tab').removeClass('current');

            // activate next slide
            $('.option-slide[data-order="' + nextSlide + '"]').addClass('current');
            $('.option-slide-tab[data-order="' + nextSlide + '"]').addClass('current');

            // update slide number on outer container
            $('.option-slides').attr('data-current',nextSlide);

            jumpToSlide(nextSlide);
            $('.option-slide.previous').removeClass('previous');


        }
    }


    // previous slide function
    function option_prev_slide(){

        console.log('move to prev slide');

        // get slide numbers
        var currSlide = parseInt($('.option-slides').attr('data-current'));
        var nextSlide = currSlide - 1;

        // if not over max, go to next slide
        if (nextSlide > 0){

            // hide previous slide
            $('.option-slide.current').addClass('previous').removeClass('current');

            // hide previous tab
            $('.option-slide-tab').removeClass('current');

            // activate next slide
            $('.option-slide[data-order="' + nextSlide + '"]').addClass('current');
            $('.option-slide-tab[data-order="' + nextSlide + '"]').addClass('current');

            // update slide number on outer container
            $('.option-slides').attr('data-current',nextSlide);

            jumpToSlide(nextSlide);
            $('.option-slide.previous').removeClass('previous');


        }
    }

    // NEXT SLIDE BTN
    $('.option-slide-next').on('click', function(){
        console.log('next slide button');
        option_next_slide();
    });

    // PREV SLIDE BTN
    $('.option-slide-prev').on('click', function(){
        console.log('prev slide button');
        option_prev_slide();
    });

    // TAB JUMP
    $('.option-slide-tab').on('click', function(){

        console.log('option slide tab');

        // get nextSlide number
        var nextSlide = $(this).attr('data-order');

        // hide previous slide
        $('.option-slide.current').addClass('previous').removeClass('current');

        // hide previous tab
        $('.option-slide-tab').removeClass('current');

        // activate next slide
        $('.option-slide[data-order="' + nextSlide + '"]').addClass('current');
        $('.option-slide-tab[data-order="' + nextSlide + '"]').addClass('current');

        // update slide number on outer container
        $('.option-slides').attr('data-current',nextSlide);

        jumpToSlide(nextSlide);
        $('.option-slide.previous').removeClass('previous');


    });



});