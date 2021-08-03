


var data_sort                                   = {};
var data_filter                                 = {};



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          data_sort,
          //data_filter:                        data_filter

        });
    }

    function sort(id) {

        this.data_sort                          = {[id] : (this.data_sort[id] ? (this.data_sort[id] == 'desc' ? 'asc' : 'desc') : 'desc')};

      //this.data_filter['host_user']           = id;

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER + ":not(" + ATTR_NONE + ")", function() {

        sort($(this).attr('id'));

    });



    load();



});
