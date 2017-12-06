<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 8";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $nome = "";
	$login = "";
	$senha = "";
    $numeroRegistro = "";
    $dtNasc = "";
    $selectCargo = "";
    $email = "";
    $seletorDoEstado = "";
    $salario = "";
    $cpf = "";
    $telefone = "";
    $celular = "";
    $logradouro = "";
    $rua = "";
    $diaPagamento = "";
    $bairro = "";
    $sexo = "";
    $numeroResidencia = "";
    $bloco = "";
    $idEndereco = "";
    $selectCidade = "";
    $selectBanco = "";
    $apartamento = "";
    $foto = "";
    $comissaoGarcom = "";
    $aparecerCaixa = "none";
    $agencia = "";
    $contaCorrente = "";
    //A variavel $imagemContinua serve para verificação de uma imagem que não quer ser alterada
    //assim pega a do banco e deixa como já esta
    $imagemContinua = 0;

    //Muda o titulo do PopUp
	$tituloPopUp = "Cadastrar";
	//Muda o value do botão
	$valueBotao = "Cadastrar";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/crud_funcionarios.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskmoney.js" ></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            //Inclui o pop up do cadastro da página
            <?php include_once('jsFunctions/popup.js');?>
            //Inclui as máscaras das inputs
            <?php include_once('jsFunctions/mascaraCadastro.js');?>
            //Inclui o mostrar senha
            <?php include_once('jsFunctions/mostrarSenha.js');?>
            //Pegar dados do file para preview da imagem
            <?php include_once('jsFunctions/previewImagemUmInput.js');?>

            function aumentarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"900px"});
            }

            function normalizarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"75px"});
            }

            //Colocar o campo com uma determinada restrição
            function semEspaco(caractere){

                //Se o navegador for firefox ou chrome
                c1 = caractere.keyCode;
                //Se o navegador for internet
                c2 = caractere.which;

                if(c1 == 32 || c2 == 32){
                    caractere.preventDefault();
                }
                return true;

            }

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/crud_funcionarios/popUp.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_funcionario'])){

                    //Resgata os valores
                    $nome = strtoupper($_POST['txt_nomeFuncionario']);
                    $login = $_POST['txt_login'];
                    $senha = $_POST['txt_senha'];
                    $confSenha = $_POST['txt_confirmarSenha'];
                    $email = $_POST['txt_email'];
                    $numeroRegistro = $_POST['txt_numRegistro'];
                    $dtNasc = $_POST['txt_dtNasc'];
                    @$selectCargo = $_POST['selectCargo'];
                    @$selectRestaurante = $_POST['selectRestaurante'];
                    @$selectBanco = $_POST['selectBandeiraDoCartao'];
                    $salario = $_POST['txt_salario'];
                    $diaPagamento = $_POST['txt_diapagamento'];
                    $cpf = $_POST['txt_cpf'];
                    $sexo = $_POST['sexo'];
                    $telefone = $_POST['txt_telefone'];
                    $celular = $_POST['txt_celular'];
                    $logradouro = $_POST['txt_logradouro'];
                    @$selectCidade = $_POST['selectCidade'];
                    $rua = $_POST['txt_rua'];
                    $bairro = $_POST['txt_bairro'];
                    $numeroResidencia = $_POST['txt_numeroResidencia'];
                    $bloco = $_POST['txt_bloco'];
                    $apartamento = $_POST['txt_ap'];
                    $comissaoGarcom = $_POST['txt_comissao'];
                    $apBloco = $apartamento."-".$bloco;
                    $agencia = $_POST['txt_agencia'];
                    $contaCorrente = $_POST['txt_contaCorrente'];

                    if($comissaoGarcom == null){
                        $comissaoGarcom = 0;
                    }else{
                        $comissaoGarcom = $_POST['txt_comissao'];
                    }

                    //Guarda a pasta de destino em uma variavel
                    $uploaddir = "arquivos/foto_perfilFuncionario/";

                    //Pega o nome das fotos enviadas e guarda em uma variavel
                    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
                    $arquivo = strtolower(basename($_FILES['filesimagemperfil']['name']));
                    $arquivo = str_replace(" ", "_", $arquivo);

                    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
                    $uploadfile = $uploaddir.$arquivo;
                    $extensoes = strstr($uploadfile, '.jpg') || strstr($uploadfile, '.png') || strstr($uploadfile, '.jpeg');

                    //usa o comando explode para separar em vetor as informações
                    //que estão agrupadas por "/"
                    $partes = explode("/", $dtNasc);
                    //Dia
                    $dia = $partes[0];
                    //Mês
                    $mes = $partes[1];
                    //Ano
                    $ano = $partes[2];

                    $dtNascBanco = $ano."-".$mes."-".$dia;

                    $salarioBanco = str_replace('.','',$salario);
                    $salarioBanco = str_replace(',','.',$salarioBanco);

                    $comissaoGarcom = str_replace('%', "", $comissaoGarcom);

                    if($_POST['btnCadastrar_funcionario'] == 'Cadastrar'){
                        //Verificar a extensão
                        if($extensoes){
                            //Move o arquivo para a pasta de destino
                            if(move_uploaded_file($_FILES['filesimagemperfil']['tmp_name'], $uploadfile)){

                                if($senha == $confSenha){
                                    if($diaPagamento < 30 || $diaPagamento < 1){
                                        if($comissaoGarcom <= 100){
                                            //Insere na tabela endereço
                                            $sql = "insert into tbl_endereco (id_cidade, logradouro, bairro, rua, aptbloco, numero)";
                                            $sql = $sql." values(".$selectCidade.", '".$logradouro."', '".$bairro."', '".$rua."', '".$apBloco."', '".$numeroResidencia."')";

                                            mysql_query($sql);

                                            $idEndereco = mysql_insert_id();

                                            //Insere na tabela de funcionario
                                            $sql = "insert into tbl_funcionario (id_restaurante, id_cargo, id_endereco, cpf, nome_completo, num_registro, sexo, telefone, celular, salario, dt_nasc, statusMDM,  foto, email, dia_pagamento, login, senha, comissao)";
                                            $sql = $sql."values (".$selectRestaurante.", ".$selectCargo.", ".$idEndereco.", '".$cpf."', '".$nome."', '".$numeroRegistro."', '".$sexo."', '".$telefone."', '".$celular."', ".$salarioBanco.", '".$dtNascBanco."', 0, '".$uploadfile."', '".$email."', '".$diaPagamento."', '".$login."', '".$senha."', ".$comissaoGarcom."/100)";

                                            mysql_query($sql) or die(mysql_error());

                                            $idFuncionarioInsert = mysql_insert_id();

                                            //Insere na tabela conta bancária
                                            $sql = "insert into tbl_contabancaria (id_funcionario, id_banco, agencia, conta_corrente)";
                                            $sql = $sql." values (".$idFuncionarioInsert.", ".$selectBanco.", '".$agencia."', '".$contaCorrente."')";

                                            if(mysql_query($sql) or die(mysql_error())){
                                                ?>
                                                    <script>
                                                        swal({
                                                          title: "Sucesso!",
                                                          text: "Funcionário Cadastrado!",
                                                          type: "success",
                                                          icon: "success",
                                                          button: {
                                                                     text: "Ok",
                                                                 },
                                                          closeOnEsc: true,
                                                      });
                                                      //Voltar para o php sem dados na url
                                                      setTimeout(function(){
                                                          window.location = "crud_funcionarios.php";
                                                      }, 1800);
                                                    </script>
                                                <?php
                                            }else{
                                                ?>
                                                    <script>
                                                        swal({
                                                          title: "Erro!",
                                                          text: "Houve um erro no nosso Banco de Dados.",
                                                          type: "error",
                                                          icon: "error",
                                                          button: {
                                                                     text: "Ok",
                                                                   },
                                                          closeOnEsc: true,
                                                        });
                                                        //Voltar para o php sem dados na url
                                                        setTimeout(function(){
                                                            window.location = "crud_funcionarios.php";
                                                        }, 1800);
                                                    </script>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                                <script>
                                                    swal({
                                                      title: "Erro!",
                                                      text: "A porcentagem vai até 100",
                                                      type: "error",
                                                      icon: "error",
                                                      button: {
                                                                 text: "Ok",
                                                               },
                                                      closeOnEsc: true,
                                                    });
                                                    //Voltar para o php sem dados na url
                                                    setTimeout(function(){
                                                        window.location = "crud_funcionarios.php";
                                                    }, 1800);
                                                </script>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Erro!",
                                                  text: "O dia do pagamento está errado!",
                                                  type: "error",
                                                  icon: "error",
                                                  button: {
                                                             text: "Ok",
                                                           },
                                                  closeOnEsc: true,
                                                });
                                                //Voltar para o php sem dados na url
                                                setTimeout(function(){
                                                    window.location = "crud_funcionarios.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }
                                }else{
                                   ?>
                                        <script>
                                            swal({
                                              title: "Erro!",
                                              text: "Senhas não coincidem!",
                                              type: "error",
                                              icon: "error",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            });
                                            //Voltar para o php sem dados na url
                                            setTimeout(function(){
                                                window.location = "crud_funcionarios.php";
                                            }, 1800);
                                        </script>
                                    <?php
                                }

                            }else{
                                ?>
                                    <script>
                                        swal({
                                          title: "Erro!",
                                          text: "Um dos arquivos não foram enviados.",
                                          type: "error",
                                          icon: "error",
                                          button: {
                                                     text: "Ok",
                                                   },
                                          closeOnEsc: true,
                                        });
                                        //Voltar para o php sem dados na url
                                        setTimeout(function(){
                                            window.location = "crud_funcionarios.php";
                                        }, 1800);
                                    </script>
                                <?php
                            }
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Extensão Inválida!",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_funcionarios.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }elseif($_POST['btnCadastrar_funcionario'] == 'Alterar'){

                        if($arquivo == null){
                            $uploadfile = $_SESSION['imagem'];
                            $uploadfile = strtolower($uploadfile);
                            $imagemContinua = 1;
                        }

                        //Verificar a extensão
                        if(($extensoes) || ($imagemContinua == 1)){
                            //Move o arquivo para a pasta de destino
                            if((move_uploaded_file($_FILES['filesimagemperfil']['tmp_name'], $uploadfile)) || ($imagemContinua == 1)){
                                if($senha == $confSenha){
                                    if($diaPagamento < 30 || $diaPagamento < 1){
                                        if($comissaoGarcom <= 100){
                                            //Altera a tabela endereço
                                            $sql = "update tbl_endereco set id_cidade = ".$selectCidade.", logradouro = '".$logradouro."', bairro = '".$bairro."', rua = '".$rua."', aptbloco = '".$apBloco."', numero = '".$numeroResidencia."' where id_endereco  = ".$_SESSION['idEndereco'];

                                            mysql_query($sql);

                                            //Altera a tabela conta bancária
                                            $sql = "update tbl_contabancaria set id_funcionario = ".$_SESSION['idCrudF'].", id_banco = ".$selectBanco.", agencia = '".$agencia."', conta_corrente = '".$contaCorrente."' where id_funcionario = ".$_SESSION['idCrudF'];

                                            mysql_query($sql);

                                            //Altera a tabela de funcionario
                                            $sql = "update tbl_funcionario set id_restaurante = ".$selectRestaurante.", id_cargo = ".$selectCargo.", id_endereco = ".$_SESSION['idEndereco'].", cpf = '".$cpf."', nome_completo = '".$nome."', num_registro = '".$numeroRegistro."', sexo = '".$sexo."', telefone = '".$telefone."', celular = '".$celular."', salario = ".$salarioBanco.", dt_nasc = '".$dtNascBanco."', foto = '".$uploadfile."', email = '".$email."', dia_pagamento = '".$diaPagamento."', login = '".$login."', senha = '".$senha."', comissao = ".$comissaoGarcom."/100 where id_funcionario  = ".$_SESSION['idCrudF'];

                                            if(mysql_query($sql) or die(mysql_error())){
                                                unset($_SESSION['idCrudF']);
                                                unset($_SESSION['idEndereco']);
                                                unset($_SESSION['imagem']);
                                                ?>
                                                    <script>
                                                        swal({
                                                          title: "Sucesso!",
                                                          text: "Dados do funcionário alterados!",
                                                          type: "success",
                                                          icon: "success",
                                                          button: {
                                                                     text: "Ok",
                                                                 },
                                                          closeOnEsc: true,
                                                      });
                                                      //Voltar para o php sem dados na url
                                                      setTimeout(function(){
                                                          window.location = "crud_funcionarios.php";
                                                      }, 1800);
                                                    </script>
                                                <?php
                                            }else{
                                                ?>
                                                    <script>
                                                        swal({
                                                          title: "Erro!",
                                                          text: "Houve um erro no nosso Banco de Dados.",
                                                          type: "error",
                                                          icon: "error",
                                                          button: {
                                                                     text: "Ok",
                                                                   },
                                                          closeOnEsc: true,
                                                        });
                                                        //Voltar para o php sem dados na url
                                                        setTimeout(function(){
                                                            window.location = "crud_funcionarios.php";
                                                        }, 1800);
                                                    </script>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                                <script>
                                                    swal({
                                                      title: "Erro!",
                                                      text: "A porcentagem vai até 100",
                                                      type: "error",
                                                      icon: "error",
                                                      button: {
                                                                 text: "Ok",
                                                               },
                                                      closeOnEsc: true,
                                                    });
                                                    //Voltar para o php sem dados na url
                                                    setTimeout(function(){
                                                        window.location = "crud_funcionarios.php";
                                                    }, 1800);
                                                </script>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Erro!",
                                                  text: "O dia do pagamento está errado!",
                                                  type: "error",
                                                  icon: "error",
                                                  button: {
                                                             text: "Ok",
                                                           },
                                                  closeOnEsc: true,
                                                });
                                                //Voltar para o php sem dados na url
                                                setTimeout(function(){
                                                    window.location = "crud_funcionarios.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }
                                }else{
                                   ?>
                                        <script>
                                            swal({
                                              title: "Erro!",
                                              text: "Senhas não coincidem!",
                                              type: "error",
                                              icon: "error",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            });
                                            //Voltar para o php sem dados na url
                                            setTimeout(function(){
                                                window.location = "crud_funcionarios.php";
                                            }, 1800);
                                        </script>
                                    <?php
                                }
                            }else{
                                ?>
                                    <script>
                                        swal({
                                          title: "Erro!",
                                          text: "Um dos arquivos não foram enviados.",
                                          type: "error",
                                          icon: "error",
                                          button: {
                                                     text: "Ok",
                                                   },
                                          closeOnEsc: true,
                                        });
                                        //Voltar para o php sem dados na url
                                        setTimeout(function(){
                                            window.location = "crud_funcionarios.php";
                                        }, 1800);
                                    </script>
                                <?php
                            }
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Extensão Inválida!",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_funcionarios.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }
                }
            
                //Pega o modo que esta sendo passado na url
                if(isset($_GET['modo'])){
                    //Pega os objetos após a ? e guarda na variavel
                    $modo = $_GET['modo'];
                    $id = $_GET['id'];
                    $idSession = $_SESSION['id_funcionario'];
            
                    //deletar um registro
                    if($modo == 'deletar'){
                        $idEndF = "";


                        if($id == $idSession){
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Não é possivel excluir o usuário em sessão.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_funcionarios.php";
                                    }, 3000);
                                </script>
                            <?php
                        }else{
                            //Seleciona o idEndereco
                            $sql = "select id_endereco from tbl_funcionario where id_funcionario = ".$id;
                            $select = mysql_query($sql);
                            if($rs=mysql_fetch_array($select)){
                                $idEndF = $rs['id_endereco'];
                            }
                            //Deleta da conta bancaria
                            $sql = "delete from tbl_contabancaria where id_funcionario = ".$id;
                            mysql_query($sql);
                            //Deleta o endereço do funcionario
                            $sql = "delete from tbl_endereco where id_endereco = ".$idEndF;
                            //Deleta o item usando seu id
                            $sql = "delete from tbl_funcionario where id_funcionario = ".$id;
                            mysql_query($sql);
                            //Unlink que exclui a imagem da pasta
                            unlink($_GET['linkimg']);
                            //Voltar para o php sem dados na url
                            ?>
                                <script>window.location = "crud_funcionarios.php";</script>
                            <?php
                        }
                    }
                }

            ?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Crud de Funcionários
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/funcionariosIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Tabela-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome Completo
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Cargo
                            </div>
                            <div class="titulo_coluna">
                                Restaurante
                            </div>
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php

                            //Comando SQL
                            $sql = "select f.id_funcionario, substr(f.nome_completo, 1, 30) as 'nome_completo', f.foto, f.statusMDM, f.num_registro, c.nome as 'nomeCargo',
                                    r.nome as 'nomeRestaurante' from tbl_funcionario as f
                                    inner join tbl_cargo as c on f.id_cargo = c.id_cargo
                                    inner join tbl_restaurante as r on f.id_restaurante = r.id_restaurante order by nomeCargo";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs=mysql_fetch_array($select)){
                                $idF = $rs['id_funcionario'];
                                $nomeF = $rs['nome_completo'];
                                $numRF = $rs['num_registro'];
                                $nomeCargoF = $rs['nomeCargo'];
                                $nomeRestF = $rs['nomeRestaurante'];
                                $statusCozinheiroMes = $rs['statusMDM'];


                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <span class="centralizar_texto"><?php echo($nomeF); ?></span>
                            </div>
                            <div class="conteudo_colunaPoucosCampos">
                                <span class="centralizar_texto"><?php echo($nomeCargoF); ?></span>
                            </div>
                            <div class="conteudo_coluna">
                                <span class="centralizar_texto"><?php echo($nomeRestF); ?></span>
                            </div>
                            <div class="coluna_3opcoes">
                                <?php
                                    if($nomeCargoF == 'Cozinheiro'){

                                        if($statusCozinheiroMes == '0'){
                                            $imgAtivarDesativar = 'img/cozinheiroMesDesativado.png';
                                        }else{
                                            $imgAtivarDesativar = 'img/cozinheiroMesAtivado.png';
                                        }
                                ?>
                                        <!--Ativar cozinheiro do mês-->
                                        <a href="crud_funcionarios.php?modo=ativarMDM&id=<?php echo($idF); ?>">
                                            <div class="opcao_registro">
                                                <div class="imagem_opcao">
                                                    <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Cozinheiro do Mês">
                                                </div>
                                            </div>
                                        </a>
                                <?php
                                    }else{
                                ?>
                                        <!--Nulo-->
                                        <div class="opcao_registro">
                                            <div class="imagem_opcao">
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <!--Alterar-->
                                <a href="crud_funcionarios.php?modo=alterar&id=<?php echo($idF); ?>">
                                    <div class="opcao_registro" onclick="abrirPopUp(), aumentarFooter()">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_funcionarios.php?modo=deletar&linkimg=<?php echo($rs['foto']); ?>&id=<?php echo($idF); ?>">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/apagar.png" alt="" title="Apagar">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar3" onclick="abrirPopUp(), aumentarFooter()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Funcionário">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
