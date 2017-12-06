<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 13";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $selectPergunta = "";
    $alternativa1 = "";
    $alternativa2 = "";
    $alternativa3 = "";
    $alternativa4 = "";

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
        <link rel="stylesheet" href="css/crud_opcoesPergunta.css">
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

            <?php
				//Pega o modo que esta sendo passado na url
				if(isset($_GET['modo'])){
					//Pega os objetos após a ? e guarda na variavel
					$modo = $_GET['modo'];
					$id = $_GET['id'];

					//Esse switch serve para usando a variavel modo tenha varios resultados
					switch($modo){
						//Case para deletar um item
						case 'deletar':
							//Deleta o item usando seu id
							$sql = "delete from tbl_opcao where id_pergunta = ".$id;
							mysql_query($sql);
							//Voltar para o php sem dados na url
							header('location:crud_opcoesPergunta.php');
							break;

						case 'alterar':
							//Guarda o id na sessão
							$_SESSION['idOpcao'] = $id;
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
                            $contador = 1;
							//Puxa os dados referente ao id
							$sql = "select * from tbl_opcao where id_opcao = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
                                $selectPergunta = $rs['id_pergunta'];
                                $alternativa1 = $rs['alternativa1'];
                                $alternativa2 = $rs['alternativa2'];
                                $alternativa3 = $rs['alternativa3'];
                                $alternativa4 = $rs['alternativa4'];
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
            <?php include_once('externos/cadastros/opcoes_pergunta/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_perguntaEnquete'])){
                    //Resgata os valores
                    $selectPergunta = $_POST['selectPergunta'];
                    $alternativa1 = $_POST['txt_alternativa1'];
                    $alternativa2 = $_POST['txt_alternativa2'];
                    $alternativa3 = $_POST['txt_alternativa3'];
                    $alternativa4 = $_POST['txt_alternativa4'];

                    if($_POST['btnCadastrar_perguntaEnquete'] == 'Cadastrar'){

                        //Inserir dados
                        $sql = "insert into tbl_opcao(id_pergunta, alternativa1, alternativa2, alternativa3, alternativa4)";
                        $sql = $sql."values(".$selectPergunta.",'".$alternativa1."','".$alternativa2."','".$alternativa3."','".$alternativa4."')";

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
                                          window.location = "crud_opcoesPergunta.php";
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
                                            window.location = "crud_opcoesPergunta.php";
                                        }, 1800);
                                    </script>
                                <?php
                            }

                    }elseif($_POST['btnCadastrar_perguntaEnquete'] == 'Alterar'){
                        //Alterar dados
                        $sql = "update tbl_opcao set id_pergunta = ".$selectPergunta.", alternativa1 = '".$alternativa1."', alternativa2 = '".$alternativa2."',
                                alternativa3 = '".$alternativa3."', alternativa4 = '".$alternativa4."' where id_pergunta = ".$_SESSION['idOpcao'];

                        if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idOpcao']);
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
                                      window.location = "crud_opcoesPergunta.php";
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
                                        window.location = "crud_opcoesPergunta.php";
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
                        Crud de Opções
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/opcoesIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Pergunta
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Alternativas
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php

                            //Comando SQL
                            $sql = "select o.id_opcao, o.id_pergunta, p.pergunta from tbl_opcao as o inner join tbl_pergunta as p on o.id_pergunta = p.id_pergunta";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_opcao'];
                                $pergunta = $rs['pergunta'];

                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaObs">
                                <div class="div_textoConteudoObs">
                                    <span class="span_centralizar"><?php echo($pergunta); ?></span>
                                </div>
                            </div>
                            <div class="conteudo_colunaObs">
                                <?php


                                    $sqlAlternativa = "select alternativa1, alternativa2, alternativa3, alternativa4
                                            from tbl_opcao where
                                            id_opcao =".$id;

                                    $selectAlternativa = mysql_query($sqlAlternativa) or die(mysql_error());

                                    while($rsAlternativa=mysql_fetch_array($selectAlternativa)){

                                ?>
                                <div class="div_textoConteudoAlternativas">
                                    <p>1. <?php echo($rsAlternativa['alternativa1']); ?></p>
                                    <p>2. <?php echo($rsAlternativa['alternativa2']); ?></p>
                                    <p>3. <?php echo($rsAlternativa['alternativa3']); ?></p>
                                    <p>4. <?php echo($rsAlternativa['alternativa4']); ?></p>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_opcoesPergunta.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_opcoesPergunta.php?id=<?php echo($id); ?>&modo=deletar">
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
                <!--Seta pra voltar-->
                <a href="paginaAgrupadora_enquetes.php">
                    <div id="seta_voltarPraAgrupador">
                        <img src="img/setaVoltarIcon.png" alt="" title="Voltar para página anterior">
                    </div>
                </a>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar2" onclick="abrirPopUp()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Opções">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
