


const OBJECT_LIST                               = '#list';



$(function(){



    /*$(OBJECT_LIST).click(function() {*/



    function load(data_type) {

        $(OBJECT_LIST).load('/load/list/' + data_type, {test: '123454321'});

    }



});
