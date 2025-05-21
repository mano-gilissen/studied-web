


var agreements_index_active                     = 0;



$(function() {



    $(OBJECT_APP).on('mousemove', CLASS_AGREEMENT, function() {

        set_tooltip(translated("Vakafspraak bekijken"));

    });



    $(OBJECT_APP).on('mouseenter', CLASS_AGREEMENT,

        function() {

            $(OBJECT_TOOLTIP)                       .css({opacity: 1});

        }
    );

    $(OBJECT_APP).on('mouseleave', CLASS_AGREEMENT,

        function(){

            $(OBJECT_TOOLTIP)                       .css({opacity: 0});

        }
    );



    $(OBJECT_BUTTON_PREVIOUS).on('click', function () {

        profile_agreements_set_active(-1);

    });

    $(OBJECT_BUTTON_NEXT).on('click', function () {

        profile_agreements_set_active(1);

    });



    profile_agreements_set_active(0);



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

    buttons                                     = $(OBJECT_BUTTON_PREVIOUS + ', ' + OBJECT_BUTTON_NEXT);

    button_previous                             = $(OBJECT_BUTTON_PREVIOUS);
    button_next                                 = $(OBJECT_BUTTON_NEXT);

    buttons                                     .removeClass(ATTR_VISIBLE);

    agreements                                  = $(CLASS_AGREEMENT);

    if(agreements.length > 1) {

        if (agreements_index_active === 0) {

            button_next                             .addClass(ATTR_VISIBLE);

        } else if (agreements_index_active === agreements.length - 1) {

            button_previous                         .addClass(ATTR_VISIBLE);

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
