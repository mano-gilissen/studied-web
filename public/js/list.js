




var data_sort                                   = {};
var data_filter                                 = {};

var filters_select_active                       = false;





$(function() {



    load();



    $(OBJECT_LIST).on('click', CLASS_HEADER + ":not(." + ATTR_NO_SORT + ")", function() {

        if (!filters_select_active) {

            sort($(this).attr('id'));

        }
    });



    $(OBJECT_LIST).on('click', CLASS_HEADER + ":not(." + ATTR_NO_FILTER + ")", function() {

        if (filters_select_active) {

            filter_input($(this).attr('id'));

        }
    });



    $(OBJECT_FILTERS).on('click', CLASS_FILTER, function() {

       if (!filters_select_active) {

           filter_remove($(this).attr('id'));

       }
    });



    $(OBJECT_BUTTON_FILTER_ADD).on('click', function() {

        if (!filters_select_active) {

            filters_open();

        } else {

            filters_close();

        }
    });



});





function load() {

    $(OBJECT_LIST).load('/load/' + data_type + '/list', {

        data_sort:                          data_sort,
        data_filter:                        data_filter

    });

    $(OBJECT_FILTERS).load('/load/' + data_type + '/filter', {

        data_filter:                        data_filter

    });
}



function sort(column) {

    this.data_sort                          = {[column] : (this.data_sort[column] ? (this.data_sort[column] == 'desc' ? 'asc' : 'desc') : 'desc')};

    load();
}



function filter(value, column) {

    if (value !== '') {

        this.data_filter[column]            = value;

        filters_close();

        load();
    }
}



function filters_open() {

    filters_select_active                   = true;

    $(CLASS_HEADER).addClass(ATTR_SELECT_FILTER);

    $(OBJECT_ITEMS).addClass(ATTR_SELECT_FILTER);
    $(OBJECT_ACTIONS).addClass(ATTR_SELECT_FILTER);
    $(OBJECT_COUNTERS).addClass(ATTR_SELECT_FILTER);
}



function filters_close() {

    filters_select_active                   = false;

    $(OBJECT_HEADERS + ' ' + CLASS_FILTER).hide();

    $(CLASS_HEADER).removeClass(ATTR_SELECT_FILTER);

    $(OBJECT_ITEMS).removeClass(ATTR_SELECT_FILTER);
    $(OBJECT_ACTIONS).removeClass(ATTR_SELECT_FILTER);
    $(OBJECT_COUNTERS).removeClass(ATTR_SELECT_FILTER);
}



function filter_remove(column) {

    delete this.data_filter[column];

    load();
}



function filter_input(column) {

    $(OBJECT_HEADERS + ' ' + CLASS_FILTER + ':not(#filter_' + column + ')').hide();
    $('#filter_' + column).show();
    $('#filter_input_' + column).focus();
}
