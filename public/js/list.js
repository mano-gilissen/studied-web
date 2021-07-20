


const OBJECT_LIST                               = '#list';
const CLASS_HEADER                              = '.header';

var data_sort_data                              = [];
var test                                        = 'aaa';



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          this.test

        });
    }

    function sort(id) {

        this.data_sort_data['id']               = id;
        this.data_sort_data['mode']             = 'asc';

        this.test                               = 'bbb';

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER, function() {

        sort($(this).attr('id'));

    });



    load();



});
