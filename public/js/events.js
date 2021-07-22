


const OBJECT_APP                                = '#app';
const OBJECT_WRAP                               = '#wrap';
const OBJECT_MENU                               = '#menu';
const OBJECT_TOOLTIP                            = '#tooltip';
const OBJECT_BUTTON_MENU                        = '#button-menu';
const OBJECT_PAGE_TITLE                         = '.page.title';

const ICON_BACK                                 = "/images/back.svg";
const ICON_MENU                                 = "/images/menu.svg";

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





    $(OBJECT_APP).on('mousemove', CLASS_HEADER, function() {

        $(OBJECT_TOOLTIP)                       .text("Sorteren " + $(this).attr('id'));
        $(OBJECT_TOOLTIP)                       .css({left: (16 + event.clientX) + "px"});
        $(OBJECT_TOOLTIP)                       .css({top: (10 + event.clientY) + "px"});
    });

    $(OBJECT_APP).on('mouseenter', CLASS_HEADER, function() {

        $(OBJECT_TOOLTIP)                       .css({opacity: 1});
    };

    $(OBJECT_APP).on('mouseexit', CLASS_HEADER, function() {

        $(OBJECT_TOOLTIP)                       .css({opacity: 0});
    };




    // ADD CSRF TO AJAX POST:

    $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="_token"]').attr('content')}});





});
