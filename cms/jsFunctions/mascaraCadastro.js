//Após o $ é o id ou a classe na qual se deseja implementar a função de máscara
//No .mask os números que o usário digita são representados pelos zeros
//Máscara de celular
$('#input_celular').mask('(00) 00000-0000');
//Máscara de telefone
$('#input_telefone').mask('(00) 0000-0000');
//Máscara de CPF
$('#input_cpf').mask('000.000.000-00');
//Máscara data de nascimento
$('#input_dtNasc').mask('00/00/0000');
//Máscara numero registro
$('#numero_registro').mask('000.000.000');
//Máscara salário
$(document).ready(function()
{
    //Máscara Salário
     $("#salario").maskMoney({
         decimal: ",",
         thousands: "."
     });

    //Máscara Preço
    $("#preco").maskMoney({
         decimal: ",",
         thousands: "."
     });
    
});


//Máscara conta corrente
$('#conta_corrente').mask('00000000-0');
