
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