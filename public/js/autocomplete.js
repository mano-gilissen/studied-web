


function autocomplete(input, values, reject_other, show_all) {



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

            closeAndReject();

        }
    });



    function openList(event, received_input = false) {

        var list,
            item,
            index,
            val                                     = event.value;

        closeAllLists();

        if (received_input) {

            input.parentNode.classList                  .remove("autocomplete");

            autocompleted                               = false;
        }

        if (!val && !show_all) {

            return false

        }

        currentFocus                                = -1;

        list                                        = document.createElement("DIV");
        list                                        .setAttribute("id", event.id + "-autocomplete-list");
        list                                        .setAttribute("class", "autocomplete-list");

        event.parentNode.parentNode.appendChild(list);

        for (index = 0; index < values.length; index++) {

            if ((show_all && !val) || values[index].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                item                                = document.createElement("DIV");
                item                                .setAttribute("class", "autocomplete-item");

                item.innerHTML                      = val ? "<span style='color:black;font-weight:400'>" + values[index].substr(0, val.length) + "</span>" + values[index].substr(val.length) : values[index];

                item.innerHTML                      += "<input type='hidden' value='" + values[index] + "'>";

                item.addEventListener("click", function(e) {

                    input.value                     = this.getElementsByTagName("input")[0].value;

                    input.parentNode.classList      .add("autocomplete");

                    autocompleted                   = true;

                    closeAllLists();
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



    function closeAllLists(element) {

        console.log(input.id + "-autocomplete-list");
        var list                                    = document.getElementById(input.id + "-autocomplete-list");

        if (list) {

            console.log('remove');
            list.parentNode.removeChild(list);

        }
/*
            for (var index = 0; index < list.length; index++) {

                if (element != list[index] && element != input) {

                    list[index].parentNode.removeChild(list[index]);

                }
            }
        }*/
    }

    function closeAndReject(event) {

        closeAllLists(event ? event.target : null);

        if (reject_other && !autocompleted) {

            input.value                             = '';

        }
    }



    document.addEventListener("click", function (event) {

        if (event.target != input) {

            closeAndReject(event);

        }
    });



}
