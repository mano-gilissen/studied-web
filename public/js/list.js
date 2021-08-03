


var data_sort                                   = {};
var data_filter                                 = {};



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



    $(OBJECT_LIST).on('click', CLASS_HEADER + ":not(" + ATTR_NONE + ")", function() {

        sort($(this).attr('id'));

    });

    $('#button-filter-add').on('click', function() {

        //

    });



    load();



});
