$('#div-busca').on('click','.span-busca',function () {
    var tp = $(this).hasClass('ref') ? 'ref' : 'txt';
    var vl = document.getElementById('busca-'+tp).value;
    $.ajax('./ajax/buscaprod.php', {
        data: {
            tipo: tp,
            txt: vl
        }, success: function ( response ) {
            response = JSON.parse( response ).produtos;
            for (var i = 0; i < response.length; i++ ) {
                var produto = response[i];
                var $linha = $('<div class="row" />');
                if ( i % 2 == 0 ) {
                    $linha.addClass('even');
                }
                var container = JSON.parse(produto.container);
                $linha.append('<div class="col-xs-12">[' + produto.referencia + ']</div>');
                $linha.append('<div class="col-xs-12">' + produto.descricao + ' ' + produto.observacao + ' (' + response.variacao + ')</div>');
                if (container == null) {
                    $linha.append('<div class="col-xs-12">Não encontrado em nenhuma caixa/sacola</div>');
                } else {
                    $linha.append('<div class="col-xs-12">Caixa/sacola ' + container.referencia + '</div>');
                }
                $('#div-resultados').append($linha);
            }
        }
    });
});
