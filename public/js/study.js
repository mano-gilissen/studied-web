



var tab_active;




$(function() {



    $('.report-tabs').on('click', '.tab', function() {

        report_set_active($(this));

    });

    $('.report-tabs').on('mouseenter', '.tab', function() {

        report_tab_enter($(this));

    });

    $('.report-tabs').on('mouseleave', '.tab', function() {

        report_tab_leave();

    });



    report_set_active_default();



});



function report_set_active(tab) {
    
    tab_active                                          = tab;

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



function report_tab_enter(tab) {

    var tabs                                            = $('.report-tabs .tab');

    tabs                                                .removeClass(ATTR_ACTIVE);
    tab                                                 .addClass(ATTR_ACTIVE);
}



function report_tab_leave() {

    var tabs                                            = $('.report-tabs .tab');

    tabs                                                .removeClass(ATTR_ACTIVE);
    tab_active                                          .addClass(ATTR_ACTIVE);
}
