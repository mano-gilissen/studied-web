


var agreements_index_active                     = 0;



$(function() {



    $(OBJECT_BUTTON_PREVIOUS).on('click', function () {

        profile_agreements_set_active(-1);

    });

    $(OBJECT_BUTTON_NEXT).on('click', function () {

        profile_agreements_set_active(1);

    });



});



function profile_agreements_set_active(index) {

    agreements_index_active                     = index == 0 ? 0 : agreements_index_active + index;

    agreements                                  = $(CLASS_AGREEMENT);
    agreements                                  .removeClass(ATTR_ACTIVE);

    switch (agreements.length) {

        case 0:
            break;

        case 1:
            agreements.first()                  .addClass(ATTR_ACTIVE);
            break;

        default:

            agreement                           = agreements.get(agreements_index_active);
            agreement                           .classList.add(ATTR_ACTIVE);

            profile_agreements_render(true);
            break;
    }
}



function profile_agreements_render(movement = false) {

    buttons                                     = $(CLASS_BUTTON);

    button_previous                             = $(OBJECT_BUTTON_PREVIOUS);
    button_next                                 = $(OBJECT_BUTTON_NEXT);

    buttons                                     .removeClass(ATTR_VISIBLE);
    buttons                                     .removeClass(ATTR_SOLO);


    agreements                                  = $(CLASS_AGREEMENT);

    if(agreements.length > 1) {

        if (agreements_index_active === 0) {

            button_next                             .addClass(ATTR_VISIBLE);
            button_next                             .addClass(ATTR_SOLO);

        } else if (agreements_index_active === agreements.length - 1) {

            button_previous                         .addClass(ATTR_VISIBLE);
            button_previous                         .addClass(ATTR_SOLO);

        } else {

            button_previous                         .addClass(ATTR_VISIBLE);
            button_next                             .addClass(ATTR_VISIBLE);

        }
    }

    var translate_position                      = 0;

    for (var i = 0; i < agreements_index_active; i++) {

        translate_position                      += agreements[i].offsetWidth + SPACING_AGREEMENT;

    }

    agreements                                  .css({"transform": "translate(-" + translate_position + "px)"});
}
