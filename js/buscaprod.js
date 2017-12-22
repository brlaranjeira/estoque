$('#div-busca').on('click','.span-busca',function () {
    var tp = $(this).hasClass('ref') ? 'ref' : 'txt';
    var vl = document.getElementById('busca-'+tp).value;
    $.ajax('./ajax/buscaprod.php', {
        data: {
            tipo: tp,
            txt: vl
        }, success: function ( response ) {
            debugger;
        }
    });
});
