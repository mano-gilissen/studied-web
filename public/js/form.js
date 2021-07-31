


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

    agreements                                  .removeClass('active');
    agreements.first()                          .addClass('active');
}



function agreement_toggle(identifier) {

    $('#' + identifier)                         .toggleClass('selected');

}


