


var agreements_index_active                     = 0;



$(function(){



    $(OBJECT_FORM).on('click', CLASS_AGREEMENT, function() {

        agreement_toggle($(this).attr('id'))

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

            if (index === 0) {
                button_next                     .addClass(ATTR_VISIBLE);
                button_next                     .addClass(ATTR_SOLO);
            } else if (index === agreements.length - 1) {
                button_previous                 .addClass(ATTR_VISIBLE);
                button_previous                 .addClass(ATTR_SOLO);
            } else {
                button_previous                 .addClass(ATTR_VISIBLE);
                button_next                     .addClass(ATTR_VISIBLE);
            }

            var translate_position              = 0;

            for (var i = 0; i < index; i++) {

                translate_position              += agreements[i].offsetWidth + SPACING_AGREEMENT;

            }

            $(OBJECT_AGREEMENTS)                .css({"transform": "translate(-" + translate_position + "px)"});

            break;
    }
}



function agreement_toggle(identifier) {

    agreement                                   = $('#' + identifier);

    if (agreement.hasClass(ATTR_ACTIVE)) {

        if (agreement.hasClass(ATTR_SELECTED)) {

            $(CLASS_AGREEMENT).each(function( index ) {

                if (!$(CLASS_AGREEMENT + '.' + ATTR_SELECTED).length) {

                    $(this)                     .prop('disabled', false);
                    $(this)                     .removeClass('disabled');
                }
            });
        } else {


            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(this).attr('data-subject') != agreement.attr('data-subject')) {

                    $(this)                     .prop('disabled', true);
                    $(this)                     .addClass('disabled');

                }
            });
        }

        agreement                               .toggleClass(ATTR_SELECTED);
    }
}


