


const OBJECT_APP                                = '#app';
const OBJECT_WRAP                               = '#wrap';
const OBJECT_MENU                               = '#menu';
const OBJECT_TOOLTIP                            = '#tooltip';
const OBJECT_FORM                               = '#form';

const OBJECT_LOADER_GLOBAL                      = '#loader-global';

const OBJECT_BUTTON_MENU                        = '#button-menu';
const OBJECT_BUTTON_LOGOUT                      = '#button-logout';
const OBJECT_BUTTON_SETTINGS                    = '#button-settings';
const OBJECT_BUTTON_SORT                        = '#button-sort';
const OBJECT_BUTTON_COUNTERS                    = '#button-counters';
const OBJECT_BUTTON_FILTER_ADD                  = '#button-filter-add';
const OBJECT_BUTTON_SUBJECT_ADD                 = '#button-subject-add';
const OBJECT_BUTTON_LOAD_MORE                   = '#button-load-more';

const OBJECT_LIST                               = '#list';
const OBJECT_ITEMS                              = '#items';
const OBJECT_HEADERS                            = '#headers';
const OBJECT_ACTIONS                            = '#actions';
const OBJECT_AGREEMENTS                         = '#agreements';

const OBJECT_COUNTERS                           = '#counters';
const OBJECT_COUNTERS_MOBILE                    = '#counters-mobile';

const OBJECT_FILTERS                            = '#filters';
const OBJECT_FILTERS_MOBILE                     = '#filters-mobile';
const OBJECT_FILTERS_MOBILE_PICK                = '#filters-mobile-pick';

const OBJECT_SORT_MOBILE                        = '#sort-mobile';
const OBJECT_SORT_MOBILE_PICK                   = '#sort-mobile-pick';
const OBJECT_SORT_MOBILE_DIRECTION              = '#sort-mobile-direction';

const OBJECT_PAGE_TITLE                         = '.page.title:not(.dot)';

const ELEMENT_SELECT                            = 'select';
const ELEMENT_TEXTAREA                          = 'textarea';
const ELEMENT_IMAGE                             = 'img';

const CLASS_HEADER                              = '.header';
const CLASS_FILTER                              = '.filter';
const CLASS_PERSON                              = '.person';
const CLASS_PERSON_REPORT                       = '.person-report';
const CLASS_AGREEMENT                           = '.agreement';
const CLASS_DOT                                 = '.dot';
const CLASS_SWITCH                              = '.switch';
const CLASS_TAB                                 = '.tab';
const CLASS_ITEM_TITLE                          = '.item-title';
const CLASS_CONTACT_POPOUT                      = '.contact-popout';
const CLASS_BUTTON                              = '.button';
const CLASS_BUTTON_NEXT                         = '.button-next';
const CLASS_BUTTON_PREVIOUS                     = '.button-previous';

const ICON_BACK                                 = "/images_app/back.svg";
const ICON_MENU                                 = "/images_app/menu.svg";

const ATTR_NO_SORT                              = 'no_sort';
const ATTR_NO_FILTER                            = 'no_filter';
const ATTR_SELECT_FILTER                        = 'select_filter';

const ATTR_VISIBLE                              = 'visible';
const ATTR_INVISIBLE                            = 'invisible';
const ATTR_ACTIVE                               = 'active';
const ATTR_SELECTED                             = 'selected';
const ATTR_FILTERED                             = 'filtered';
const ATTR_DISABLED                             = 'disabled';
const ATTR_SOLO                                 = 'solo';
const ATTR_GRID                                 = 'grid';

const SPACING_AGREEMENT                         = 40;

const TEXT_PAGE_TITLE_MENU                      = 'Studied';

var menu_open                                   = false;
var page_title                                  = "";





$(function(){



    $(OBJECT_BUTTON_MENU + ', ' + OBJECT_PAGE_TITLE).click(function() {

        this.menu_open                          = !this.menu_open;

        if (this.menu_open) {

            $(OBJECT_WRAP)                      .hide();
            $(OBJECT_MENU)                      .show();

            this.page_title                     = $(OBJECT_PAGE_TITLE).text();

            $(OBJECT_PAGE_TITLE)                .text(TEXT_PAGE_TITLE_MENU);
            $(OBJECT_BUTTON_MENU)               .attr("src", ICON_BACK);

        } else {

            $(OBJECT_WRAP)                      .show();
            $(OBJECT_MENU)                      .hide();

            $(OBJECT_PAGE_TITLE)                .text(this.page_title);
            $(OBJECT_BUTTON_MENU)               .attr("src", ICON_MENU);
        }
    });



    $(OBJECT_APP).on('mousemove', CLASS_PERSON, function() {

        set_tooltip(translated("Profiel bekijken"));

    });

    $(OBJECT_APP).on('mousemove', CLASS_PERSON_REPORT + "," + CLASS_PERSON + "." + ATTR_GRID, function() {

        set_tooltip(translated("Profiel van ") + $(this).attr("id") + translated(" bekijken"));

    });

    $(OBJECT_APP).on('mousemove', CLASS_HEADER + ":not(." + ATTR_NO_SORT + ",." + ATTR_SELECT_FILTER + ")", function() {

        set_tooltip(translated("Sorteren"));

    });

    $(OBJECT_APP).on('mousemove', CLASS_HEADER + "." + ATTR_SELECT_FILTER + ":not(." + ATTR_NO_FILTER + ")", function() {

        set_tooltip(translated("Filteren"));

    });

    $(OBJECT_APP).on('mousemove', OBJECT_PAGE_TITLE, function() {

        set_tooltip(translated("Menu"));

    });

    $(OBJECT_APP).on('mousemove', OBJECT_BUTTON_LOGOUT, function() {

        set_tooltip(translated("Uitloggen"));

    });

    $(OBJECT_APP).on('mousemove', OBJECT_BUTTON_SETTINGS, function() {

        set_tooltip(translated("Instellingen"));

    });

    $(OBJECT_APP).on('mousemove', CLASS_CONTACT_POPOUT, function() {

        set_tooltip(translated("Kopiëren"));

    });



    $(OBJECT_APP).on('mouseenter',

        CLASS_HEADER + ":not(." + ATTR_NO_SORT + ",." + ATTR_SELECT_FILTER + ")" + ", " +
        CLASS_HEADER + "." + ATTR_SELECT_FILTER + ":not(." + ATTR_NO_FILTER + ")" + ", " +
        CLASS_PERSON_REPORT + ", " +
        CLASS_PERSON + ", " +
        OBJECT_PAGE_TITLE + ", " +
        OBJECT_BUTTON_LOGOUT + ", " +
        OBJECT_BUTTON_SETTINGS +
        CLASS_CONTACT_POPOUT,

        function() {

            $(OBJECT_TOOLTIP)                       .css({opacity: 1});

        }
    );

    $(OBJECT_APP).on('mouseleave',

        CLASS_HEADER + ":not(." + ATTR_NO_SORT + ",." + ATTR_SELECT_FILTER + ")" + ", " +
        CLASS_HEADER + "." + ATTR_SELECT_FILTER + ":not(." + ATTR_NO_FILTER + ")" + ", " +
        CLASS_PERSON_REPORT + ", " +
        CLASS_PERSON + ", " +
        OBJECT_PAGE_TITLE + ", " +
        OBJECT_BUTTON_LOGOUT + ", " +
        OBJECT_BUTTON_SETTINGS +
        CLASS_CONTACT_POPOUT,

        function(){

            $(OBJECT_TOOLTIP)                       .css({opacity: 0});

        }
    );





    $('.content-fold').on('click', CLASS_ITEM_TITLE, function() {

        $(this)                                     .parent().toggleClass(ATTR_VISIBLE);

    });





    /* Add CSRF token to Ajax POST: */

    $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="_token"]').attr('content')}});





    /* Auto resize textarea elements */

    $(OBJECT_APP).on('input change cut paste', ELEMENT_TEXTAREA, function() {

        $(this)                                             .css("height", "unset");

        let height                                          = $(this).prop('scrollHeight');
        let height_min                                      = 18;

        if (height > height_min) {

            $(this)                                         .css("height", height + "px");

        }
    });





    /* Show loading indicator on page unload */

    if (is_standalone_mode) {

        //

    }

    window.addEventListener('beforeunload', () => {

        load_global_show();

    });

    window.addEventListener('pagehide', () => {

        load_global_show();

    });

    window.addEventListener('pageshow', () => {

        load_global_hide();

    });





});



function set_tooltip(text) {

    $(OBJECT_TOOLTIP)                       .text(text);
    $(OBJECT_TOOLTIP)                       .css({left: (16 + event.clientX) + "px"});
    $(OBJECT_TOOLTIP)                       .css({top: (10 + event.clientY) + "px"});
}



function set_language(language) {

    $.ajax({

        url:                                "/submit/language",
        type:                               "POST",
        data:                               { value: language },

        success: function(data) {

            location.reload();

        },

        error: function() {

            alert(translated("Er is iets fout gegaan bij het wijzigen van de taal. Check je internetverbinding en probeer het nog eens."));

        }
    });
}



function format_currency(value) {

    return currency(value, { symbol: "€", separator: ".", decimal: "," }).format();

}



function load_global_show() {

    if (window.innerWidth <= 840) {

        $(OBJECT_LOADER_GLOBAL)             .css('display', 'block');
        $(OBJECT_APP)                       .css('opacity', '.7');
        $(OBJECT_APP)                       .css('pointer-events', 'none');
    }
}



function load_global_hide() {

    $(OBJECT_LOADER_GLOBAL)                 .css('display', 'none');
    $(OBJECT_APP)                           .css('opacity', '1');
    $(OBJECT_APP)                           .css('pointer-events', 'all');
}



function is_standalone_mode() {

    return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;

}
