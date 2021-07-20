


const OBJECT_WRAP                               = '#wrap';
const OBJECT_MENU                               = '#menu';
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



    $("#filters").click(function() {

        $('#filters').load('load-test');

    });



});
