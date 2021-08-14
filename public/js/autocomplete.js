


const TRIGGER_AGREEMENTS                            = "agreements";
const TRIGGER_FILTER                                = "filter";


function autocomplete(input, data, additional, reject_other, show_all, uses_id, set_id, locked, trigger, form) {



    var currentFocus,
        autocompleted                               = false;



    if (!locked) {



        input.on("input", function(e) {

            open_list(this, true);

        });



        input.on("focus", function(e) {

            open_list(this);

        });



        input.on("keydown", function(e) {

            var list                                    = document.getElementById(this.id + "-autocomplete-list");

            if (list) {

                list                                    = list.getElementsByTagName("div");

            }

            if (e.keyCode == 40) {

                currentFocus++;

                add_active(list);

            } else if (e.keyCode == 38) {

                currentFocus--;

                add_active(list);

            } else if (e.keyCode == 13) {

                e.preventDefault();

                if (currentFocus > -1) {

                    if (list) {

                        list[currentFocus].click();

                    }
                }
            } else if (e.keyCode == 9) {

                close_list_and_reject();

            }
        });



        if (form) {

            document.addEventListener("click", function (event) {

                if (event.target != input) {

                    close_list_and_reject();

                }
            });
        }



    } else {

        set_value(set_id);

    }



    function open_list(event, received_input = false) {

        var list,

            current_value                           = event.value;

        close_list();

        if (received_input) {

            input.parent()                          .removeClass("autocomplete");

            autocompleted                           = false;
        }

        if (!current_value && !show_all) {

            return false

        }

        currentFocus                                = -1;

        list                                        = document.createElement("DIV");
        list                                        .setAttribute("id", event.id + "-autocomplete-list");
        list                                        .setAttribute("class", "autocomplete-list");

        event.parentNode.parentNode.appendChild(list);

        for (var key of Object.keys(data)) {

            create_item(list, key, current_value);

        }
    }



    function create_item(list, key, current_value) {

        var item,

            value_data,
            value_additional;

        if ((show_all && !current_value) || data[key].substr(0, current_value.length).toUpperCase() == current_value.toUpperCase()) {

            item                                = document.createElement("DIV");
            item                                .setAttribute("class", "autocomplete-item");

            value_data                          = data[key];
            value_additional                    = has_additional() ? "&nbsp;&nbsp;<span style='color:#CCCCCC'>" + additional[key] + "</span>" : "";

            item.innerHTML                      = current_value ? "<span style='color:black;font-weight:400'>" + value_data.substr(0, current_value.length) + "</span>" + value_data.substr(current_value.length) + value_additional : value_data + value_additional;
            item.innerHTML                      += "<input type='hidden' value='" + key + "'>";

            item.addEventListener("click", function(e) {

                key                             = this.getElementsByTagName("input")[0].value;

                set_value(key);

                close_list();
            });

            list.appendChild(item);
        }
    }



    function set_value(key) {

        var input_id;

        input                           .val(data[key]);

        input.parent()                  .addClass("autocomplete");

        autocompleted                   = true;

        if (uses_id) {

            input_id                    = document.getElementById("_" + input.attr('name'));
            input_id.value              = key;

            call_trigger(key, input.data('identifier'));
        }
    }



    function add_active(list) {

        if (!list) {

            return false;

        }

        remove_active(list);

        if (currentFocus >= list.length) {

            currentFocus                            = 0;

        }

        if (currentFocus < 0) {

            currentFocus                            = (list.length - 1);

        }

        list[currentFocus].classList.add("active");
    }



    function remove_active(list) {

        for (var index = 0; index < list.length; index++) {

            list[index].classList.remove("active");

        }
    }



    function close_list() {

        var list                                    = input.parent().parent().find(".autocomplete-list");

        if (list) {

            list.parentNode.removeChild(list);

        }
    }



    function close_list_and_reject() {

        var input_id;

        close_list();

        if (reject_other && !autocompleted) {

            input                                   .val('');

            if (uses_id) {

              //input_id                            = document.getElementById();
                input_id                            = input.parent().parent().find('#_' + input.attr('name'));
                input_id.value                      = '';
            }
        }
    }



    function call_trigger(key, identifier) {

        switch (trigger) {

            case TRIGGER_AGREEMENTS:
                study_agreements_load(key);
                break;

            case TRIGGER_FILTER:
                filter(key, identifier);
                break;
        }
    }



    function has_additional() {

        return additional != null;

    }



    function array_length(array) {

        return Object.keys(array).length;

    }



}
