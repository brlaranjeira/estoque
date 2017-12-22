
$('#div-cadastraprod').on('click','#span-novocontainer',function () {
   $.ajax('./ajax/criacontainer.php',{
       type: 'post',
       success: function ( response ) {
           response = JSON.parse(response);
           var $opt = $('<option>');
           var $select= $('#select-container');
           $opt.attr('id',response.id);
           $opt.attr('selected','');
           $opt.text(response.referencia);
           $select.append($opt);
       }, error: function ( response ) {
           debugger;
       }
   });
});

$('#form-novoprod').submit(function () {
    var url = $(this).attr('action');
    $.ajax(url, {
        method: 'post',
        data: {
            proddesc: document.getElementById('novoprod-desc').value,
            prodobs: document.getElementById('novoprod-obs').value,
            prodvar: document.getElementById('novoprod-var').value,
            containerid: document.getElementById('select-container').value
        }, success: function () {
            carregaProdutos();
        }
    });
    return false;
});

function carregaProdutos () {
    var container = document.getElementById('select-container').value;
    var url = './cadastraprod.php?container=' + container;
    window.location.href = url;
}

$('#select-container').on('change',function () {
    carregaProdutos();
});