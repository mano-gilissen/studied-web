


const BUTTON_MENU                               = '#button-menu';

const OBJECT_WRAP                               = '#wrap';
const OBJECT_MENU                               = '#menu';

var menu_open                                   = false;



$(function(){



    $(BUTTON_MENU).click(function() {

        menu_open                               = !menu_open;

        console.log(menu_open ? "true" : "false");

        if (this.menu_open) {

            $(OBJECT_WRAP).hide();
            $(OBJECT_MENU).show();

        } else {

            $(OBJECT_WRAP).show();
            $(OBJECT_MENU).hide();

        }
    });



});
