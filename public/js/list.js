


const OBJECT_LIST                               = '#list';
const CLASS_HEADER                              = '.header';

var data                                        = [];



$(function(){



    function load() {

        Console.log(data);

        $(OBJECT_LIST).load('/load/list/' + data_type, {

            data_sort:                          this.data

        });
    }

    function sort(id) {

        this.data['id']               = id;
        this.data['mode']             = 'asc';

        load();
    }



    $(OBJECT_LIST).on('click', CLASS_HEADER, function() {

        sort($(this).attr('id'));

    });



    load();



});
