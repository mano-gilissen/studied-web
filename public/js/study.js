




$(function() {



    $('.report-tabs').on('click', '.tab', function() {

        report_set_active($(this));

    });



});



function report_set_active(tab) {

    var tabs                                            = $('.report-tabs .tab');
    var reports                                         = $('.report');
    var report_active                                   = $('.report#' + tab.attr('id'));

    tabs                                                .removeClass(ATTR_ACTIVE);
    tab                                                 .addClass(ATTR_ACTIVE);

    reports                                             .hide();
    report_active                                       .show();
}
