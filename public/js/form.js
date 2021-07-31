


var agreements_index_active                     = 0;



$(function(){



    $(OBJECT_FORM).on('click', CLASS_AGREEMENT, function() {

        agreement_toggle_selected($(this).attr('id'))

    });



    $(OBJECT_FORM).on('click', OBJECT_BUTTON_PREVIOUS, function() {

        agreements_set_active(agreements_index_active - 1);

    });

    $(OBJECT_FORM).on('click', OBJECT_BUTTON_NEXT, function() {

        agreements_set_active(agreements_index_active + 1);

    });



});





function agreements_load(host) {

    agreements                                  = $('.agreements');
    agreements                                  .animate({opacity: 0}, 200);

    setTimeout(function(){

        agreements.load('/load/agreements', {

            user:                               host

        }).animate({opacity: 1}, 200);

    }, 200);
}



function agreements_set_active(index) {

    agreements_index_active                     = index;

    agreements                                  = $(CLASS_AGREEMENT);
    buttons                                     = $(CLASS_BUTTON);

    button_previous                             = $(OBJECT_BUTTON_PREVIOUS);
    button_next                                 = $(OBJECT_BUTTON_NEXT);

    agreements                                  .removeClass(ATTR_ACTIVE);
    buttons                                     .removeClass(ATTR_VISIBLE);
    buttons                                     .removeClass(ATTR_SOLO);

    switch (agreements.length) {

        case 0:
            // TODO: SHOW "NO AGREEMENTS"
            break;

        case 1:
            agreements.first()                  .addClass(ATTR_ACTIVE);
            break;

        default:
            agreement                           = agreements.get(index);
            agreement                           .classList.add(ATTR_ACTIVE);

            agreements_render(true);

            break;
    }
}



function agreements_render(movement = false) {

    if (agreements_index_active === 0) {
        button_next                     .addClass(ATTR_VISIBLE);
        button_next                     .addClass(ATTR_SOLO);
    } else if (agreements_index_active === agreements.length - 1) {
        button_previous                 .addClass(ATTR_VISIBLE);
        button_previous                 .addClass(ATTR_SOLO);
    } else {
        button_previous                 .addClass(ATTR_VISIBLE);
        button_next                     .addClass(ATTR_VISIBLE);
    }

    var translate_position              = 0;

    for (var i = 0; i < agreements_index_active; i++) {

        translate_position              += agreements[i].offsetWidth + SPACING_AGREEMENT;

    }

    if (!movement) {

        $(OBJECT_AGREEMENTS)            .css({"transition": "none"});

    }

    $(OBJECT_AGREEMENTS)                .css({"transform": "translate(-" + translate_position + "px)"});

    if (!movement) {

        $(OBJECT_AGREEMENTS)            .css({"transition": "opacity .4s ease"});

    }
}



function agreement_toggle_selected(identifier) {

    agreement                                   = $('#' + identifier);

    if (agreement.hasClass(ATTR_ACTIVE)) {

        if (agreement.hasClass(ATTR_SELECTED)) {

            agreement                           .removeClass(ATTR_SELECTED);

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(CLASS_AGREEMENT + '.' + ATTR_SELECTED).length == 0) {

                    //$(this)                     .prop('disabled', false);
                    $(this)                     .removeClass('disabled');
                }
            });

        } else {

            agreement                           .addClass(ATTR_SELECTED);

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(this).attr('data-subject') != agreement.attr('data-subject')) {

                   // $(this)                     .prop('disabled', true);
                    $(this)                     .addClass('disabled');

                }
            });
        }
    }

    agreements_render();
}


