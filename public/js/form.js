


$(function(){



    $(OBJECT_FORM).on('input', '#_host', function() {

        agreements_load($(this).attr('value'))

    });



});





function agreements_load(id, host) {

    if (host > 0) {

        $('#agreements').load('/load/agreements', {

            user:                               host

        });
    }
}


