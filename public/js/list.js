


const OBJECT_LIST                               = '#list';
const CLASS_HEADER                              = '.header';

var data_sort                                   = [];



$(function(){



    function load() {

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          this.data_sort

        });
    }

    function sort(e) {

        this.data_sort['id']                    = e.target.id;
        this.data_sort['mode']                  = 'asc';

        load();
    }



    $(CLASS_HEADER).click(function(event) {

        sort();

    });



    load();

});
