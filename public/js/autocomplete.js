


function autocomplete(input, values) {

    var currentFocus;

    console.log(input);

    input.addEventListener("input", function(e) {

        var list,
            item,
            index,
            val                                     = this.value;

        closeAllLists();

        if (!val) {

            return false

        }

        currentFocus = -1;

        list                                        = document.createElement("DIV");
        list                                        .setAttribute("id", this.id + "autocomplete-list");
        list                                        .setAttribute("class", "autocomplete-items");

        this.parentNode.appendChild(list);

        for (index = 0; index < values.length; index++) {

            if (values[index].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                item                                = document.createElement("DIV");

                item.innerHTML                      = "<span style='font-weight: 600'>" + values[index].substr(0, val.length) + "</span>";
                item.innerHTML                      += values[index].substr(val.length);
                item.innerHTML                      += "<input type='hidden' value='" + values[index] + "'>";

                item.addEventListener("click", function(e) {

                    input.value                     = this.getElementsByTagName("input")[0].value;

                    closeAllLists();
                });

                list.appendChild(item);
            }
        }
    });



    input.addEventListener("keydown", function(e) {

        var list                                    = document.getElementById(this.id + "autocomplete-list");

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
        }
    });



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

        list[currentFocus].classList.add("autocomplete-active");
    }



    function removeActive(list) {

        for (var index = 0; index < list.length; index++) {

            list[index].classList.remove("autocomplete-active");

        }
    }



    function closeAllLists(element) {

        var list                                    = document.getElementsByClassName("autocomplete-items");

        for (var index = 0; index < list.length; index++) {

            if (element != list[index] && element != input) {

                list[index].parentNode.removeChild(list[index]);

            }
        }
    }



    document.addEventListener("click", function (e) {

        closeAllLists(e.target);

    });



}
