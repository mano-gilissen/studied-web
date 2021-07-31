


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



function agreement_toggle(identifier) {

    console.log(identifier);
    $('#' . identifier).classList.toggle(CLASS_SELECTED);

}


