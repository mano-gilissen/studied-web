




var filters_select_active                       = false;
var filter_search_timeout;

var sort_mobile_column;

const OBJECT_INPUT_FILTER_SEARCH                = '#input-filter-search';
const OBJECT_LOADER                             = '#loader-list';





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

        if (window.innerWidth <= 840) {  // Mobile view

            filters_mobile_pick(); return;

        }

        if (!filters_select_active) {  // Desktop view

            filters_open();

        } else {

            filters_close();

        }
    });



    $(OBJECT_BUTTON_SORT).on('click', function() {

        if (window.innerWidth <= 840) {  // Only for mobile view

            sort_mobile_pick();

        }
    });



    $(OBJECT_APP).on('click', OBJECT_BUTTON_LOAD_MORE, function() {

        append();

    });



    $(OBJECT_APP).on('input', OBJECT_INPUT_FILTER_SEARCH, function() {

        filter_search();

    });



});





function load() {

    $(OBJECT_LOADER)                        .css('display', 'block');
    $(OBJECT_BUTTON_COUNTERS)               .css('opacity', '0.5').css('pointer-events', 'none');

    remove_overlays_mobile();

    let layout                              = (window.innerWidth <= 840) ? 'mobile' : 'desktop';

    $(OBJECT_LIST).load('/load/' + data_type + '/list', {

        data_sort:                          data_sort,
        data_filter:                        data_filter,
        data_search:                        data_search,
        layout:                             layout

    }, function() {

        set_visibility_load_more();

        set_overlays_mobile();

        $(OBJECT_LOADER)                    .css('display', 'none');

    });

    $(OBJECT_COUNTERS).load('/load/' + data_type + '/counters', {

        data_sort:                          data_sort,
        data_filter:                        data_filter,
        data_search:                        data_search,
        layout:                             layout

    }, function() {

        $(OBJECT_BUTTON_COUNTERS)           .css('opacity', '1').css('pointer-events', 'auto');

        set_visibility_load_more();

        set_overlays_mobile();

    });

    $(OBJECT_FILTERS).load('/load/' + data_type + '/filter', {

        data_filter:                        data_filter,
        layout:                             layout

    });
}



function append() {

    $.post('/load/' + data_type + '/list', {

        data_sort:                          data_sort,
        data_filter:                        data_filter,
        data_search:                        data_search,
        data_offset:                        item_count()

    }, function(data) {

        $(OBJECT_ITEMS)                     .children().last().before(data);

        set_visibility_load_more();

    });
}



function csv(type) {

    $.ajax({

        url:                                "/" + type + "/export",
        type:                               "POST",
        cache:                              false,

        data: {
            data_sort:                      data_sort,
            data_filter:                    data_filter,
            data_search:                    data_search
        },

        success: function(response) {

            var blob                        = new Blob([response], { type: 'text/csv;charset=utf-8;' });
            var link                        = document.createElement("a");
            var url                         = URL.createObjectURL(blob);

            link                            .setAttribute("href", url);
            link                            .setAttribute("download", "export_" + type);
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

    if (this.data_sort[column]) {

        switch (this.data_sort[column]) {

            case 'asc':                     this.data_sort = {[column] : 'desc'}; break;
            case 'none':                    this.data_sort = {[column] : 'asc'}; break;
            case 'desc':                    this.data_sort = {}; break;
        }

    } else {

        this.data_sort                      = {[column] : 'asc'};

    }

    load();
}



function sort_mobile_pick() {

    $(OBJECT_SORT_MOBILE + ' ' + OBJECT_SORT_MOBILE_PICK).show();
    $(OBJECT_SORT_MOBILE).css('display', 'grid');

}



function sort_mobile_direction(column) {

    sort_mobile_column = column;

    $(OBJECT_SORT_MOBILE + ' ' + OBJECT_SORT_MOBILE_PICK).hide();
    $(OBJECT_SORT_MOBILE + ' ' + OBJECT_SORT_MOBILE_DIRECTION).show();
}



function sort_mobile(direction) {

    $(OBJECT_SORT_MOBILE).hide();
    $(OBJECT_SORT_MOBILE + ' ' + OBJECT_SORT_MOBILE_PICK).hide();
    $(OBJECT_SORT_MOBILE + ' ' + OBJECT_SORT_MOBILE_DIRECTION).hide();

    this.data_sort                          = {[sort_mobile_column] : direction};

    load();
}



function set_visibility_load_more() {

    if (more_available()) {

        $(OBJECT_BUTTON_LOAD_MORE)          .show();

    } else {

        $(OBJECT_BUTTON_LOAD_MORE)          .hide();

    }
}



function remove_overlays_mobile() {

    if (window.innerWidth <= 840) {

        $(OBJECT_FILTERS_MOBILE).remove();
        $(OBJECT_SORT_MOBILE).remove();
        $(OBJECT_COUNTERS_MOBILE).remove();

    }
}



function set_overlays_mobile() {

    if (window.innerWidth <= 840) {

        $(OBJECT_FILTERS_MOBILE).appendTo('#app');
        $(OBJECT_SORT_MOBILE).appendTo('#app');
        $(OBJECT_COUNTERS).appendTo('#app');

    }
}



function more_available() {

    return item_total() >= 0 ? item_count() < item_total() : true;

}



function item_count() {

    return $(OBJECT_ITEMS).find('.item').length;

}



function item_total() {

    var value                               = $('#counter-total').find('.value').text();

    return value.length > 0 ? value : -1;
}



function filter(value, column) {

    if (value !== '') {

        this.data_filter[column]            = value;

        filters_close();
        filters_mobile_close();

        load();
    }
}



function filter_column_date(id) {

    var after                               = $('#filter_input_' + id + '_after')[0].value;
    var before                              = $('#filter_input_' + id + '_before')[0].value;

    if (before !== '' && after !== '') {

        this.data_filter[id]                = after + ':' + before;

        if (window.innerWidth > 840) {

            filters_close();

            load();
        }
    }

    if (window.innerWidth <= 840) {

        $('.filter-submit-date .button').toggleClass('disabled', after === '' || before === '');

    }
}



function filter_search() {

    this.data_search                        = $(OBJECT_INPUT_FILTER_SEARCH).val();

    if (filter_search_timeout) {

        clearTimeout(filter_search_timeout);

    }

    filter_search_timeout                   = setTimeout(function () { load(); }, 500);
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



function filters_mobile_pick() {

    $(OBJECT_FILTERS_MOBILE + ' ' + OBJECT_FILTERS_MOBILE_PICK).show();
    $(OBJECT_FILTERS_MOBILE).css('display', 'grid');

}



function filters_mobile_open(filter) {

    $(OBJECT_FILTERS_MOBILE + ' ' + OBJECT_FILTERS_MOBILE_PICK).hide();
    $(OBJECT_FILTERS_MOBILE + ' ' + CLASS_FILTER + '#filter_' + filter).show();
    $(OBJECT_FILTERS_MOBILE + ' ' + CLASS_FILTER + '#filter_' + filter + ' input').click();

}



function filters_mobile_close() {

    $(OBJECT_FILTERS_MOBILE).hide();
    $(OBJECT_FILTERS_MOBILE + ' ' + CLASS_FILTER).hide();
    $(OBJECT_FILTERS_MOBILE + ' ' + OBJECT_FILTERS_MOBILE_PICK).hide();

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





function counters_mobile_open() {

    $(OBJECT_COUNTERS).css('display', 'grid');

}



function counters_mobile_close() {

    $(OBJECT_COUNTERS).hide();

}
