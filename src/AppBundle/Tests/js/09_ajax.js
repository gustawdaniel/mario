$('input[type="submit"]').click(function() {
    $('#choice').val(this.name);
    $('#id').val(this.id);
});

$('form').on('submit',function(e){
    e.preventDefault();
    //console.log("e",e);
    $.ajax({
        type: "POST",
        url: Routing.generate('admin_ajax'),
        data: $(this).serialize(),
        //beforeSend: function(){
        //
        //},
        complete: function() {
            $("#loading").hide();
            console.log('complete');
        },
        success: function(msg) {
            //alert( "Dane zwrotne: " + msg.toString() );
            console.log('succes');
            console.log(msg);
            if(msg['del']){
                $('#'+msg['id']+'.my_row').remove();
            }
            if(msg['add']){
                $('.my_hidden_row').clone().appendTo('table').show();
                //$('textarea').val('');
            }
        },
        error: function() {
            alert( "Wystąpił błąd w połączniu :(");
        }
    });
});


//$('input[type="submit"]').click(function() {
//    console.log('a');
//    console.log($(this).attr("value"));
//    $.ajax({
//        type: "POST",
//        url: Routing.generate('admin_ajax'),
//        data: $(this).attr("value"),
//        complete: function() {
//            $("#loading").hide();
//            console.log('complete');
//        },
//        success: function() {
//            console.log('succes');
//        },
//        error: function() {
//            console.log('Wystąpił błąd w połączniu');
//        }
//    });
//});
