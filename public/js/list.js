




var filters_select_active                       = false;

const COLUMN_DATE                               = 101;





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



    $('#button-load-more').on('click', function() {

        append();

    });



});





function load() {

    $(OBJECT_LIST).load('/load/' + data_type + '/list', {

        data_sort:                          data_sort,
        data_filter:                        data_filter

    });

    $(OBJECT_COUNTERS).load('/load/' + data_type + '/counters', {

        data_sort:                          data_sort,
        data_filter:                        data_filter

    });

    $(OBJECT_FILTERS).load('/load/' + data_type + '/filter', {

        data_filter:                        data_filter

    });
}



function append() {

    $.post('/load/' + data_type + '/list', {

            data_sort:                      data_sort,
            data_filter:                    data_filter,
            data_offset:                    items_count()

        }, function(data) {

            $('#items').append(data);

        }
    );
}



function csv(type, method) {

    $.ajax({

        url:                                "/" + type + "/export/" + method,
        type:                               "POST",
        cache:                              false,

        data: {
            data_sort:                      data_sort,
            data_filter:                    data_filter
        },

        success: function(response) {

            var blob                        = new Blob([response], { type: 'text/csv;charset=utf-8;' });
            var link                        = document.createElement("a");
            var url                         = URL.createObjectURL(blob);

            link                            .setAttribute("href", url);
            link                            .setAttribute("download", "export_" + type + "_" + method);
            link.style.visibility           = 'hidden';

            document.body                   .appendChild(link);
            link                            .click();
            document.body                   .removeChild(link);
        },

        error: function(xhr) {

            console.log('Error downloading CSV export');

        }
    });
}



function sort(column) {

    $mode_sort = 'asc';

    if (this.data_sort[column]) {

        switch (this.data_sort[column]) {

            case 'asc':                     $mode_sort = 'desc'; break;
            case 'desc':                    $mode_sort = 'none'; break;
            case 'none':                    $mode_sort = 'asc'; break;
        }
    }

    this.data_sort                          = {[column] : $mode_sort};

    load();
}



function items_count() {

    return $('#items').children().length;

}



function filter(value, column) {

    if (value !== '') {

        this.data_filter[column]            = value;

        filters_close();

        load();
    }
}



function filter_column_date() {

    var after                               = $('#filter_input_' + COLUMN_DATE + '_after')[0].value;
    var before                              = $('#filter_input_' + COLUMN_DATE + '_before')[0].value;

    if (before !== '' && after !== '') {

        this.data_filter[COLUMN_DATE]       = after + ':' + before;

        filters_close();

        load();
    }
}



function filters_open() {

    filters_select_active                   = true;

    $(CLASS_HEADER)                         .addClass(ATTR_SELECT_FILTER);
    $(OBJECT_ITEMS)                         .addClass(ATTR_SELECT_FILTER);
    $(OBJECT_ACTIONS)                       .addClass(ATTR_SELECT_FILTER);
    $(OBJECT_COUNTERS)                      .addClass(ATTR_SELECT_FILTER);
}



function filters_close() {

    filters_select_active                   = false;

    $(OBJECT_HEADERS + ' ' + CLASS_FILTER)  .hide();

    $(CLASS_HEADER)                         .removeClass(ATTR_SELECT_FILTER);
    $(OBJECT_ITEMS)                         .removeClass(ATTR_SELECT_FILTER);
    $(OBJECT_ACTIONS)                       .removeClass(ATTR_SELECT_FILTER);
    $(OBJECT_COUNTERS)                      .removeClass(ATTR_SELECT_FILTER);
}



function filter_remove(column) {

    delete this.data_filter[column];

    load();
}



function filter_input(column) {

    $(OBJECT_HEADERS + ' ' + CLASS_FILTER + ':not(#filter_' + column + ')').hide();

    $('#filter_' + column)                  .show();
    $('#filter_input_' + column)            .focus();
}
