<?php

session_start();

//Conexão com o banco
include_once('../conexao/mysql.php');

//inclui o php Universal que utilizara em todas as páginas
include_once('../externos/phpUniversal.php');

//If para verificar se o usuário tem uma sessão
if(isset($_SESSION['id_cliente'])){

}else{
    header('location:../home/home.php');
}

//Removendo Probabilidade de Erros Por Campos Não opcionais vazios
$login = "";
$senha = "";
$confirmarSenha = "";
$nome = "";
$sobrenome = "";
$email = "";
$celular = "";
$telefone = "";
$logradouro = "";
$apartamentobloco = "";
$rua = "";
$bairro = "";
$numeroResidencia = "";
$bloco = "";
$apartamento = "";
$seletorDoEstado = "";
$seletorBandeiraDoCartao = "";
$numCartao = "";
$nomeRegistradoCartao = "";
$dataValidade = "";
$CVV = "";

$senhaAtual = "";
$novaSenha = "";

$optionSelecionado = "";

$idCidadeBd = "";
$nomeCidadeBd = "";
$nomeEstadoBd = "";
$idEstadoBd = "";
$logradouroBd = "";
$ruaBd = "";
$numeroBd = "";
$apBlocoBd = "";
$bairroBd= "";

$idBancoBd = "";
$nomeBancoBd = "";
$numeroCartaoBd = "";
$cvvBd = "";
$nomeCartaoBd = "";
$dtVencimentoBd = "";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>The Ribs Steakhouse - Meu Perfil</title>
        <link rel="stylesheet" href="../css/meuperfil.css">
        <link rel="stylesheet" href="../css/cssUniversal.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="../jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="../jquery/jquerymaskplugin.js" ></script>
        <!--Script de Máscaras-->
        <script>
            //Máscaras
            <?php include_once('../jsFunctions/mascaraLoginCadastro.js') ?>
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
            //Inclui uma mensagem que é aberta no passar do mouse em um botão na area de Login
            <?php include_once('../jsFunctions/popupMeuPerfil.js');?>
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
            
				//Inclui o pop up de alterar dados
				include_once('popUpAlterarDados.php');
                //Inclui o pop up de alterar foto
				include_once('popUpAlterarFoto.php');
				//Inclui o pop up para nova senha
				include_once('popUpNovaSenha.php');
				//Inclui o cabeçalho para a página
				include_once('../cabecalho/cabecalho.php');
            
                //Alterar dados
                if(isset($_POST['btnAlterar'])){
                    //Dados Pessoais
                    $login = $_POST['txt_login'];
                    $nome = $_POST['txt_nome'];
                    $sobrenome = $_POST['txt_sobrenome'];
                    $email = $_POST['txt_email'];
                    $celular = $_POST['txt_celular'];
                    $telefone = $_POST['txt_telefone'];
                    //Endereço
                    $logradouro = $_POST['txt_logradouro'];
                    $rua = $_POST['txt_rua'];
                    $bairro = $_POST['txt_bairro'];
                    $numeroResidencia = $_POST['txt_numeroResidencia'];
                    $bloco = $_POST['txt_bloco'];
                    $apartamento = $_POST['txt_apartamento'];
                    $apartamentoBloco = $apartamento."-".$bloco;
                    $seletorDaCidade = $_POST['selectCidade'];
                    //Cartão de crédito
                    @$seletorBandeiraDoCartao = $_POST['selectBandeiraDoCartao'];
                    $numCartao = $_POST['txt_numCartao'];
                    $nomeRegistradoCartao = strtoupper($_POST['txt_nomeNoCartao']);
                    $dataValidade = $_POST['txt_dataValidade'];
                    $cvv = $_POST['txt_cvv'];


                    //Altera os dados do endereço do usuário
                    $sql = "update tbl_endereco set id_cidade = ".$seletorDaCidade.", logradouro = '".$logradouro."', bairro = '".$bairro."', rua = '".$rua."', aptbloco = '".$apartamentoBloco."', numero = ".$numeroResidencia." where id_endereco = ".$idEnderecoUsuario;

                    mysql_query($sql) or die(mysql_error());

                    //Altera os dados na tabela cliente
                    $sql = "update tbl_cliente set login = '".$login."', nome = '".$nome."', sobrenome = '".$sobrenome."', celular = '".$celular."', telefone = '".$telefone."', email = '".$email."' where id_cliente = ".$idCliente;

                    mysql_query($sql) or die(mysql_error());

                    if($seletorBandeiraDoCartao == 0 && $numCartao == null && $cvv == null){

                        //Exclui registros do cartão do usuário
                        $sql = "delete from tbl_cartaocredito where id_cliente = ".$idCliente;
                        mysql_query($sql);
                        
                        if($idCliente != null){
                            ?>
                                <script>
                                  swal({
                                      title: "Sucesso!",
                                      text: "Dados Alterados!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                  });
                                  setTimeout(function(){
                                    window.location = "meuperfil.php";
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
                    }else{


                        //Altera os dados na tabela do cartão do cliente
                        $sql = "update tbl_cartaocredito set id_banco = ".$seletorBandeiraDoCartao.", numero = '".$numCartao."', nome_cartao = '".$nomeRegistradoCartao."', data = '".$dataValidade."', cvv = '".$cvv."' where id_cliente = ".$idCliente;

                        if(mysql_query($sql) or die(mysql_error())){
                            ?>
                                <script>
                                  swal({
                                      title: "Sucesso!",
                                      text: "Dados Alterados!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                  });
                                  setTimeout(function(){
                                    window.location = "meuperfil.php";
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
                }

                //Alterar Senha
                if(isset($_POST['btnMudarSenha'])){
                    //Resgatando valores digitados pelo usuário
                    $senhaAtual = $_POST['txt_senhaAtual'];
                    $novaSenha = $_POST['txt_senha'];
                    $confirmarSenha = $_POST['txt_confirmarSenha'];

                    //Comando SQL
                    $sql = "select * from tbl_cliente where id_cliente = ".$idCliente;
                    
                    $select = mysql_query($sql) or die(mysql_error());
                    
                    while($rs=mysql_fetch_array($select)){
                        $senhaAtualBd = $rs['senha'];
                        //Se a senha digitada pelo o usuário for igual a senha original
                        if($senhaAtual == $senhaAtualBd){
                            
                            if($novaSenha == $confirmarSenha){
                                //Comando Update
                                $sql2 = "update tbl_cliente set senha = '".$novaSenha."' where id_cliente = ".$idCliente;

                                if(mysql_query($sql2) or die(mysql_error())){
                                    ?>
                                        <script>
                                            swal({
                                              title: "Sucesso!",
                                              text: "Senha alterada!",
                                              type: "success",
                                              icon: "success",
                                              button: {
                                                         text: "Ok",
                                                     },
                                              closeOnEsc: true,
                                            });
                                            setTimeout(function(){
                                              window.location = "meuperfil.php";
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
                            }else{
                                ?>
                                    <script>
                                        swal({
                                          title: "Erro!",
                                          text: "As senhas não coincidem!",
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
                        }else{
                           ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "A senha que você digitou esta incorreta!",
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
                }

                //Alterar foto
                if(isset($_POST['btnMudarFoto'])){
                    //Guardar arquivos de fotos em pasta de destino
                    $uploaddir = "../arquivos/foto_usuario/";
                    $uploaddirBanco = "arquivos/foto_usuario/";

                    //Pega o nome das fotos enviadas
                    $arquivo = strtolower(basename($_FILES['filesimagem']['name']));
                    $arquivo = str_replace(" ", "_", $arquivo);
                    

                    //Salva numa variavel que jutna a pasta de destino com o nome do arquivo
                    $uploadfile = $uploaddir.$arquivo;
                    $uploadfileBanco = $uploaddirBanco.$arquivo;

                    //Verificar se é uma extensão PNG, JPG ou JPEG
                    if(strstr($uploadfile, '.png') || strstr($uploadfile, '.jpg') || strstr($uploadfile, '.jpeg')){
                        if(move_uploaded_file($_FILES['filesimagem']['tmp_name'], $uploadfile)){
                            //Altera no banco
                            $sql = "update tbl_cliente set foto = '".$uploadfileBanco."' where id_cliente = ".$idCliente;
                            if(mysql_query($sql) or die(mysql_error())){
                                ?>
                                    <script>
                                        swal({
                                          title: "Sucesso!",
                                          text: "Foto alterada!",
                                          type: "success",
                                          icon: "success",
                                          button: {
                                                     text: "Ok",
                                                 },
                                          closeOnEsc: true,
                                      });
                                      setTimeout(function(){
										  window.location = "meuperfil.php";
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
                    }else{
                        ?>
                            <script>
                                swal({
                                  title: "Erro!",
                                  text: "O formato da extensão inválida!",
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

                //Select de endereço
                $sqlEndereco = "select * from tbl_endereco where id_endereco = ".$idEnderecoUsuario;
                $selectEndereco = mysql_query($sqlEndereco);
                while($rsEndereco=mysql_fetch_array($selectEndereco)){
                    $idCidadeBd = $rsEndereco['id_cidade'];
                    $logradouroBd = $rsEndereco['logradouro'];
                    $ruaBd = $rsEndereco['rua'];
                    $bairroBd = $rsEndereco['bairro'];
                    $numeroBd = $rsEndereco['numero'];
                    $apBlocoBd = $rsEndereco['aptbloco'];
                }

                //Select de cidade
                $sqlCidade = "select * from tbl_cidade where id_cidade = ".$idCidadeBd;
                $selectCidade = mysql_query($sqlCidade);
                while($rsCidade=mysql_fetch_array($selectCidade)){
                    $nomeCidadeBd = $rsCidade['nome'];
                    $idEstadoBd = $rsCidade['id_estado'];
                }

                //Select de estado
                $sqlEstado = "select * from tbl_estado where id_estado = ".$idEstadoBd;
                $selectEstado = mysql_query($sqlEstado);
                while($rsEstado=mysql_fetch_array($selectEstado)){
                    $nomeEstadoBd = $rsEstado['nome'];
                }

                //Select Cartão de Crédito
                $sqlCartao = "select * from tbl_cartaocredito where id_cliente = ".$idCliente;
                $selectCartao = mysql_query($sqlCartao);
                while($rsCartao=mysql_fetch_array($selectCartao)){
                    $idBancoBd = $rsCartao['id_banco'];
                    $numeroCartaoBd = $rsCartao['numero'];
                    $cvvBd = $rsCartao['cvv'];
                    $nomeCartaoBd = $rsCartao['nome_cartao'];
                    $dtVencimentoBd = $rsCartao['data'];
                }

                //Select Banco
                $sqlBanco = "select * from tbl_banco where id_banco = '".$idBancoBd."'";
                $selectBanco = mysql_query($sqlBanco);
                while($rsBanco=mysql_fetch_array($selectBanco)){
                    $nomeBancoBd = $rsBanco['nome'];
                }

			?>
			<section>
                <h6>The Ribs Steakhouse - Meu Perfil</h6>
				<!--Div do Título do Restaurante-->
				<div class="div_titulo" style="background-color:<?php echo($corPrimaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					<!--Titulo-->
					<div class="titulo">
						<span style="color:<?php echo($corSecundaria); ?>">Meu Perfil</span>
					</div>
				</div>

                <!--<div id="divPedido_saldo">
                    <div id="nivel" style="background-color:<?php echo($corPrimaria); ?>; color:<?php echo($corSecundaria);?>">
                        <b>1</b>
                    </div>
                    <div id="saldo" style="background-color:<?php echo($corTerciaria); ?>; color:<?php echo($corSecundaria);?>">
                        <b>Saldo:</b> R$ 45,00
                    </div>
                    <div id="progresso_proximoLvl">
                    </div>
                    <div id="numero_pedidosRestantes">
                        1/5
                    </div>
                </div>-->
                
				<div class="informacoes_usuario">
					<div class="foto_nome_usuario">
					  <img src="../<?php echo($fotoUsuario); ?>" alt=""/>
					  <div class="nome_usuario">
						<span ><?php echo($loginUsuario); ?></span>
					  </div>
                      <!--Botão para alterar foto-->
                      <div id="div_botaoAlterarFoto" style="background-color:<?php echo($corTerciaria); ?>" onclick="abrirPopUpAlterarFoto()">
                          <img src="../img/cameraIcon.png" alt="">
                      </div>
					</div>
					<div class="informacoes_perfil">
						<div class="titulo_informacoes">
							<span style="color:<?php echo($corPrimaria); ?>">Informações do Perfil</span>
						</div>

						<table class="tbl_informacoes">
						  <tr>
							<td>Nome: <?php echo($nomeUsuario); ?></td>
							<td>Sobrenome: <?php echo($sobrenomeUsuario); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">E-mail: <?php echo($emailUsuario); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Estado: <?php echo($nomeEstadoBd); ?></td>
						  </tr>
                            <tr>
							<td colspan="2">Cidade: <?php echo($nomeCidadeBd); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Logradouro: <?php echo($logradouroBd); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Rua: <?php echo($ruaBd); ?></td>
						  </tr>
						  <tr>
							<td>Bairro: <?php echo($bairroBd); ?></td>
							<td>Número: <?php echo($numeroBd); ?></td>
						  </tr>
                          <tr>
							<td colspan="2">Apartamento-Bloco: <?php echo($apBlocoBd); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Celular: <?php echo($celularUsuario); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Telefone: <?php echo($telefoneusuario); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Banco: <?php echo($nomeBancoBd); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Número do Cartão de Crédito: <?php echo($numeroCartaoBd); ?></td>
						  </tr>
						  <tr>
							<td colspan="2">Nome registrado no Cartão de Crédito: <?php echo($nomeCartaoBd); ?></td>
						  </tr>
						  <tr>
							<td>Vencimento do Cartão: <?php echo($dtVencimentoBd); ?></td>
							<td style="width:50%;">CVV: <?php echo($cvvBd); ?></td>
						  </tr>
						</table>

						<div class="alterar_informacoes">
                          <a href="meuperfil.php?id=<?php echo($idCliente);?>&alterar">    
						  <div class="alterar" style="background-color:<?php echo($corPrimaria); ?>;">
							  <span style="color:<?php echo($corSecundaria); ?>">Alterar Dados</span>
						  </div>
                          </a>      
						  <div class="alterar" style="background-color:<?php echo($corPrimaria); ?>;" onclick="abrirPopUpAlterarSenha()">
							  <span style="color:<?php echo($corSecundaria); ?>"><a href="#">Alterar Senha</a></span>
						  </div>
						</div>

						<div class="alterar_informacoes">
                          <a href="../historicos/historico_reservas.php">
						  <div class="alterar" style="background-color:<?php echo($corPrimaria); ?>;">
							  <span style="color:<?php echo($corSecundaria); ?>">Histórico de Reservas</span>
						  </div>
                          </a>
						  <a href="../historicos/historico_pedidos.php"><div class="alterar" style="background-color:<?php echo($corPrimaria); ?>;">
							  <span style="color:<?php echo($corSecundaria); ?>">Histórico de Pedidos</span>
						  </div>
                          </a>
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
