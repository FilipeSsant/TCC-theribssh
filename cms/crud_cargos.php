<?php
	session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 9";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $nomeCargo = "";
    $checkPermissao = "";
    $idPermissao = "";

	//Muda o titulo do PopUp
	$tituloPopUp = "Cadastrar";
	//Muda o value do botão
	$valueBotao = "Cadastrar";

    $id="";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $_SESSION["idCargo"] = $id;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/crud_cargos.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            //Inclui o pop up do cadastro da página
            <?php include_once('jsFunctions/popup.js')?>

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/cargos/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_nivel'])){
                    //Resgata os valores
                    $nomeCargo = $_POST['txt_nomeCargo'];
                    $nameInput = "";

                    //Botão Cadastrar
                    if($_POST['btnCadastrar_nivel'] == 'Cadastrar'){
                        //Insert na tabela cargo
                        $sql = "insert into tbl_cargo (nome) values('".$nomeCargo."')";

                        if(mysql_query($sql) or die(mysql_error())){
                            $idCargo = mysql_insert_id();
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
                                        window.location = "crud_cargos.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                        //Seleciona as pemissões existentes no banco
                        $sql = "select * from tbl_permissao";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs = mysql_fetch_array($select)){
                            $nome = $rs['nome'];
                            $retirarAcentos = str_replace('á', 'a', $nome);
                            $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                            $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ó', 'o', $retirarAcentos);
                            $retirarAcentos = str_replace('ô', 'o', $retirarAcentos);
                            $nameInput = str_replace(' ', '_', $retirarAcentos);
                            $nameInput = strtolower($nameInput);

                            //Se for marcado e achado no post a opção das marcações
                            if(isset($_POST[$nameInput])){
                                if($nameInput != null){

                                    $idPermissao = $_POST[$nameInput];
                                    //Insert na tabela relação entre cargo e permissão
                                    $sql2 = "insert into tbl_cargopermissao (id_cargo, id_permissao)";

                                    $sql2 = $sql2." values('".$idCargo."', '".$idPermissao."')";

                                    if(mysql_query($sql2) or die(mysql_error())){
                                    ?>
                                        <script>
                                            swal({
                                              title: "Sucesso!",
                                              text: "Cadastro realizado com Sucesso!",
                                              type: "success",
                                              icon: "success",
                                              button: {
                                                         text: "Ok",
                                                     },
                                              closeOnEsc: true,
                                          });
                                          //Voltar para o php sem dados na url
                                          setTimeout(function(){
                                              window.location = "crud_cargos.php";
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
                                                    window.location = "crud_cargos.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }

                                }else{
                                    $nameInput = "";
                                }
                            }

                        }
                    //Botão Alterar
                    }elseif($_POST['btnCadastrar_nivel'] == 'Alterar'){
                        //O id que é pego da sessão
                        $idHref = $_SESSION["idCargo"];

                        //Update na tabela cargo
                        $sql = "update tbl_cargo set nome = '".$nomeCargo."' where id_cargo = ".$_SESSION['idCargo'];

                        if(mysql_query($sql) or die(mysql_error())){

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
                                        window.location = "crud_cargos.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                        $idCargo = mysql_insert_id();

                        //Deleta os dadados da tabela antes de fazer o insert das novas alterações
                        $sql = "delete from tbl_cargopermissao where id_cargo = ".$idHref;
                        mysql_query($sql);

                        //Seleciona os cargos existentes no banco
                        $sql = "select * from tbl_permissao";

                        $select = mysql_query($sql) or die();

                        while($rs = mysql_fetch_array($select)){
                            $nome = $rs['nome'];
                            $retirarAcentos = str_replace('á', 'a', $nome);
                            $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                            $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ó', 'o', $retirarAcentos);
                            $retirarAcentos = str_replace('ô', 'o', $retirarAcentos);
                            $nameInput = str_replace(' ', '_', $retirarAcentos);
                            $nameInput = strtolower($nameInput);


                            if(isset($_POST[$nameInput])){

                                if($nameInput != null){

                                    $nameInput = $_POST[$nameInput];
                                    //Insert na tabela relação entre cargo e permissão
                                    $sql2 = "insert into tbl_cargopermissao (id_cargo, id_permissao)";

                                    $sql2 = $sql2." values('".$idHref."', '".$nameInput."')";

                                    if(mysql_query($sql2) or die(mysql_error())){
                                        unset($_SESSION["idCargo"]);
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Sucesso!",
                                                  text: "Dados Alterados com sucesso!",
                                                  type: "success",
                                                  icon: "success",
                                                  button: {
                                                             text: "Ok",
                                                         },
                                                  closeOnEsc: true,
                                                  });
                                                  //Voltar para o php sem dados na url
                                                  setTimeout(function(){
                                                      window.location = "crud_cargos.php";
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
                                                    window.location = "crud_cargos.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }


                                }else{
                                    $nameInput = "";
                                }
                            }

                        }

                    }
                }
            
                //Pega o modo que esta sendo passado na url
                if(isset($_GET['modo'])){
                    //Pega os objetos após a ? e guarda na variavel
                    $modo = $_GET['modo'];
                    
                    
                    if($modo == 'deletar'){
                        //Seleciona na tbl_cargo para verificar se aquele id está nos cargos
                        //Obrigatórios requisitados na carta projeto
                        $sql = "select nome from tbl_cargo where id_cargo = ".$id;
                        $select = mysql_query($sql);
                        if($rs=mysql_fetch_array($select)){
                            $nomeCargo = $rs['nome'];

                            if($id == $_SESSION['idCargoFuncionarioU']){
                                ?>
                                    <script>
                                        swal({
                                          title: "Erro!",
                                          text: "Não é possivel excluir o cargo em sessão.",
                                          type: "error",
                                          icon: "error",
                                          button: {
                                                     text: "Ok",
                                                   },
                                          closeOnEsc: true,
                                        });
                                        //Voltar para o php sem dados na url
                                        setTimeout(function(){
                                            window.location = "crud_cargos.php";
                                        }, 3000);
                                    </script>
                                <?php
                            }else{
                                if(($nomeCargo == 'Cozinheiro') || ($nomeCargo == 'Garçom') || ($nomeCargo == 'Recursos Humanos') || ($nomeCargo == 'Administração')){
                                    ?>
                                        <script>
                                            swal({
                                              title: "Erro!",
                                              text: "Este cargo não é permitido a exclusão pois é obrigatório.",
                                              type: "error",
                                              icon: "error",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            });
                                            //Voltar para o php sem dados na url
                                            setTimeout(function(){
                                                window.location = "crud_cargos.php";
                                            }, 3000);
                                        </script>
                                    <?php
                                }else{
                                    //Deleta o item na tabela relação usando seu id
                                    $sql = "delete from tbl_cargopermissao where id_cargo = ".$id;
                                    mysql_query($sql);
                                    //Deleta o item usando seu id
                                    $sql = "delete from tbl_cargo where id_cargo = ".$id;
                                    mysql_query($sql);
                                    //Voltar para o php sem dados na url
                                    ?>
                                        <script>window.location = "crud_cargos.php";</script>
                                    <?php
                                }
                            }
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
                        Crud de Cargos
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/cargosNiveisIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Seleciona os cargos existentes no banco
                            $sql = "select * from tbl_cargo";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs = mysql_fetch_array($select)){
                                $id = $rs['id_cargo'];
                                $nomeCargo = $rs['nome'];
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($nomeCargo); ?>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_cargos.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_cargos.php?id=<?php echo($id); ?>&modo=deletar">
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
                <button id="botao_cadastrar2" onclick="abrirPopUp()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Cargo">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
