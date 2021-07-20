


const OBJECT_LIST                               = '#list';

const CLASS_HEADER                              = '.header';



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          data_sort

        });
    }

    function sort(id) {

        data_sort['id']                         = id;
        data_sort['mode']                       = 'asc';

        load();
    }



    $(CLASS_HEADER).click(function(event) {

        sort(event.target.id);

    });



    load();

});
