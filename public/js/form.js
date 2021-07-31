


var agreements_index_active                     = 0;



$(function(){



    $(OBJECT_FORM).on('input', '#_host', function() {

        agreements_load($(this).attr('value'))

    });



    $(OBJECT_AGREEMENTS).on('click', CLASS_AGREEMENT, function() {

        agreement_toggle($(this).attr('id'))

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

    agreements                                  .removeClass('active');
    buttons                                     .removeClass('visible');
    buttons                                     .removeClass('solo');

    switch (agreements.length) {

        case 0:
            // TODO: SHOW "NO AGREEMENTS"
            break;

        case 1:
            agreements.first()                  .addClass('active');
            break;

        default:
            agreement                           = agreements.get(index);
            agreement                           .addClass('active');

            if (index === 0) {
                button_next                     .addClass('visible');
                button_next                     .addClass('solo');
            } else if (index === agreements.length - 1) {
                button_previous                 .addClass('visible');
                button_previous                 .addClass('solo');
            } else {
                button_previous                 .addClass('visible');
                button_next                     .addClass('visible');
            }

            break;
    }
}



function agreement_toggle(identifier) {

    $('#' + identifier)                         .toggleClass('selected');

}


