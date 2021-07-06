window.Vue = require('vue');



const app = new Vue({

    el                                          : '#app',

    data : {

        menu_open                               : false,

        OBJECT_WRAP                             : $('#wrap'),
        OBJECT_MENU                             : $('#menu'),

        CLASS_MENU_OPEN                         : 'menu-open'

    },

    methods : {

        menu_toggle : function (event) {

            this.menu_open                      = !this.menu_open;

            this.OBJECT_WRAP.classList.remove(this.CLASS_MENU_OPEN);
            this.OBJECT_MENU.classList.remove(this.CLASS_MENU_OPEN);

            if (this.menu_open) {

                this.OBJECT_WRAP.classList.add(this.CLASS_MENU_OPEN);
                this.OBJECT_MENU.classList.add(this.CLASS_MENU_OPEN);
            }
        }

    }

});


