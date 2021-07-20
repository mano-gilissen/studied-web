


const OBJECT_LIST                               = '#list';



$(function(){



    $(OBJECT_LIST).click(function() {

        $data_type = "study";

        $(OBJECT_LIST).load('/load/list/' + $data_type, {test: '123454321'});

    });



});
