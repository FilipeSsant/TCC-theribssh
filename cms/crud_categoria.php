<?php
    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 7";
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
    $icone = "";
    //A variavel $imagemContinua serve para verificação de uma imagem que não quer ser alterada
    //assim pega a do banco e deixa como já esta
    $imagemContinua = 0;

    //Caso for cadastro se tornar requirido o campo imagem
    $requirido = "required";

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
        <link rel="stylesheet" href="css/crud_categoria.css">
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
            <?php include_once('jsFunctions/popup.js');?>
            //Pegar dados do file para preview da imagem
            <?php include_once('jsFunctions/previewImagemUmInput.js');?>


            <?php
                //Pega o modo que esta sendo passado na url
                if(isset($_GET['modo'])){
                    //Pega os objetos após a ? e guarda na variavel
                    $modo = $_GET['modo'];
                    $id = $_GET['id'];

                    //Esse switch serve para usando a variavel modo tenha varios resultados
                    switch($modo){
                        //Case para deletar um registro
                        case 'deletar':
                            //Deleta o item usando seu id
                            $sql = "delete from tbl_categoria where id_categoria = ".$id;
                            mysql_query($sql);
                            //Unlink que exclui a imagem da pasta
                            unlink($_GET['linkimg']);
                            //Voltar para o php sem dados na url
                            header('location:crud_categoria.php');
                            break;
                        //Case para alterar um item
                        case 'alterar':
                            //Guarda o id na sessão
                            $_SESSION['idCategoria'] = $id;
                            //Campo imagem não requirido
                            $requirido = "";
                            //Muda o titulo do PopUp
                            $tituloPopUp = "Alterar";
                            //Puxa os dados referente ao id
                            $sql = "select * from tbl_categoria where id_categoria = ".$id;
                            $select = mysql_query($sql);
                            if($rs = mysql_fetch_array($select)){
                                $nome = $rs['nome'];
                                $icone = $rs['imagem'];
                                $_SESSION['imagem'] = $icone;
                            }

                            ?>
                                $(document).ready(function(){
                                    abrirPopUp();
                                });
                            <?php

                            //Muda o value do botão
                            $valueBotao = "Alterar";
                            break;

                    }

                }
            ?>

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/crud_categoria/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                //Insere os dados
                if(isset($_POST['btnCadastrar_categoria'])){
                    //Resgata os valores
                    $nome = $_POST["txt_nomeCategoria"];

                    //Guarda a pasta de destino em uma variavel
                    $uploaddir = "arquivos/icones_categorias/";

                    //Pega o nome das fotos enviadas e guarda em uma variavel
                    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
                    $arquivo = strtolower(basename($_FILES['filesimagemicone']['name']));

                    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
                    $uploadfile = $uploaddir.$arquivo;

                    if($_POST['btnCadastrar_categoria'] == 'Cadastrar'){
                        //Verificar a extensão
                        if(strstr($uploadfile, '.png')){
                            //Move o arquivo para a pasta de destino
                            if(move_uploaded_file($_FILES['filesimagemicone']['tmp_name'], $uploadfile)){
                                $sql = "insert into tbl_categoria (nome, imagem)";
                                $sql = $sql." values('".$nome."', '".$uploadfile."')";
                                if(mysql_query($sql) or die(mysql_error())){
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
                                              window.location = "crud_categoria.php";
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
                                                window.location = "crud_categoria.php";
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
                                            window.location = "crud_categoria.php";
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
                                        window.location = "crud_categoria.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }elseif($_POST['btnCadastrar_categoria'] == 'Alterar'){

                        if($arquivo == null){
                            $uploadfile = $_SESSION['imagem'];
                            $imagemContinua = 1;
                        }

                        //Verificar a extensão
                        if((strstr($uploadfile, '.png')) || ($imagemContinua == 1)){
                            //Move o arquivo para a pasta de destino
                            if((move_uploaded_file($_FILES['filesimagemicone']['tmp_name'], $uploadfile)) || ($imagemContinua == 1)){
                                $sql="update tbl_categoria set nome = '".$nome."', imagem = '".$uploadfile."' where id_categoria = ".$_SESSION['idCategoria'];

                                if(mysql_query($sql) or die(mysql_error())){
                                    unset($_SESSION['idCategoria'], $_SESSION['imagem']);
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
                                              window.location = "crud_categoria.php";
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
                                                window.location = "crud_categoria.php";
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
                                            window.location = "crud_categoria.php";
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
                                        window.location = "crud_categoria.php";
                                    }, 1800);
                                </script>
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
                        Crud de Categoria
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/categoriasIcon.png" alt="">
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
                            <div class="titulo_colunaImagem">
                                Ícone
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Seleciona os cargos existentes no banco
                            $sql = "select * from tbl_categoria";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs = mysql_fetch_array($select)){
                                $id = $rs['id_categoria'];
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nome']); ?>
                            </div>
                            <div class="conteudo_colunaImagem">
                                <div class="tabela_conteudoVideoImagem">
                                    <img src="<?php echo($rs['imagem']); ?>" alt="">
                                </div>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_categoria.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_categoria.php?id=<?php echo($id); ?>&linkimg=<?php echo($rs['imagem']); ?>&modo=deletar">
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
