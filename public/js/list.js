


var filters_select_active                       = false;



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          data_sort,
            data_filter:                        data_filter

        });
    }



    function sort(column) {

        this.data_sort                          = {[column] : (this.data_sort[column] ? (this.data_sort[column] == 'desc' ? 'asc' : 'desc') : 'desc')};

        load();
    }



    function filter(column, value) {

        this.data_filter[column]                = value;

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER + ":not(." + ATTR_NO_SORT + ")", function() {

        if (!filters_select_active) {

            sort($(this).attr('id'));

        }
    });



    $(OBJECT_BUTTON_FILTER_ADD).on('click', function() {

        if (!filters_select_active) {

            filters_open();

        } else {

            filters_close();

        }
    });



    function filters_open() {

        filters_select_active                   = true;

        $(CLASS_HEADER).addClass(ATTR_SELECT_FILTER);

        $(OBJECT_ITEMS).addClass(ATTR_SELECT_FILTER);
        $(OBJECT_ACTIONS).addClass(ATTR_SELECT_FILTER);
        $(OBJECT_COUNTERS).addClass(ATTR_SELECT_FILTER);
    }

    function filters_close() {

        filters_select_active                   = false;

        $(CLASS_HEADER).removeClass(ATTR_SELECT_FILTER);

        $(OBJECT_ITEMS).removeClass(ATTR_SELECT_FILTER);
        $(OBJECT_ACTIONS).removeClass(ATTR_SELECT_FILTER);
        $(OBJECT_COUNTERS).removeClass(ATTR_SELECT_FILTER);
    }



    load();



});
