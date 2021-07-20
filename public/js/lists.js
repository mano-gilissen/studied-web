


const OBJECT_LIST                               = '#list';



$(function(){



    $(OBJECT_LIST).click(function() {

        $(OBJECT_LIST).load('/load/list', {data_type: 'study',test: 1234321});

    });



});
