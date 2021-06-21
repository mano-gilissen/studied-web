


function autocomplete(input, values, reject_other) {



    var currentFocus,
        autocompleted                               = false;



    input.addEventListener("input", function(e) {

        openList(this);

    });



    input.addEventListener("focus", function(e) {

        openList(this);

    });



    // ADD: OPEN (ENTIRE) DATA LIST ON FOCUS OR CLICK EVENT
    // OR REMOVE: OPEN ENTIRE DATA LIST ON BACKSPACING TO ZERO CHARACTERS (WHEN REJECT_OTHER = TRUE)
    // FIX: SELECTING DATA ITEM BY ARROWS + ENTER. BROKEN FOR BOTH REJECT_OTHER = TRUE AND FALSE



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



    function openList(event) {

        var list,
            item,
            index,
            val                                     = event.value;

        closeAllLists();

        input.parentNode.classList                  .remove("autocomplete");

        autocompleted                               = false;

        if (!val && !reject_other) {

            return false

        }

        currentFocus                                = -1;

        list                                        = document.createElement("DIV");
        list                                        .setAttribute("id", event.id + "-autocomplete-list");
        list                                        .setAttribute("class", "autocomplete-list");

        event.parentNode.parentNode.appendChild(list);

        for (index = 0; index < values.length; index++) {

            if ((!val && reject_other) || values[index].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                item                                = document.createElement("DIV");
                item                                .setAttribute("class", "autocomplete-item");

                if (val && val.length > 0) {

                    item.innerHTML                  = "<span style='color:black;font-weight:400'>" + values[index].substr(0, val.length) + "</span>";
                    item.innerHTML                  += values[index].substr(val.length);

                } else {

                    item.innerHTML                  += values[index];

                }

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

        var list                                    = document.getElementsByClassName("autocomplete-list");

        for (var index = 0; index < list.length; index++) {

            if (element != list[index] && element != input) {

                list[index].parentNode.removeChild(list[index]);

            }
        }
    }

    function closeAndReject(event) {

        closeAllLists(event ? event.target : null);

        console.log(autocompleted ? 'yes' : 'no');

        if (reject_other && !autocompleted) {

            input.value                             = '';

        }
    }



    document.addEventListener("click", function (event) {

        console.log(input.value);
        console.log(autocompleted ? 'yes' : 'no');

        if (event.target == input && !input.value) {

            console.log('a');

            openList(event.target);

        } else {

            console.log('b');

            closeAndReject(event);

        }
    });



}
