


const OBJECT_APP                                = '#app';
const OBJECT_WRAP                               = '#wrap';
const OBJECT_MENU                               = '#menu';
const OBJECT_TOOLTIP                            = '#tooltip';

const OBJECT_BUTTON_MENU                        = '#button-menu';
const OBJECT_BUTTON_LOGOUT                      = '#button-logout';
const OBJECT_BUTTON_SETTINGS                    = '#button-settings';
const OBJECT_BUTTON_PREVIOUS                    = '#button-previous';
const OBJECT_BUTTON_NEXT                        = '#button-next';
const OBJECT_BUTTON_FILTER_ADD                  = '#button-filter-add';
const OBJECT_BUTTON_SUBJECT_ADD                 = '#button-subject-add';

const OBJECT_LIST                               = '#list';
const OBJECT_ITEMS                              = '#items';
const OBJECT_HEADERS                            = '#headers';
const OBJECT_FILTERS                            = '#filters';
const OBJECT_COUNTERS                           = '#counters';
const OBJECT_ACTIONS                            = '#actions';

const OBJECT_FORM                               = '#form';
const OBJECT_AGREEMENTS                         = '#agreements';

const OBJECT_PAGE_TITLE                         = '.page.title:not(.dot)';

const CLASS_HEADER                              = '.header';
const CLASS_FILTER                              = '.filter';
const CLASS_PERSON                              = '.person';
const CLASS_PERSON_REPORT                       = '.person-report';
const CLASS_AGREEMENT                           = '.agreement';
const CLASS_BUTTON                              = '.button';
const CLASS_DOT                                 = '.dot';

const ICON_BACK                                 = "/images/back.svg";
const ICON_MENU                                 = "/images/menu.svg";

const ATTR_NO_SORT                              = 'no_sort';
const ATTR_NO_FILTER                            = 'no_filter';
const ATTR_SELECT_FILTER                        = 'select_filter';

const ATTR_VISIBLE                              = 'visible';
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



    $(OBJECT_BUTTON_MENU).click(function() {

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



    function set_tooltip(text) {

        $(OBJECT_TOOLTIP)                       .text(text);
        $(OBJECT_TOOLTIP)                       .css({left: (16 + event.clientX) + "px"});
        $(OBJECT_TOOLTIP)                       .css({top: (10 + event.clientY) + "px"});
    }



    $(OBJECT_APP).on('mousemove', CLASS_PERSON, function() {

        set_tooltip("Profiel bekijken");

    });

    $(OBJECT_APP).on('mousemove', CLASS_PERSON_REPORT + "," + CLASS_PERSON + "." + ATTR_GRID, function() {

        set_tooltip("Profiel van " + $(this).attr("id") + " bekijken");

    });

    $(OBJECT_APP).on('mousemove', CLASS_HEADER + ":not(." + ATTR_NO_SORT + ",." + ATTR_SELECT_FILTER + ")", function() {

        set_tooltip("Sorteren");

    });

    $(OBJECT_APP).on('mousemove', CLASS_HEADER + "." + ATTR_SELECT_FILTER + ":not(." + ATTR_NO_FILTER + ")", function() {

        set_tooltip("Filteren");

    });

    $(OBJECT_APP).on('mousemove', OBJECT_BUTTON_LOGOUT, function() {

        set_tooltip("Uitloggen");

    });

    $(OBJECT_APP).on('mousemove', OBJECT_BUTTON_SETTINGS, function() {

        set_tooltip("Instellingen");

    });



    $(OBJECT_APP).on('mouseenter',

        CLASS_HEADER + ":not(." + ATTR_NO_SORT + ",." + ATTR_SELECT_FILTER + ")" + ", " +
        CLASS_HEADER + "." + ATTR_SELECT_FILTER + ":not(." + ATTR_NO_FILTER + ")" + ", " +
        CLASS_PERSON_REPORT + ", " +
        CLASS_PERSON + ", " +
        OBJECT_BUTTON_LOGOUT + ", " +
        OBJECT_BUTTON_SETTINGS,

        function() {

            $(OBJECT_TOOLTIP)                       .css({opacity: 1});

        }
    );

    $(OBJECT_APP).on('mouseleave',

        CLASS_HEADER + ":not(." + ATTR_NO_SORT + ",." + ATTR_SELECT_FILTER + ")" + ", " +
        CLASS_HEADER + "." + ATTR_SELECT_FILTER + ":not(." + ATTR_NO_FILTER + ")" + ", " +
        CLASS_PERSON_REPORT + ", " +
        CLASS_PERSON + ", " +
        OBJECT_BUTTON_LOGOUT + ", " +
        OBJECT_BUTTON_SETTINGS,

        function(){

            $(OBJECT_TOOLTIP)                       .css({opacity: 0});

        }
    );





    // ADD CSRF TO AJAX POST:

    $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="_token"]').attr('content')}});




/*
    var textarea = document.getElementById("textarea");
    var limit = 80; //height limit

    textarea.oninput = function() {
        textarea.style.height = "";
        textarea.style.height = Math.min(textarea.scrollHeight, limit) + "px";
    };*/

    $(OBJECT_APP).on('input change cut paste', 'textarea', function() {

        console.log(Math.min($(this).prop('scrollHeight'), 100) + 20);

        $(this).css("height", "");
        $(this).css("height", (Math.min($(this).prop('scrollHeight'), 100) + 20) + "px");

    });






});
