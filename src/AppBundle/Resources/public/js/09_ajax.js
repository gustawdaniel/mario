//    $("input#delete").click(function() {
$('form').on('submit',function(e){
    e.preventDefault();
    console.log('ajax');
    $.ajax({
        type: "POST",
        url: Routing.generate('admin_delete'),
        data: {
            imie: 'Marcin',
            wiek: 'super stary :('
        },
        complete: function() {
            $("#loading").hide();
            console.log('complet A');
            console.log(Routing.generate('admin_delete'));
            console.log('complet B');
        },
        success: function(msg) {
            alert( "Dane zwrotne: " + msg.toString() );
            console.log(msg);
        },
        error: function() {
            console.log('A');
            console.log(Routing.generate('admin_delete'));
            console.log('B');
            alert( "Wystąpił błąd w połączniu :(");
        }
    });
});
