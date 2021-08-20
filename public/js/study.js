




$(function() {



    $('.report-tabs').on('click', '.tab', function() {

        report_set_active($(this));

    });



    report_set_active_default();



});



function report_set_active(tab) {

    var tabs                                            = $('.report-tabs .tab');
    var reports                                         = $('.report');
    var report_active                                   = $('#report_' + tab.attr('id'));

    tabs                                                .removeClass(ATTR_ACTIVE);
    tab                                                 .addClass(ATTR_ACTIVE);

    reports                                             .hide();
    report_active                                       .show();
}



function report_set_active_default() {

    var tabs                                            = $('.report-tabs .tab');

    if (tabs.length > 0) {

        report_set_active(tabs.first());

    }
}
