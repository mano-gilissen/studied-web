

$(function() {



});



function evaluation_agreement_load(evaluation_id) {

    $('#agreements-wrap').load('/load/evaluation/agreement', {

        evaluation:                         evaluation_id,
        id:                                 $('#agreements-wrap div').length + 1
    });
}
