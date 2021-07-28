


const OBJECT_APP                                = '#app';
const OBJECT_WRAP                               = '#wrap';
const OBJECT_MENU                               = '#menu';
const OBJECT_LIST                               = '#list';
const OBJECT_TOOLTIP                            = '#tooltip';

const OBJECT_FORM                               = '#form';
const OBJECT_INPUT_DATE                         = '#date';

const OBJECT_BUTTON_MENU                        = '#button-menu';
const OBJECT_BUTTON_LOGOUT                      = '#button-logout';
const OBJECT_BUTTON_SETTINGS                    = '#button-settings';

const OBJECT_PAGE_TITLE                         = '.page.title';

const CLASS_HEADER                              = '.header';
const CLASS_PERSON                              = '.person';
const CLASS_PERSON_REPORT                       = '.person-report';

const ICON_BACK                                 = "/images/back.svg";
const ICON_MENU                                 = "/images/menu.svg";

const CLASS_SORT_MODE_NONE                      = '.none';

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





    function setTooltip(text) {

        $(OBJECT_TOOLTIP)                       .text(text);
        $(OBJECT_TOOLTIP)                       .css({left: (16 + event.clientX) + "px"});
        $(OBJECT_TOOLTIP)                       .css({top: (10 + event.clientY) + "px"});
    }



    $(OBJECT_APP).on('mousemove', CLASS_PERSON, function() {

        setTooltip("Profiel bekijken");

    });

    $(OBJECT_APP).on('mousemove', CLASS_PERSON_REPORT, function() {

        setTooltip("Profiel van " + $(this).attr("id") + " bekijken");

    });

    $(OBJECT_APP).on('mousemove', CLASS_HEADER + ":not(" + CLASS_SORT_MODE_NONE + ")", function() {

        setTooltip("Sorteren");

    });

    $(OBJECT_APP).on('mousemove', OBJECT_BUTTON_LOGOUT, function() {

        setTooltip("Uitloggen");

    });

    $(OBJECT_APP).on('mousemove', OBJECT_BUTTON_SETTINGS, function() {

        setTooltip("Instellingen");

    });



    $(OBJECT_APP).on('mouseenter',

        CLASS_HEADER + ":not(" + CLASS_SORT_MODE_NONE + ")" + ", " +
        CLASS_PERSON_REPORT + ", " +
        CLASS_PERSON + ", " +
        OBJECT_BUTTON_LOGOUT + ", " +
        OBJECT_BUTTON_SETTINGS,

        function() {

            $(OBJECT_TOOLTIP)                       .css({opacity: 1});

        }
    );

    $(OBJECT_APP).on('mouseleave',

        CLASS_HEADER + ":not(" + CLASS_SORT_MODE_NONE + ")" + ", " +
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





});
