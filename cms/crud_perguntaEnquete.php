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
    $pergunta = "";
    $selectEnquete = "";
    $idEnqueteAlterar = "";

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
        <link rel="stylesheet" href="css/crud_perguntaEnquete.css">
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
							$sql = "delete from tbl_pergunta where id_pergunta = ".$id;
							mysql_query($sql);
							//Voltar para o php sem dados na url
							header('location:crud_perguntaEnquete.php');
							break;

						case 'alterar':
							//Guarda o id na sessão
							$_SESSION['idPergunta'] = $id;
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
							//Puxa os dados referente ao id
							$sql = "select * from tbl_pergunta where id_pergunta = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
                                $idEnqueteAlterar = $rs['id_enquete'];
								$pergunta = $rs['pergunta'];
                                $selectEnquete = $rs['id_enquete'];
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
            <?php include_once('externos/cadastros/pergunta_enquete/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_perguntaEnquete'])){
                    //Resgata os valores
                    $pergunta = $_POST['txt_nomePergunta'];
                    $selectEnquete = $_POST['selectEnquete'];

                    if($_POST['btnCadastrar_perguntaEnquete'] == 'Cadastrar'){

                        //Insere os dados no banco
                        $sql = "insert into tbl_pergunta (id_enquete, pergunta)";
                        $sql = $sql."values(".$selectEnquete.", '".$pergunta."')";

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
                                      window.location = "crud_perguntaEnquete.php";
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
                                        window.location = "crud_perguntaEnquete.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                    }elseif($_POST['btnCadastrar_perguntaEnquete'] == 'Alterar'){

                        //Altera os dados do banco
                        $sql = "update tbl_pergunta set id_enquete = ".$selectEnquete.", pergunta = '".$pergunta."' where id_pergunta = ".$_SESSION['idPergunta'];

                        if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idEnquete']);
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
                                      window.location = "crud_perguntaEnquete.php";
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
                                        window.location = "crud_perguntaEnquete.php";
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
                        Crud de Perguntas
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/perguntaIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Título da Enquete
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Pergunta
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Comando SQL
                            $sql = "select p.id_pergunta, p.pergunta, e.titulo
                                    from tbl_pergunta as p
                                    inner join tbl_enquete as e
                                    on p.id_enquete = e.id_enquete";
                            $select = mysql_query($sql) or die(mysql_error());
                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_pergunta'];
                                $pergunta = $rs['pergunta'];
                                $tituloEnquete = $rs['titulo'];
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($tituloEnquete); ?>
                            </div>
                            <div class="conteudo_colunaObs">
                                <div class="div_textoConteudoObs">
                                    <span class="span_centralizar"><?php echo($pergunta); ?></span>
                                </div>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_perguntaEnquete.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_perguntaEnquete.php?id=<?php echo($id); ?>&modo=deletar">
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
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Pergunta">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
