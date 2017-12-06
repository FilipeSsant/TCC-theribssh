<?php

session_start();

//Conexão com o banco
include_once('../conexao/mysql.php');

//Removendo Probabilidade de Erros Por Campos Não opcionais vazios
$nomeFc = "";
$emailFc = "";
$telefoneFc = "";
$celularFc = "";
$tipoDeInfoFc = "";
$restauranteFc = "";
$obsFc = "";

$numAlternativa = "";

$idEnquete = "";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>The Ribs Steakhouse - Fale Conosco</title>
        <link rel="stylesheet" href="../css/faleconosco.css">
        <link rel="stylesheet" href="../css/cssUniversal.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="../jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="../jquery/jquerymaskplugin.js" ></script>
        <!--Script de Máscaras-->
        <script>
            //Máscaras
            <?php include_once('../jsFunctions/mascaraLoginCadastro.js')?>
        </script>
        <!--Script Funções-->
		<script>
        //Inclui o pop up do cadastro e do login
        <?php include_once('../jsFunctions/popup.js');?>
        //Inclui a função de mostrar a senha caso o usuario pressione o botão
        <?php include_once('../jsFunctions/mostrarSenha.js');?>
        //Inclui a janelinha informativa caso o usuário tenha alguma duvida
        //Passando o mouse por cima da figura e assim aparecendo a explicação
        <?php include_once('../jsFunctions/janelaInformativa.js');?>
        //Inclui uma mensagem que é aberta no passar do mouse em um botão na area de Login
        <?php include_once('../jsFunctions/abrirMensagemNaAreaLogin.js');?>
        //Inclui o Scroll do cabeçalho
        <?php include_once('../jsFunctions/cabecalho_scroll.js');?>
		</script>
    </head>
    <body style="background-color:<?php echo($corSecundaria); ?>">
        <!--Fundo Transparente-->
        <div id="fundo_transparente" onClick="fecharPopUps()">

        </div>
		<div id="esqueleto">
			<!--Cabecalho-->
			<?php
				//Inclui o cabeçalho para a página
				include_once('../cabecalho/cabecalho.php');
				//Inclui o cabeçalho para a página
				include_once('popUps/popUpEnquete.php');
            
                //Quando o usuário clicar no botão de confimar resposta da enquete
                if(isset($_POST['btn_respEnquete'])){
                    //Resgatando valores
                    $numAlternativa = $_POST['alternativa'];
                    
                    $sql = "insert into tbl_respostaenquete (id_enquete, alternativa)";
                    $sql = $sql."values ('".$idEnquete."', 'alternativa".$numAlternativa."')";
                    
                    if(mysql_query($sql) or die(mysql_error())){
                        ?>
                            <script>
                                swal({
                                  title: "Obrigado por sua opinião!",
                                  text: "Ela é importante para nós.",
                                  type: "success",
                                  icon: "success",
                                  button: {
                                             text: "Ok",
                                         },
                                  closeOnEsc: true,
                              });
							  //Voltar para o php sem dados na url
							  setTimeout(function(){
								  window.location = "faleconosco.php";
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
                            </script>
                        <?php
                    }
                }
            
                //Quando o usuário clicar no botão enviar do fale conosco
                if(isset($_POST['btn_faleConosco'])){
                    //Resgatando valores digitados pelo usuário
                    $nomeFc = $_POST['txt_nomeFc'];
                    $emailFc = $_POST['txt_emailFc'];
                    $telefoneFc = $_POST['txt_telefoneFc'];
                    $celularFc = $_POST['txt_celularFc'];
                    $tipoDeInfoFc = $_POST['selectTipoDeInfo'];
                    $restauranteFc = $_POST['selectRestaurante'];
                    $obsFc = $_POST['txt_obs'];

                    $sql = "insert into tbl_faleconosco (id_tipoInfo, id_restaurante, nome_completo, celular, telefone, email, obs)";
                    $sql = $sql."values('".$restauranteFc."', '".$restauranteFc."', '".$nomeFc."', '".$celularFc."', '".$telefoneFc."', '".$emailFc."', '".$obsFc."')";

                    if(mysql_query($sql) or die(mysql_error())){
                        ?>
                            <script>
                                swal({
                                  title: "Obrigado por sua opinião!",
                                  text: "Ela é importante para nós.",
                                  type: "success",
                                  icon: "success",
                                  button: {
                                             text: "Ok",
                                         },
                                  closeOnEsc: true,
                              });
							  //Voltar para o php sem dados na url
							  setTimeout(function(){
								  window.location = "faleconosco.php";
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
                            </script>
                        <?php
                    }

                }
			?>
			<section>
                <h6>The Ribs Steakhouse - Fale Conosco</h6>
				<!--Div do Título do Restaurante-->
				<div class="div_titulo" style="background-color:<?php echo($corQuartenaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					<!--Titulo-->
					<div class="titulo">
						<span style="color:<?php echo($corSecundaria); ?>">Entre em Contato</span>
					</div>
				</div>
				<!--Faq-->
				<div class="div_tituloFaq" style="background-color:<?php echo($corSecundaria); ?>; border-bottom:10px solid <?php echo($corSecundaria); ?>">
					<span style="color:<?php echo($corMarromSecundaria); ?>;">FAQ</span>
				</div>
				<div id="div_atrasFaq" style="background-color:<?php echo($corQuartenaria); ?>;">
					<!--Div FAQ-->
					<div id="div_faq" style="background-color:<?php echo($corSecundaria); ?>;">
						<?php

							//Comando SQL
                            $sql = "select * from tbl_faq";
                        
                            $select = mysql_query($sql) or die(mysql_error());

							while($rs=mysql_fetch_array($select)){
						?>
						<!--Div Pergunta e resposta-->
						<div class="div_pergRespFaq">
							<!--Div Pergunta-->
							<div class="div_perguntaFaq" style="background-color:<?php echo($corPrimaria); ?>;">
								<span style="color:<?php echo($corSecundaria); ?>;"><?php echo($rs['pergunta']); ?></span>
							</div>
							<!--Div Resposta-->
							<div class="div_respostaFaq">
								<span class="resposta_faq"><?php echo($rs['resposta']); ?></span>
							</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>

				<!--Div de Cadastro-->
				<div id="div_foraFaleConosco" style="background-color:<?php echo($corSecundaria); ?>;">
					<!--Div de Login-->
					<div id="div_fale" style="background-color:<?php echo($corSecundaria); ?>;">
						<!--Fale Conosco-->
						<div class="div_tituloFaq" style="background-color:<?php echo($corSecundaria); ?>; border-bottom:10px solid <?php echo($corSecundaria); ?>">
							<span style="color:<?php echo($corMarromSecundaria); ?>;">Fale Conosco</span>
						</div>
						<div id="div_atrasFormulario" style="background-color:<?php echo($corQuartenaria); ?>;">
							<!--Formulário de preenchimento o Fale conosco-->
							<div id="formulario_fale" style="background-color:<?php echo($corSecundaria); ?>;">
								<form name="formFaleConosco" method="post" action="faleconosco.php">
									<!--Nome-->
									<input class="input_texto" type="text" name="txt_nomeFc" placeholder="Nome" required><br>
									<!--E-mail-->
									<input class="input_texto" type="email" name="txt_emailFc" placeholder="E-mail" required><br>
									<!--Telefone-->
									<input id="telefoneFc" class="input_texto" type="text" name="txt_telefoneFc" placeholder="Telefone"><br>
									<!--Celular-->
									<input id="celularFc" class="input_texto" type="text" name="txt_celularFc" placeholder="Celular" required><br>
									<!--Select Tipo de Informação-->
									<select class="select" name="selectTipoDeInfo" required>
										<option value="" selected disabled>Selecione o Tipo de Informação</option>
										<?php

											//Seleciona tudo na tabela tbl_tipoinfo
											$sql = "select * from tbl_tipoinfo";

											$select = mysql_query($sql) or die(mysql_error());

											while($rs=mysql_fetch_array($select)){
												$idTipoInfo=$rs['id_tipoInfo'];
												$nomeTipoInfo=$rs['nome'];
										?>
										<option value="<?php echo($idTipoInfo);?>"><?php echo($nomeTipoInfo); ?></option>
										<?php
											}
										?>
									</select><br>
									<!--Select Restaurante-->
									<select class="select" name="selectRestaurante">
										<option value="" selected disabled>Selecione o Restaurante</option>
										<?php

											//Comando SQL
                                            $sql = "select * from tbl_restaurante";
                                            $select = mysql_query($sql);

											while($rs=mysql_fetch_array($select)){
                                                $idRestaurante = $rs['id_restaurante'];
                                                $nomeRestaurante = $rs['nome'];
										?>
										<option value="<?php echo($idRestaurante);?>"><?php echo($nomeRestaurante); ?></option>
										<?php
											}
										?>
									</select><br>
									<!--Text Area Observação-->
									<textarea placeholder="Sugestão ou crítica" name="txt_obs" id="textArea" required></textarea>
									<!--Div botões-->
									<div id="div_botoes">
										<!--Botão Finalizar Fale Conosco-->
										<button class="botao_formularioFaleConosco" type="submit" name="btn_faleConosco" style="background-color:<?php echo($corPrimaria); ?>;">
											<span style="color:<?php echo($corSecundaria); ?>;">Enviar</span>
										</button>
										<!--Botão Limpar Dados do Formulário-->
										<button class="botao_formularioFaleConosco" type="reset" style="background-color:<?php echo($corPrimaria); ?>;">
											<span style="color:<?php echo($corSecundaria); ?>;">Limpar</span>
										</button>
									</div>
								</form>
							</div>
						</div>

						<!--Botão Flutuante Enquetes-->
						<div id="botao_flutuanteEnquete" style="background-color:<?php echo($corQuartenaria); ?>;" onclick="abrirPopUpEnquetes()">
							<!--Icone-->
							<div id="div_icone_enquete">
								<img src="../img/enqueteIcon.png" alt="">
							</div>
							<!--Texto-->
							<div id="div_titulo_enquete">
								<span style="color:<?php echo($corSecundaria); ?>;">Enquetes</span>
							</div>
						</div>

					</div>
				</div>
			</section>

			<!--Rodapé-->
			<?php
				//Inclui o rodapé para a página
				include_once('../rodape/rodape.php');
			?>
		</div>
    </body>
</html>
