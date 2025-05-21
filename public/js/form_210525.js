


const HOST_NONE                                 = "";

var agreements_index_active                     = 0;
var lastTriggerNoInput                          = false;
var dots_selected                               = {};

const TRIGGER_REPORT                            = "report";



$(function(){



    $(OBJECT_FORM).on('click', CLASS_AGREEMENT, function() {

        study_agreement_toggle_selected($(this).attr('id'))

    });



    $(OBJECT_FORM).on('click', OBJECT_BUTTON_PREVIOUS, function() {

        study_agreements_set_active(-1);

    });

    $(OBJECT_FORM).on('click', OBJECT_BUTTON_NEXT, function() {

        study_agreements_set_active(1);

    });



    $(OBJECT_FORM).on('change', ELEMENT_SELECT + '.trigger', function() {

        select_trigger($(this));

    });



    $(OBJECT_FORM).on('click', CLASS_DOT, function() {

        report_dot_click($(this));

    });

    $(OBJECT_FORM).on('mouseenter', CLASS_DOT, function() {

        report_dot_enter($(this));

    });

    $(OBJECT_FORM).on('mouseleave', CLASS_DOT, function() {

        report_dot_leave($(this));

    });



    $(OBJECT_FORM).on('click', CLASS_SWITCH + ' ' + CLASS_BUTTON, function() {

        switch_click($(this));

    });



});





function study_agreements_load(host) {

    if (host == HOST_NONE && lastTriggerNoInput) {

        return false;

    }

    lastTriggerNoInput                              = host == HOST_NONE;

    $('.agreements *')                              .off();
    $('.agreements')                                .animate({opacity: 0}, 200);

    setTimeout(function(){

        $('.agreements').load('/load/study/agreements', {

            user:                                   host

        }).animate({opacity: 1}, 200);

    }, 200);
}



function study_agreements_set_active(index) {

    agreements_index_active                         = index == 0 ? 0 : agreements_index_active + index;

    agreements                                      = $(CLASS_AGREEMENT);
    agreements                                      .removeClass(ATTR_ACTIVE);

    switch (agreements.length) {

        case 0:
            break;

        case 1:
            agreements.first()                      .addClass(ATTR_ACTIVE);
            break;

        default:

            agreement                               = agreements.get(agreements_index_active);

            if (index != 0 && agreement.classList.contains(ATTR_DISABLED)) {

                study_agreements_set_active(index);

            } else {

                agreement                           .classList.add(ATTR_ACTIVE);

                study_agreements_render(true);

            }

            break;
    }
}



function study_agreements_render(movement = false) {

    buttons                                         = $(CLASS_BUTTON);

    button_previous                                 = $(OBJECT_BUTTON_PREVIOUS);
    button_next                                     = $(OBJECT_BUTTON_NEXT);

    buttons                                         .removeClass(ATTR_VISIBLE);
    buttons                                         .removeClass(ATTR_SOLO);

    agreements_enabled                              = $(CLASS_AGREEMENT + ':not(.' + ATTR_DISABLED + ')');
    agreements_enabled_index_active                 = agreements_index_active;

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

    var translate_position                          = 0;

    for (var i = 0; i < agreements_enabled_index_active; i++) {

        translate_position                          += agreements_enabled[i].offsetWidth + SPACING_AGREEMENT;

    }

    if (!movement) {

        $(OBJECT_AGREEMENTS)                        .css({"transition": "none"});

    }

    $(OBJECT_AGREEMENTS)                            .css({"transform": "translate(-" + translate_position + "px)"});

    if (!movement) {

        setTimeout(function(){

            $(OBJECT_AGREEMENTS)                    .css({"transition": "transform .4s ease"});

        }, 400);
    }
}



function study_agreement_toggle_selected(id) {

    agreement                                       = $('#' + id);

    if (agreement.hasClass(ATTR_ACTIVE)) {

        if (agreement.hasClass(ATTR_SELECTED)) {

            agreement                               .removeClass(ATTR_SELECTED);
            agreement.find('input')[0].value        = '';

            $(CLASS_AGREEMENT).each(function( index ) {

                if ($(CLASS_AGREEMENT + '.' + ATTR_SELECTED).length == 0) {

                    $(this)                         .removeClass(ATTR_DISABLED);

                }
            });

        } else {

            agreement                               .addClass(ATTR_SELECTED);
            agreement.find('input')[0].value        = agreement.attr('id');

            $(CLASS_AGREEMENT).each(function( index ) {

                if (($(this).attr('data-subject') != agreement.attr('data-subject')) || ($(this).attr('data-service') != agreement.attr('data-service'))) {

                    $(this)                         .addClass(ATTR_DISABLED);

                }
            });
        }
    }

    if ($(CLASS_AGREEMENT + '.' + ATTR_SELECTED).length > 0) {

        set_submit_enabled(true);


    } else {

        set_submit_enabled(false);

    }


    study_agreements_render()
}




function agreements_extend_load(id, index) {

    console.log(id);

    $.get('/load/agreement/extend/' + id, function(data, status){

        $('#_employee_' + index)                    .val(data['employee']).trigger('change');
        $('#_service_' + index)                     .val(data['service']).trigger('change');
        $('#_subject_' + index)                     .val(data['subject']).trigger('change');
        $('#_level_' + index)                       .val(data['level']).trigger('change');
        $('#_plan_' + index)                        .val(data['plan']).trigger('change');

        $('#hours_' + index)                        .val(data['hours']);
    });
}





function report_subjects_load() {

    let start                                       = $("#start").val();
    let end                                         = $("#end").val();

    var time_available                              = ((end.substr(0, 2) * 60) + (1 * end.substr(3, 2))) - ((start.substr(0, 2) * 60) + (1 * start.substr(3, 2)));

    console.log(time_available);

    $('.subjects').each(function( index ) {

        var subjects_ref                            = this;

        var subjects                                = $(subjects_ref);
        var subjects_descendents                    = $(subjects.attr('id') + ' *');
        var user                                    = subjects.data('user');
        var agreement                               = subjects.data('agreement');
        var report                                  = subjects.data('report');

        subjects_descendents                        .off();
        subjects                                    .animate({opacity: 0}, 200);

        setTimeout(function() {

            $(subjects_ref).load('/load/study/subjects', {

                study:                              study,
                user:                               user,
                agreement:                          agreement,
                report:                             report,
                time_available:                     time_available

            }).animate({opacity: 1}, 200);

        }, 200);
    });
}





function report_dot_click(dot) {

    dots_selected[dot.parent().attr('id')]          = dot.index();

    dot.parent().parent().find('input')[0].value    = (dot.index() + 1) * 15;
    dot.parent()                                    .addClass(ATTR_SELECTED);
}



function report_dot_enter(dot) {

    report_dots_set_active(dot);

}



function report_dot_leave(dot) {

    if (dot.parent().hasClass(ATTR_SELECTED)) {

        report_dots_set_active(dot, true);

    } else {

        report_dots_set_inactive(dot);

    }
}



function report_dots_set_active(dot, clicked = false) {

    var dots                                        = dot.parent().children(CLASS_DOT);
    var count                                       = clicked ? dots_selected[dot.parent().attr('id')] : dot.index();
    var time                                        = (count + 1) * 15;

    dot.parent().parent().find('.time')             .text(report_time_selected_text(time));

    dots                                            .removeClass(ATTR_ACTIVE);

    for (let i = 0; i <= count; i++) {

        dots.eq(i)                                  .addClass(ATTR_ACTIVE);

    }
}



function report_dots_set_inactive(dot) {

    var dots                                        = dot.parent().children(CLASS_DOT);

    dots                                            .removeClass(ATTR_ACTIVE);
    dot.parent().parent().find('.time')             .text('');
}



function report_time_selected_text(time) {

    return (time % 60 === 0) ? time / 60 + " uur" : time + " min";

}





function switch_click(button) {

    var buttons                                     = button.parent().children(CLASS_BUTTON);
    var input                                       = button.parent().find('input')[0];

    buttons                                         .removeClass(ATTR_SELECTED);
    button                                          .addClass(ATTR_SELECTED);
    input.value                                     = button.data('value');

    set_submit_enabled(true);
}




function set_submit_enabled(enabled) {

    if (enabled) {

        $('#button-submit')                         .removeAttr("disabled");
        $('#button-submit')                         .css('opacity', '1');
        $('#button-submit')                         .css('pointer-events', 'unset');

    } else {

        $('#button-submit')                         .attr("disabled", true);
        $('#button-submit')                         .css('opacity', '0.5');
        $('#button-submit')                         .css('pointer-events', 'none');

    }
}





function select_trigger(select) {

    var trigger                                     = select.data("trigger");

    switch(trigger) {

        case TRIGGER_REPORT:
            report_subjects_load();
            break;
    }
}


