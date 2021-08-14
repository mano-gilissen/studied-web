


const HOST_NONE                                 = "";

var agreements_index_active                     = 0;
var lastTriggerNoInput                          = false;
var dots_selected                               = {};



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



    $(OBJECT_FORM).on('click', CLASS_DOT, function() {

        dot_click($(this));

    });

    $(OBJECT_FORM).on('mouseenter', CLASS_DOT, function() {

        dot_enter($(this));

    });

    $(OBJECT_FORM).on('mouseleave', CLASS_DOT, function() {

        dot_leave($(this));

    });



});





function agreements_load(host) {

    if (host == HOST_NONE && lastTriggerNoInput) {

        return false;

    }

    lastTriggerNoInput                          = host == HOST_NONE;

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
    agreements                                  .removeClass(ATTR_ACTIVE);

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

            agreements_render(true);

            break;
    }
}



function agreements_render(movement = false) {

    buttons                                     = $(CLASS_BUTTON);

    button_previous                             = $(OBJECT_BUTTON_PREVIOUS);
    button_next                                 = $(OBJECT_BUTTON_NEXT);

    buttons                                     .removeClass(ATTR_VISIBLE);
    buttons                                     .removeClass(ATTR_SOLO);

    agreements_enabled                          = $(CLASS_AGREEMENT + ':not(.' + ATTR_DISABLED + ')');
    agreements_enabled_index_active             = agreements_index_active;

    for (var x = 0; x < agreements_index_active; x++) {

        if (agreements[x].classList.contains(ATTR_DISABLED)) {

            agreements_enabled_index_active--;

        }
    }

    if(agreements_enabled.length > 1) {

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
    }

    var translate_position                      = 0;

    for (var i = 0; i < agreements_enabled_index_active; i++) {

        translate_position                      += agreements_enabled[i].offsetWidth + SPACING_AGREEMENT;

    }

    if (!movement) {

        $(OBJECT_AGREEMENTS)                    .css({"transition": "none"});

    }

    $(OBJECT_AGREEMENTS)                        .css({"transform": "translate(-" + translate_position + "px)"});

    if (!movement) {

        setTimeout(function(){

            $(OBJECT_AGREEMENTS)                .css({"transition": "transform .4s ease"});

        }, 400);
    }
}



function agreement_toggle_selected(id) {

    agreement                                   = $('#' + id);

    if (agreement.hasClass(ATTR_ACTIVE)) {

        if (agreement.hasClass(ATTR_SELECTED)) {

            agreement                           .removeClass(ATTR_SELECTED);
            agreement.find('input')[0].value    = '';

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(CLASS_AGREEMENT + '.' + ATTR_SELECTED).length == 0) {

                    $(this)                     .removeClass(ATTR_DISABLED);

                }
            });

        } else {

            agreement                           .addClass(ATTR_SELECTED);
            agreement.find('input')[0].value    = agreement.attr('id');

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(this).attr('data-subject') != agreement.attr('data-subject')) {

                    $(this)                     .addClass(ATTR_DISABLED);

                }
            });
        }
    }

    agreements_render()
}





function dot_click(dot) {

    dots_selected[dot.parent().parent().attr('id')]     = dot.index();

    dots_set_active(dot, true);
}



function dot_enter(dot) {

    dots_set_active(dot);

}



function dot_leave(dot) {

    dots                                                = dot.parent().children(CLASS_DOT);

    if (dots.hasClass(ATTR_SELECTED)) {

        dots_set_active(dot, true)

    } else {

        dots.removeClass(ATTR_ACTIVE);

    }
}



function dots_set_active(dot, clicked = false) {

    var dots                                            = dot.parent().children(CLASS_DOT);
    var count                                           = clicked ? dots_selected[dot.parent().parent().attr('id')] : dot.index();

    for (let i = 0; i <= count; i++) {

        dots.eq(i)                                      .addClass(ATTR_ACTIVE);

    }
}


