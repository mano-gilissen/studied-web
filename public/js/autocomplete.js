


function autocomplete(input, data, additional, reject_other, show_all, id) {



    var currentFocus,
        autocompleted                               = false;



    input.addEventListener("input", function(e) {

        openList(this, true);

    });



    input.addEventListener("focus", function(e) {

        openList(this);

    });



    input.addEventListener("keydown", function(e) {

        var list                                    = document.getElementById(this.id + "-autocomplete-list");

        if (list) {

            list                                    = list.getElementsByTagName("div");

        }

        if (e.keyCode == 40) {

            currentFocus++;

            addActive(list);

        } else if (e.keyCode == 38) {

            currentFocus--;

            addActive(list);

        } else if (e.keyCode == 13) {

            e.preventDefault();

            if (currentFocus > -1) {

                if (list) {

                    list[currentFocus].click();

                }
            }
        } else if (e.keyCode == 9) {

            closeListAndReject();

        }
    });



    function openList(event, received_input = false) {

        var list,

            current_value                           = event.value;

        closeList();

        if (received_input) {

            input.parentNode.classList              .remove("autocomplete");

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

            createItem(list, key, current_value)

        }
    }



    function createItem(list, key, current_value) {

        var item,

            value_data,
            value_additional;

        if ((show_all && !current_value) || data[key].substr(0, current_value.length).toUpperCase() == current_value.toUpperCase()) {

            item                                = document.createElement("DIV");
            item                                .setAttribute("class", "autocomplete-item");

            value_data                          = data[key];
            value_additional                    = hasAdditional() ? "&nbsp;&nbsp;<span style='color:#CCCCCC'>" + additional[key] + "</span>" : "";

            item.innerHTML                      = current_value ? "<span style='color:black;font-weight:400'>" + value_data.substr(0, current_value.length) + "</span>" + value_data.substr(current_value.length) + value_additional : value_data + value_additional;
            item.innerHTML                      += "<input type='hidden' value='" + key + "'>";

            item.addEventListener("click", function(e) {

                key                             = this.getElementsByTagName("input")[0].value;

                input.value                     = data[key];

                input.parentNode.classList      .add("autocomplete");

                input_id                        = document.getElementById("ac_id_" + input.name);
                input_id.value                  = key;

                autocompleted                   = true;

                closeList();
            });

            list.appendChild(item);
        }
    }



    function addActive(list) {

        if (!list) {

            return false;

        }

        removeActive(list);

        if (currentFocus >= list.length) {

            currentFocus                            = 0;

        }

        if (currentFocus < 0) {

            currentFocus                            = (list.length - 1);

        }

        list[currentFocus].classList.add("active");
    }



    function removeActive(list) {

        for (var index = 0; index < list.length; index++) {

            list[index].classList.remove("active");

        }
    }



    function closeList() {

        var list                                    = document.getElementById(input.id + "-autocomplete-list");

        if (list) {

            list.parentNode.removeChild(list);

        }
    }



    function closeListAndReject() {

        closeList();

        if (reject_other && !autocompleted) {

            input.value                             = '';

        }
    }



    function hasAdditional() {

        return additional != null;

    }



    function arrayLength(array) {

        return Object.keys(array).length;

    }



    document.addEventListener("click", function (event) {

        if (event.target != input) {

            closeListAndReject();

        }
    });



}
