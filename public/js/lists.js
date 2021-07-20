


const OBJECT_LIST                               = '#list';



$(function(){



    $(OBJECT_LIST).click(function() {

        $(OBJECT_LIST).load('load-study-list', {test:4411});

    });



});
