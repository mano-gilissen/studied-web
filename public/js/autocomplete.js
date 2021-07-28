


function autocomplete(input, data, additional, reject_other, show_all) {



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
            item,
            index,
            val                                     = event.value;

        closeList();

        if (received_input) {

            input.parentNode.classList              .remove("autocomplete");

            autocompleted                           = false;
        }

        if (!val && !show_all) {

            return false

        }

        currentFocus                                = -1;

        list                                        = document.createElement("DIV");
        list                                        .setAttribute("id", event.id + "-autocomplete-list");
        list                                        .setAttribute("class", "autocomplete-list");

        event.parentNode.parentNode.appendChild(list);

        for (index = 0; index < data.length; index++) {

            if ((show_all && !val) || data[index].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                item                                = document.createElement("DIV");
                item                                .setAttribute("class", "autocomplete-item");

                value_data                          = data[index];
                value_additional                    = hasAdditional() ? "&nbsp;<span style='color:#333333'>" + additional[index] + "</span>" : "";

                item.innerHTML                      = val ? "<span style='color:black;font-weight:400'>" + value_data.substr(0, val.length) + "</span>" + value_data.substr(val.length) + value_additional : value_data + value_additional;
                item.innerHTML                      += "<input type='hidden' value='" + index + "'>";

                item.addEventListener("click", function(e) {

                    index_clicked                   = this.getElementsByTagName("input")[0].value;

                    input.value                     = data[index_clicked];

                    input.parentNode.classList      .add("autocomplete");

                    autocompleted                   = true;

                    closeList();
                });

                list.appendChild(item);
            }
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

        return additional.length > 0;

    }



    document.addEventListener("click", function (event) {

        if (event.target != input) {

            closeListAndReject();

        }
    });



}
