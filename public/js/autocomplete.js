


const TRIGGER_AGREEMENTS                            = "agreements";
const TRIGGER_FILTER                                = "filter";


function autocomplete(input, data, additional, reject_other, show_all, uses_id, set_id, locked, trigger, form) {



    var currentFocus,
        autocompleted                               = false;



    if (!locked) {



        input.on("input", function(e) {

            autocomplete_open_list(input, currentFocus, autocompleted, data, uses_id, autocomplete_has_additional(additional), additional, show_all, trigger, this, true);

        });



        input.on("focus", function(e) {

            autocomplete_open_list(input, currentFocus, autocompleted, data, uses_id, autocomplete_has_additional(additional), additional, show_all, trigger, this);

        });



        input.on("keydown", function(e) {

            var list                                    = document.getElementById(this.id + "-autocomplete-list");

            if (list) {

                list                                    = list.getElementsByTagName("div");

            }

            if (e.keyCode == 40) {

                currentFocus++;

                autocomplete_add_active(currentFocus, list);

            } else if (e.keyCode == 38) {

                currentFocus--;

                autocomplete_add_active(currentFocus, list);

            } else if (e.keyCode == 13) {

                e.preventDefault();

                if (currentFocus > -1) {

                    if (list) {

                        list[currentFocus].click();

                    }
                }
            } else if (e.keyCode == 9) {

                autocomplete_close_list_and_reject(input, autocompleted, uses_id, reject_other);

            }
        });



        if (form) {

            document.addEventListener("click", function (event) {

                if (event.target.id != input.attr('id')) {

                    autocomplete_close_list_and_reject(input, autocompleted, uses_id, reject_other);

                }
            });
        }



    }



    if (set_id) {

        autocomplete_set_value(input, uses_id, autocompleted, trigger, data, set_id);

    }



}
