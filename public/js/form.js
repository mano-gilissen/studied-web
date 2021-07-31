


var agreements_index_active                     = 0;



$(function(){



    $(OBJECT_FORM).on('input', '#_host', function() {

        console.out('á');

        agreements_load($(this).attr('value'))

    });



    $(OBJECT_AGREEMENTS).on('click', CLASS_AGREEMENT, function() {

        agreement_toggle($(this).attr('id'))

    });



    $(OBJECT_FORM).on('click', OBJECT_BUTTON_PREVIOUS, function() {

        agreements_set_active(agreements_index_active - 1);

    });

    $(OBJECT_FORM).on('click', OBJECT_BUTTON_NEXT, function() {

        agreements_set_active(agreements_index_active + 1);

    });



});





function agreements_load(id, host) {

    if (host > 0) {

        $('#agreements').load('/load/agreements', {

            user:                               host

        });
    }
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

        agreement                               .toggleClass('selected');

    }
}


