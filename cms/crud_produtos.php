<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 6";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Remove a probabilidade de erro com variavel vazia
    $nomeProduto = "";
    $selectCategoria = "";
    $descProduto = "";
    $precoProduto = "";
    $selectIng = "";
    $txt_qtdIng = "";
    $selectTpUnitario = "";

    $idIngredienteGet = "";
    $quantidadeBd = "";
    $idTipoUniBd = "";
    $detalheBd = "";
    //A variavel $imagemContinua serve para verificação de uma imagem que não quer ser alterada
    //assim pega a do banco e deixa como já esta
    $imagemContinua = 0;

    //Caso for cadastro se tornar requirido o campo imagem
    $requirido = "required";

    //Muda o titulo do PopUp
	$tituloPopUp = "Cadastrar";
	//Muda o value do botão
	$valueBotao = "Cadastrar";


    //Muda o titulo do PopUp Adicionar
	$tituloPopUp2 = "Adicionar";
	//Muda o value do botão Adicionar
	$valueBotao2 = "Adicionar";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/crud_produtos.css">
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
            //Pegar dados do file para preview da imagem
            <?php include_once('jsFunctions/previewImagemUmInput.js');?>

            function aumentarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"400px"});
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

            <?php
                //Pega o modo que esta sendo passado na url
                if(isset($_GET['modo'])){
                    //Pega os objetos após a ? e guarda na variavel
                    $modo = $_GET['modo'];
                    $id = $_GET['id'];

                    //Esse switch serve para usando a variavel modo tenha varios resultados
                    switch($modo){
                        //Caso ativar tabela nutricional
                        case 'tabela_nutricional':
                            $sql = "select statusTabelaNuticional from tbl_produto where id_produto = ".$id;
                            $select = mysql_query($sql) or die(mysql_error());
                            if($rs=mysql_fetch_array($select)){
                                if($rs['statusTabelaNuticional'] == 0){
                                    $sql2 = "update tbl_produto set statusTabelaNuticional = 1 where id_produto = ".$id;
                                    mysql_query($sql2);
                                }else{
                                    $sql2 = "update tbl_produto set statusTabelaNuticional = 0 where id_produto = ".$id;
                                    mysql_query($sql2);
                                }
                            }
                            //Voltar para o php sem dados na url
                            ?>
                                window.location = "crud_produtos.php";
                            <?php
                            break;
                        //Case para deletar um registro
                        case 'deletar':
                            //Deleta da tablea relação cardapio
                            $sql = "delete from tbl_cardapioproduto where id_produto = ".$id;
                            mysql_query($sql);
                            //Deleta da tabela relação primeiro
                            $sql = "delete from tbl_ingredienteproduto where id_produto =".$id;
                            mysql_query($sql);
                            //Deleta o item usando seu id
                            $sql = "delete from tbl_produto where id_produto = ".$id." and statusTabelaNuticional != 1";
                            mysql_query($sql);
                            //Unlink que exclui a imagem da pasta
                            unlink($_GET['linkimg']);
                            //Voltar para o php sem dados na url
                            ?>
                                window.location = "crud_produtos.php";
                            <?php
                            break;
                        //Case para alterar um item
                        case 'alterar':
                            //Guarda o id na sessão
                            $_SESSION['idProduto'] = $id;
                            //Campo imagem não requirido
                            $requirido = "";
                            //Puxa os dados referente ao id
                            $sql = "select id_categoria, descricao, nome, imagem, format(preco,2,'de_DE') as 'preco' from tbl_produto where id_produto = ".$id;
                            $select = mysql_query($sql);
                            if($rs = mysql_fetch_array($select)){
                                $nomeProduto = $rs['nome'];
                                $selectCategoria = $rs['id_categoria'];
                                $descProduto = $rs['descricao'];
                                $precoProduto = $rs['preco'];
                                $imgProduto = $rs['imagem'];
                                //Sessão para imagem
                                $_SESSION['imagem'] = $imgProduto;
                            }

                            ?>
                                $(document).ready(function(){
                                    abrirPopUp();
                                    aumentarFooter();
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
        <div id="fundo_transparente" onClick="fecharPopUps()">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/produtos/popupCadastro.php'); ?>
            <?php include_once('externos/cadastros/produtos/popupAdicionar.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                //Insere os dados
                if(isset($_POST['btnCadastrar_produto'])){
                    //Resgata os valores
                    $nomeProduto = $_POST['txt_nomeProduto'];
                    $selectCategoria = $_POST['selectCategoria'];
                    $descProduto = $_POST['txt_descricao'];
                    $precoProduto = $_POST['txt_preco'];

                    //Formata para um modo que o banco leia
                    $precoProdutoBanco = str_replace('.','',$precoProduto);
                    $precoProdutoBanco = str_replace(',','.',$precoProdutoBanco);

                    //Guarda a pasta de destino em uma variavel
                    $uploaddir = "arquivos/foto_produtos/";

                    //Pega o nome das fotos enviadas e guarda em uma variavel
                    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
                    $arquivo = strtolower(basename($_FILES['filesimagemproduto']['name']));

                    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
                    $uploadfile = $uploaddir.$arquivo;
                    $extensoes = strstr($uploadfile, '.jpg') || strstr($uploadfile, '.png') || strstr($uploadfile, '.jpeg');

                    if($_POST['btnCadastrar_produto'] == 'Cadastrar'){
                        //Verificar a extensão
                        if($extensoes){
                            //Move o arquivo para a pasta de destino
                            if(move_uploaded_file($_FILES['filesimagemproduto']['tmp_name'], $uploadfile)){

                                //Insert na tabela produto
                                $sql = "insert into tbl_produto (id_categoria, descricao, nome, imagem, preco, statusAprovacao, statusTabelaNuticional)";

                                $sql = $sql." values(".$selectCategoria.", '".$descProduto."', '".$nomeProduto."', '".$uploadfile."' ,".$precoProdutoBanco.", 0, 0)";

                                if(mysql_query($sql) or die(mysql_error())){
                                    ?>
                                        <script>
                                            swal({
                                              title: "Produto cadastrado!",
                                              text: "Cadastre os ingredientes no segundo botão das opções.",
                                              type: "success",
                                              icon: "success",
                                              button: {
                                                         text: "Ok",
                                                     },
                                              closeOnEsc: true,
                                          });
                                          //Voltar para o php sem dados na url
                                          setTimeout(function(){
                                              window.location = "crud_produtos.php";
                                          }, 3000);
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
                                                window.location = "crud_produtos.php";
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
                                            window.location = "crud_produtos.php";
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
                                        window.location = "crud_produtos.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }elseif($_POST['btnCadastrar_produto'] == 'Alterar'){

                        if($arquivo == null){
                            $uploadfile = $_SESSION['imagem'];
                            $imagemContinua = 1;
                        }

                        //Verificar a extensão
                        if(($extensoes) || ($imagemContinua == 1)){
                            //Move o arquivo para a pasta de destino
                            if((move_uploaded_file($_FILES['filesimagemproduto']['tmp_name'], $uploadfile)) || ($imagemContinua == 1)){

                                //O id que é pego da sessão
                                $idHref = $_SESSION["idProduto"];

                                //Update na tabela produto
                                $sql = "update tbl_produto set id_categoria = ".$selectCategoria.", descricao = '".$descProduto."', nome = '".$nomeProduto."', imagem = '".$uploadfile."', preco = ".$precoProdutoBanco." where id_produto = ".$idHref;

                                if(mysql_query($sql) or die(mysql_error())){
                                    unset($_SESSION["idProduto"]);
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
                                                  window.location = "crud_produtos.php";
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
                                                window.location = "crud_produtos.php";
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
                                            window.location = "crud_produtos.php";
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
                                        window.location = "crud_produtos.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }
                }

                //Se for o botão para cadastrar ingredientes
                if(isset($_POST['btnAdicionarIngredientes'])){

                    $idProdutoIng = $_SESSION['idProdutoIngrediente'];
                    $selectIng = $_POST['selectIng'];
                    $txt_qtdIng = $_POST['txt_qtdIng'];
                    $selectTpUnitario = $_POST['selectTpUnitario'];
                    $detalhe = $_POST['txt_detalheIng'];

                    //Se for adicionar
                    if($_POST['btnAdicionarIngredientes'] == 'Adicionar'){

                        //Substitui , por .
                        $txt_qtdIng = str_replace(',','.',$txt_qtdIng);

                        //Comando SQL
                        $sql = "insert into tbl_ingredienteproduto (id_ingrediente, id_produto, id_tipounit, quantidade, detalhe)";
                        $sql = $sql." values(".$selectIng.", ".$idProdutoIng.", ".$selectTpUnitario.", '".$txt_qtdIng."', '".$detalhe."')";

                        if(mysql_query($sql) or die(mysql_error())){
                            ?>
                                <script>
                                    swal({
                                      title: "Ingrediente Cadastrado!",
                                      text: "A tela ao lado direito mostrará o ingrediente cadastrado!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                      });
                                      //Voltar para o php sem dados na url
                                      setTimeout(function(){
                                        window.location = "crud_produtos.php?id=<?php echo($idProdutoIng); ?>&modo=gerenciar_ingredientes";
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
                                        window.location = "crud_produtos.php?id=<?php echo($idProdutoIng); ?>&modo=gerenciar_ingredientes";
                                    }, 1800);
                                </script>
                            <?php
                        }

                    }elseif($_POST['btnAdicionarIngredientes'] == 'Alterar'){

                        //Substitui , por .
                        $txt_qtdIng = str_replace(',','.',$txt_qtdIng);

                        //Comando SQL
                        $sql = "update tbl_ingredienteproduto set id_ingrediente = ".$selectIng.", id_produto = ".$idProdutoIng.", id_tipounit = ".$selectTpUnitario.", quantidade = '".$txt_qtdIng."', detalhe = '".$detalhe."' where id_produto = ".$idProdutoIng." and id_ingrediente = ".$idIngrediente;

                        if(mysql_query($sql) or die(mysql_error())){
                            ?>
                                <script>
                                    swal({
                                      title: "Sucesso!",
                                      text: "Ingrediente Alterado!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                      });
                                      //Voltar para o php sem dados na url
                                      setTimeout(function(){
                                          window.location = "crud_produtos.php?id=<?php echo($idProdutoIng); ?>&modo=gerenciar_ingredientes";
                                      }, 3000);
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
                                        window.location = "crud_produtos.php?id=<?php echo($idProdutoIng); ?>&modo=gerenciar_ingredientes";
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
                        Crud de produtos
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/produtoIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Nome do Produto
                            </div>
                            <div class="titulo_coluna">
                                Preço
                            </div>
                            <div class="titulo_colunaImagem">
                                Foto
                            </div>
                            <div class="titulo_4opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php

                            //Comando SQL
                            $sql = "select id_produto, statusTabelaNuticional, nome, format(preco,2,'de_DE')  as 'preco', imagem from tbl_produto";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_produto'];
                                $statusNutricional = $rs['statusTabelaNuticional'];

                                if($statusNutricional == '0'){
                                    $imgAtivarDesativar = 'img/nutricionalDesativado.png';
                                }else{
                                    $imgAtivarDesativar = 'img/nutricionalAtivado.png';
                                }
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nome']); ?>
                            </div>
                            <div class="conteudo_coluna">
                                R$<?php echo($rs['preco']); ?>
                            </div>
                            <div class="conteudo_colunaImagem">
                                <div class="tabela_conteudoVideoImagem">
                                    <img src=" <?php echo($rs['imagem']); ?>" alt="">
                                </div>
                            </div>
                            <div class="coluna_4opcoes">
                                <!--Tabela Nutricional-->
                                <a href="crud_produtos.php?id=<?php echo($id); ?>&modo=tabela_nutricional">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar Tabela Nutricional">
                                        </div>
                                    </div>
                                </a>
                                <!--Adicionar Ingredientes-->
                                <a href="crud_produtos.php?id=<?php echo($id); ?>&modo=gerenciar_ingredientes">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/ingredientesIcon.png" alt="" title="Gerenciar Ingredientes">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_produtos.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_produtos.php?id=<?php echo($id); ?>&linkimg=<?php echo($rs['imagem']); ?>&modo=deletar">
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
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Produto">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
