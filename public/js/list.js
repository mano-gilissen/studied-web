


const OBJECT_LIST                               = '#list';
const CLASS_HEADER                              = '.header';

var sortt                                        = [];



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          this.sortt

        });
    }

    function sort(id) {

        this.sortt['id']                         = id;
        this.sortt['mode']                       = 'asc';

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER, function() {

        sort($(this).attr('id'));

    });



    load();



});
