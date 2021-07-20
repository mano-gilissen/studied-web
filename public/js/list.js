


const OBJECT_LIST                               = '#list';
const CLASS_HEADER                              = '.header';

var data                                        = {};



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, data);
    }

    function sort(id) {

        this.data['data_sort']['id']            = id;
        this.data['data_sort']['mode']          = 'asc';

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER, function() {

        sort($(this).attr('id'));

    });



    load();



});
