


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
            agreement                           = agreements.get(agreements_index_active);
            agreement                           .classList.add(ATTR_ACTIVE);

            agreements_render();

            break;
    }
}



function agreements_render() {

    agreements_enabled                          = $(CLASS_AGREEMENT + ':not(.' + ATTR_DISABLED + ')');

    agreements_enabled_index_active             = agreements_index_active;

    for (var x = 0; x < agreements_index_active; x++) {

        if (agreements[x].classList.contains(ATTR_DISABLED)) {

            agreements_enabled_index_active--;

        }
    }


    if (agreements_enabled_index_active === 0) {

        button_next                             .addClass(ATTR_VISIBLE);
        button_next                             .addClass(ATTR_SOLO);

    } else if (agreements_enabled_index_active === agreements_enabled.length - 1) {

        button_previous                         .addClass(ATTR_VISIBLE);
        button_previous                         .addClass(ATTR_SOLO);

    } else {

        button_previous                         .addClass(ATTR_VISIBLE);
        button_next                             .addClass(ATTR_VISIBLE);

    }

    console.log(agreements_index_active);
    console.log(agreements_enabled_index_active);
    console.log(agreements);
    console.log(agreements_enabled);

    var translate_position                      = 0;

    for (var i = 0; i < agreements_enabled_index_active; i++) {

        translate_position                      += agreements_enabled[i].offsetWidth + SPACING_AGREEMENT;

    }

    $(OBJECT_AGREEMENTS)                        .css({"transform": "translate(-" + translate_position + "px)"});
}



function agreement_toggle_selected(identifier) {

    agreement                                   = $('#' + identifier);

    if (agreement.hasClass(ATTR_ACTIVE)) {

        if (agreement.hasClass(ATTR_SELECTED)) {

            agreement                           .removeClass(ATTR_SELECTED);

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(CLASS_AGREEMENT + '.' + ATTR_SELECTED).length == 0) {

                    //$(this)                     .prop(ATTR_DISABLED, false);
                    $(this)                     .removeClass(ATTR_DISABLED);
                }
            });

        } else {

            agreement                           .addClass(ATTR_SELECTED);

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(this).attr('data-subject') != agreement.attr('data-subject')) {

                    //$(this)                     .prop(ATTR_DISABLED, true);
                    $(this)                     .addClass(ATTR_DISABLED);

                }
            });
        }
    }

    agreements_render()
}


