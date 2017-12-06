$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            //FileReader lê arquivos locais do input file
            var reader = new FileReader();
            //Carrega a função com o resultado do reader
            reader.onload = function (e) {
                //Da um attr no src da div com o resultado
                $("#imagem").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    /* Ambos utilizam a função on para pegar o onchange do botão (se for modificado o conteudo dentro)*/
    //Se for o botão superior
    $("#btn_img").on('change',function(){
        //Envia para a função o link do file e o id do img
        readURL(this);
    });
});