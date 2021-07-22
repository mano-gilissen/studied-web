


const OBJECT_APP                                = '#app';
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





    $(OBJECT_APP).on('mouseover', CLASS_HEADER, function() {

        var x = event.clientX;
        var y = event.clientY;

        console.log($(this).clientX);
        console.log(event.clientX);

        document.getElementById("tooltip").textContent = "sorteren " + $(this).attr('id');
        document.getElementById("tooltip").style.left = x + "px";
        document.getElementById("tooltip").style.top = y + "px";
    });





    // ADD CSRF TO AJAX POST:

    $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="_token"]').attr('content')}});





});
