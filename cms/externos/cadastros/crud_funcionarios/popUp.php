<!--Ajax para pegar o id selecionado pelo usuário no Estado-->
<script>
    
    
    
    
    //Verificar se o cargo é Garçom
    function verificarCargo(){
        //Coloca na variavel o value que está na caixa
        var idCargoAjax = $("#selectCargo option:checked").val();
        //Coloca na variavel a url que vai redirecionar para fazer o processo
        var url = "../ajax/processo_verificarCargo.php";

        $.ajax({
            //Define o método
            method:"POST",
            //Define a url
            url:url,
            //Coloca em formato JSON as informações para passar pelo POST
            data:{idcargoajax:idCargoAjax},
            success:function(dados){
                //Manda os dados que será concebido como $resultado para a div ou input em questão
                $("#input_comissao").css({"display":""+dados});
                $("#div_cadastro").css({"height":"1600px"});
                $("#div_foraCadastro").css({"height":"1650px"});
            }

        });
    }

    //Verifica o input de login fazendo uma busca em tempo real no banco para compara se o login ja existe
    function verificarLogin(){
        //Coloca na variavel o value que está na caixa
        var dadosLoginAjax = $("#caixa_loginCadastro").val();
        //Coloca na variavel a url que vai redirecionar para fazer o processo
        var url = "../ajax/verificarLogin.php";

        $.ajax({
            //Define o método
            method:"POST",
            //Define a url
            url:url,
            //Coloca em formato JSON as informações para passar pelo POST
            data:{caixalogin:dadosLoginAjax},
            success:function(dados){
                //Manda os dados que será concebido como $resultado para a div ou input em questão
                $(".div_condicao[name='verificar_login']").html(dados);
            }

        });

    }

    //Verifica o input de login fazendo uma busca em tempo real no banco para compara se o login ja existe
    function verificarEmail(){
        //Coloca na variavel o value que está na caixa
        var dadosEmailAjax = $("#caixa_emailCadastro").val();
        //Coloca na variavel a url que vai redirecionar para fazer o processo
        var url = "../ajax/verificarEmail.php";

        $.ajax({
            //Define o método
            method:"POST",
            //Define a url
            url:url,
            //Coloca em formato JSON as informações para passar pelo POST
            data:{caixaemail:dadosEmailAjax},
            success:function(dados){
                //Manda os dados que será concebido como $resultado para a div ou input em questão
                $(".div_condicao[name='verificar_email']").html(dados);
            }

        });
    }

    //Verifica se a senha digitada no "confirmar senha" tem semelhança com a senha que o usuário digitou inicialmente
    function verificarConfSenha(){
        //Coloca na variavel o value que está na caixa
        var dadosSenhaAjax = $("#texto_senha").val();
        var dadosConfSenhaAjax = $("#texto_confirmarSenha").val();
        //Coloca na variavel a url que vai redirecionar para fazer o processo
        var url = "../ajax/verificarSenha.php";

        $.ajax({
            //Define o método
            method:"POST",
            //Define a url
            url:url,
            //Coloca em formato JSON as informações para passar pelo POST
            data:{caixasenha:dadosSenhaAjax, caixaconfirmarsenha:dadosConfSenhaAjax},
            success:function(dados){
                //Manda os dados que será concebido como $resultado para a div ou input em questão
                $(".div_condicao[name='verificar_senha']").html(dados);
            }

        });
    }
</script>
<?php

    //Pega o modo que esta sendo passado na url
    if(isset($_GET['modo'])){
        //Pega os objetos após a ? e guarda na variavel
        $modo = $_GET['modo'];
        $id = $_GET['id'];

            //ativar ou desativar o fucnionario
            if($modo == 'ativarMDM'){
                $quantidade = "";
                //Select para pegar a quantidade de ativações
                $sql = "select count(statusMDM) as 'quantidade' from tbl_funcionario where statusMDM = 1";
                $select = mysql_query($sql) or die(mysql_error());
                if($rs=mysql_fetch_array($select)){
                    $quantidade = $rs['quantidade'];
                }
                $sql = "select statusMDM from tbl_funcionario where id_funcionario = ".$id;
                $select = mysql_query($sql) or die(mysql_error());
                if($rs=mysql_fetch_array($select)){
                    if($rs['statusMDM'] == 0){
                        $sql2 = "update tbl_funcionario set statusMDM = 1 where id_funcionario = ".$id;
                        mysql_query($sql2);
                    }else{
                        //Verifica a quantidade se for maior que 3 (que é o maximo) da uma mensagem de erro
                        if($quantidade == 3){
                            ?>
                                <script>
                                    swal({
                                      title: "Só é permitido a ativação de três cozinheiros",
                                      text: "Desabilite um cozinheiro para poder ativar este.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_redesSociais.php";
                                    }, 5000);
                                </script>
                            <?php
                        }else{
                            $sql2 = "update tbl_funcionario set statusMDM = 0 where id_funcionario = ".$id;
                            mysql_query($sql2);
                        }
                    }
                }
                //Voltar para o php sem dados na url
                ?>
                    <script>window.location = "crud_funcionarios.php";</script>
                <?php
            }

            

            //alterar um item
            if($modo == 'alterar'){
                //Guarda o id na sessão
                $_SESSION['idCrudF'] = $id;
                //Muda o titulo do PopUp
                $tituloPopUp = "Alterar";
                //Puxa os dados referente ao id
                $sql = "select f.cpf, f.nome_completo, f.foto, f.num_registro, f.sexo, f.telefone, f.celular, f.comissao,  format(f.salario,2,'de_DE') as 'salario' , f.dt_nasc, f.email, f.dia_pagamento, f.comissao, f.login, f.senha, c.nome as 'nomeCargo', f.id_cargo, r.nome as 'nomeRestaurante', f.id_restaurante, cid.id_estado,
                e.id_cidade, e.id_endereco, e.logradouro, e.bairro, e.rua, e.aptbloco, e.numero, cb.id_banco, cb.agencia, cb.conta_corrente from tbl_funcionario as f
                inner join tbl_cargo as c on f.id_cargo = c.id_cargo
                inner join tbl_restaurante as r on f.id_restaurante = r.id_restaurante
                inner join tbl_endereco as e on e.id_endereco = f.id_endereco
                inner join tbl_cidade as cid on cid.id_cidade = e.id_cidade
                inner join tbl_contabancaria as cb on cb.id_funcionario = f.id_funcionario where f.id_funcionario = ".$id;
                $select = mysql_query($sql);
                if($rs = mysql_fetch_array($select)){
                    $nome = $rs['nome_completo'];
                    $login = $rs['login'];
                    $idEndereco = $rs['id_endereco'];
                    $senha = $rs['senha'];
                    $numeroRegistro = $rs['num_registro'];
                    $dtNasc = $rs['dt_nasc'];
                    $selectCargo = $rs['id_cargo'];
                    $email = $rs['email'];
                    $sexo = $rs['sexo'];
                    $seletorDoEstado = $rs['id_estado'];
                    $selectRestaurante = $rs['id_restaurante'];
                    $salario = $rs['salario'];
                    $diaPagamento = $rs['dia_pagamento'];
                    $cpf = $rs['cpf'];
                    $telefone = $rs['telefone'];
                    $celular = $rs['celular'];
                    $logradouro = $rs['logradouro'];
                    $rua = $rs['rua'];
                    $bairro = $rs['bairro'];
                    $numeroResidencia = $rs['numero'];
                    $apBloco = $rs['aptbloco'];
                    $selectCidade = $rs['id_cidade'];
                    $comissaoGarcom = $rs['comissao'] * 100;
                    $selectBandeiraCartao = $rs['id_banco'];
                    $agencia = $rs['agencia'];
                    $contaCorrente = $rs['conta_corrente'];

                    $fotoUser = $rs['foto'];

                    $_SESSION['imagem'] = $fotoUser;

                    $_SESSION['idEndereco'] = $idEndereco;

                    //usa o comando explode para separar em vetor as informações
                    //que estão agrupadas por "-"
                    $partesAp = explode("-", $apBloco);
                    $apartamento = $partesAp[0];
                    $bloco = $partesAp[1];

                    //usa o comando explode para separar em vetor as informações
                    //que estão agrupadas por "/"
                    $partesData = explode("-", $dtNasc);
                    //Dia
                    $ano = $partesData[0];
                    //Mês
                    $mes = $partesData[1];
                    //Ano
                    $dia = $partesData[2];

                    $dtNascOriginal = $dia."/".$mes."/".$ano;

                }

                ?>
                    <script>
                        $(document).ready(function(){
                            abrirPopUp();
                            aumentarFooter();
                        });
                    </script>
                <?php

                //Muda o value do botão
                $valueBotao = "Alterar";

                include_once("externos/cadastros/crud_funcionarios/popupAlterar.php");
        }

    }else{
        include_once("externos/cadastros/crud_funcionarios/popupCadastro.php");
    }
?>
