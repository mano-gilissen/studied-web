


const OBJECT_LIST                               = '#list';
const CLASS_SORT_MODE_NONE                      = '.none';

var data_sort                                   = {};



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          data_sort

        });
    }

    function sort(id) {

        this.data_sort['mode']                  = this.data_sort['id'] == id ? (this.data_sort['mode'] == 'desc' ? 'asc' : 'desc'): 'desc';
        this.data_sort['id']                    = id;

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER + ":not(" + CLASS_SORT_MODE_NONE + ")", function() {

        sort($(this).attr('id'));

    });



    load();



});
