$(function(){
        $(".botao_mostrar_detalhes").click(function(e){

            var valorTitle = $('.botao_mostrar_detalhes').attr("title");

            if(valorTitle == 1)
            {
              $('.botao_mostrar_detalhes').css({ transform : 'rotate(45deg)' });
              $('.botao_mostrar_detalhes').attr("title" , "2");
              $('.informacoes_produto').attr('hidden');
            }
            else{
              $('.botao_mostrar_detalhes').css({ transform : 'rotate(0deg)' });
              $('.botao_mostrar_detalhes').attr("title" , "1");
              $('.informacoes_produto').removeAttr('hidden');
            }
            e.preventDefault();
            el = $(this).data('element');
            $(el).toggle();
        });
    });
