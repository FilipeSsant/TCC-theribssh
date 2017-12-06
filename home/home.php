<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

	//Removendo Probabilidade de Erros Por Campos Não opcionais vazios
	$imagemSuperior = "";
	$imagemInferior = "";
    $id = "";

    $selectPeriodo = "";
    $selectMesa = "";
    $dataMarcada = "";
    $dataAtual = "";
    $dateTimeReserva  = "";
    $horarioDataFeita = "";
    $dataProximaReserva = "";
    $dataHorarioAtual = "";

    $horarioFeito = "";


    //Comando SQL para selecionar os conteúdos que estão ativos no banco
	$sql = "select * from tbl_home where status = 1";

	$select = mysql_query($sql);

	if($rs=mysql_fetch_array($select)){
		$imagemSuperior = $rs['caminho_imagemSuperior'];
		$imagemInferior = $rs['caminho_imagemInferior'];
	}

    //Comando para pegar a data e o horário para verificação
    $sql = "select now() as 'dataHorarioAtual'";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){
        $dataHorarioAtual = $rs['dataHorarioAtual'];
    }

    //Comando SQL para pegar a data atual segundo o BD
    $sql = "select curdate() as 'dataAtual'";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){
        $dataAtual = $rs['dataAtual'];
    }

    $dataParte = explode("-", $dataAtual);
    //Ano
    $ano = $dataParte[0];
    //Mês
    $mesNumerico = $dataParte[1];
    //Dia
    $diaAtual = $dataParte[2];


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>The Ribs Steakhouse</title>
        <link rel="stylesheet" href="../css/home.css">
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

            //Função para exibir a tela de reservas
            function expandirReservas(){
                //Guardando o tamanho das caixas para melhor encaixe na tela
                var width_CaixaPesquisa = $("#div_videoBarraDePesquisa").width() - 140,
                    width_BtnPesquisa = $("#div_videoBarraDePesquisa").width() - 5;

                if ($("#div_videoBarraDePesquisa").height() > 600){
                    //Animação conjunta da area de reservas com o movimento da area de pesquisa
                    $("#div_pesquisa").animate({width:"100%",height:80,marginTop:"-800px",queue:false, duration: 500});
                    $("#div_reservas").animate({width:$("#div_videoBarraDePesquisa").width(), height:1021, duration:500, opacity:1, marginTop:-1021,zIndex:104, position:"absolute", queue:false});

                    //Animação de ajustes
                    $("#div_caixa_pesquisa").animate({width:width_CaixaPesquisa,height:"50px",marginTop: 15,marginLeft:40, duration: 500, queue:false});
                    $("#caixa_pesquisa").animate({width:width_CaixaPesquisa,height:"50px",fontSize:"25pt", duration: 500, queue:false});
                    $("#botao_pesquisa").animate({width:100,height:80,queue:false, duration: 500});
                    $("#botao_pesquisa img").animate({width:20,queue:false, duration: 500});
                }else{
                    //Animação conjunta da area de reservas com o movimento da area de pesquisa
                    $("#div_pesquisa").animate({width:"100%",height:80,marginTop:-$("#div_videoBarraDePesquisa").height(),queue:false, duration: 500, zIndex:130}); $("#div_reservas").animate({width:$("#div_videoBarraDePesquisa").width(),height:523, overflowX:"hidden", duration:500, opacity:1, marginTop:-520,zIndex:104, position:"absolute", queue:false});

                    //Animação de ajustes
                    $("#div_caixa_pesquisa").animate({width:width_CaixaPesquisa,height:"50px",marginTop: 15,marginLeft:40, duration: 500, queue:false});
                    $("#botao_pesquisa").animate({width:100,height:80,queue:false, duration: 500});
                    $("#botao_pesquisa img").animate({width:20,queue:false, duration: 500});
                }

            }
            //Função de filto
            function filtrarReservas(){
                //Guarda o valor da caixa para uso na atualização das telas
                var texto = $("#caixa_pesquisa").val();

                //Coloca na variavel a url que vai redirecionar para fazer o processo
                var url = "../ajax/filtrarReservas.php";

                $.ajax({
                    //Define o método
                    method:"POST",
                    //Define a url
                    url:url,
                    //Coloca em formato JSON as informações para passar pelo POST
                    data:{textoDigitado:texto},
                    success:function(dados){
                        //Manda os dados que será concebido como $resultado para a div ou input em questão
                        $("#div_reservas").html(dados);
                    }

                });

            }
            //Função para ocultar a tela de reservas
            function minizarReservas(){
                setTimeout(function(){
                    //Verificação para saber se existe algo escrito na caixa de pesquisa, assim ocultando a tela caso não tenha quaisquer valores dentro
                    if ($("#div_videoBarraDePesquisa").height() > 600){
                        if ($("#caixa_pesquisa").val() == ""){
                            $("#div_reservas").animate({height:0, duration:500, opacity:0, marginTop:0, overflow:"auto", position:"absolute", queue:false});
                            $("#div_pesquisa").animate({width:"896px",height:35,marginTop:"-450px",queue:false, duration: 500});
                            $("#div_caixa_pesquisa").animate({width:834,height:"30px",marginTop:1, marginLeft:5, duration: 500, queue:false});
                            $("#caixa_pesquisa").animate({width:830,height:"100%",fontSize:"15px", duration: 500, queue:false});
                            $("#botao_pesquisa").animate({width:57,height:35,queue:false, duration: 500});
                            $("#botao_pesquisa img").animate({width:18,queue:false, duration: 500});
                        }
                    }
                }, 100);
            }
            //Função para determinar o foco fora de caixa
            $(document).ready(function(){
                $("#caixa_pesquisa").focusout(function () {
                    minizarReservas()
                })
            });


		</script>
    </head>
    <body style="background-color:<?php echo($corSecundaria); ?>">
        <!--Fundo Transparente-->
        <div id="fundo_transparente" onClick="fecharPopUps()">

        </div>
        <div id="esqueleto">
            <!--Cabeçalho-->
            <?php
                //Inclui o cabeçalho para a página
                include_once('../cabecalho/cabecalho.php');
                //Inclui o pop up do cadastro de reservas
                include_once('popUps/cadastroReserva.php');
                //Quando for clicado no botão reservar
                if(isset($_GET['funcao'])){
                    $funcao = $_GET['funcao'];
                    if(isset($_SESSION['id_cliente'])){
                        //Seleciona na tabela de reservas com o id do cliente
                        $sql = "select * from tbl_reserva where id_cliente = ".$_SESSION['id_cliente'];
                        $select = mysql_query($sql) or die(mysql_error());
                        if($rs=mysql_fetch_array($select)){
                            $horarioFeito = $rs['horarioDataFeita'];
                        }

                        $numLinhas = mysql_num_rows($select);

                        //Se for igual reservar
                        if($funcao == 'reservar'){
                            if($numLinhas == 0){
                                ?>
                                    <script>
                                        //Abre a janela de reservas
                                        abrirPopUpCadastroReserva();
                                    </script>
                                <?php
                            }else{
                                //Seleciona do banco o horario em que a reserva anterior foi feita
                                $sql = "select horarioDataFeita from tbl_reserva where id_cliente = ".$_SESSION['id_cliente']." order by horarioDataFeita desc limit 1";
                                $select = mysql_query($sql) or die(mysql_error());
                                if($rs = mysql_fetch_array($select)){
                                    $horarioDataFeita = $rs['horarioDataFeita'];
                                }
                                //Adiciona um periodo de 10 segundos para o usuário poder fazer outra reserva
                                $sql = "select addtime('".$horarioDataFeita."', '24:00:00') as 'dataProximaReserva'";
                                $select = mysql_query($sql) or die(mysql_error());
                                if($rs=mysql_fetch_array($select)){
                                    //A data que poderá ser feita a proxima reserva
                                    $dataProximaReserva = $rs['dataProximaReserva'];
                                }

                                //Separa a hora da data
                                $separadorHorarioData = explode(" ", $dataProximaReserva);

                                //Formata a data para formato BR
                                $dataParteProxima = explode("-", $separadorHorarioData[0]);
                                //Ano
                                $anoProxima = $dataParteProxima[0];
                                //Mês
                                $mesProxima = $dataParteProxima[1];
                                //Dia
                                $diaProxima = $dataParteProxima[2];

                                $dataProximaBR = $diaProxima."/".$mesProxima."/".$anoProxima;

                                //Pega só a hora e os minutos
                                $separaHorario = explode(":", $separadorHorarioData[1]);
                                //Hora
                                $hora = $separaHorario[0];
                                //Minutos
                                $minutos = $separaHorario[1];

                                $horarioProxima = $hora.":".$minutos;

                                //Comapara com a data atual retirada do banco
                                if($dataHorarioAtual < $dataProximaReserva){
                                    ?>
                                        <script>
                                            swal({
                                              title: "A reserva só poderá ser feita em <?php echo($dataProximaBR); ?> às <?php echo($horarioProxima); ?>",
                                              text: "Há um período de 24 horas para fazer outra reserva.",
                                              type: "info",
                                              icon: "info",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            }).then(function(){
                                                window.location = "home.php";
                                            });
                                              //Voltar para o php sem dados na url
                                              setTimeout(function(){
                                                window.location = "home.php";
                                              }, 5000);
                                        </script>
                                    <?php
                                }else{
                                    ?>
                                        <script>
                                            //Abre a janela de reservas
                                            abrirPopUpCadastroReserva();
                                        </script>
                                    <?php
                                }
                            }
                        }
                    }else{
                        ?>
                            <script>
                                swal({
                                      title: "Não é possivel reservar!",
                                      text: "Para reservar é necessário criar uma conta.",
                                      type: "info",
                                      icon: "info",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                }).then(function(){
                                    window.location = "home.php";
                                });
                                  //Voltar para o php sem dados na url
                                  setTimeout(function(){
                                    window.location = "home.php";
                                  }, 3000);
                            </script>
                        <?php
                    }

                }

                //Botão de reserva
                if(isset($_POST['btnCadastrarReserva'])){
                    //Resgata os valores
                    $idCliente = $_SESSION['id_cliente'];
                    $idRestaurante = $_GET['id'];
                    $selectPeriodo = $_POST['selectPeriodo'];
                    $selectMesa = $_POST['selectMesa'];
                    $dataMarcada = $_POST['txt_dtMarcada'];

                    //Seleciona a dados de quando foi feita a reserva
                    $sql = "select now() as 'dateTimeReserva'";
                    $select = mysql_query($sql) or die(mysql_error());

                    while($rs=mysql_fetch_array($select)){
                        $dateTimeReserva = $rs['dateTimeReserva'];
                    }

                    //Comando SQL
                    $sql = "insert into tbl_reserva (id_cliente, id_periodo, id_mesa, id_restaurante, id_status, horarioDataFeita, dataMarcada)";
                    $sql = $sql." values (".$idCliente.", ".$selectPeriodo.", ".$selectMesa.", ".$idRestaurante." , 0, '".$dateTimeReserva."', '".$dataMarcada."')";

                    ?>
                        <script>
                            swal({
                              title: 'A reserva vai ser feita!',
                              text: "Tem certeza que os dados estão corretos?",
                              type: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              cancelButtonText: 'Não, não tenho',
                              confirmButtonText: 'Sim, tenho',
                            }).then(function () {
                              swal(
                                  'Reserva feita!',
                                  'Ela será  encaminhada para nossa administração!',
                                  'success'
                              )
                              var sql = "<?php echo($sql); ?>";
                              //Coloca na variavel a url que vai redirecionar para fazer o processo
                              var url = "../ajax/insertSql.php";
                              $.ajax({
                                  //Define o método
                                  method:"POST",
                                  //Define a url
                                  url:url,
                                  //Coloca em formato JSON as informações para passar pelo POST
                                  data:{sql:sql},
                                  success:function(){
                                      //Voltar para o php sem dados na url
                                      setTimeout(function(){
                                        window.location = "home.php";
                                      }, 2000);
                                  }
                              });
                            }, function (dismiss) {
                              // dismiss can be 'cancel', 'overlay',
                              // 'close', and 'timer'
                              if (dismiss === 'cancel') {

                              }
                            })
                        </script>
                    <?php
                }


            ?>
            <!--Corpo-->
            <section>
                <h6>The Ribs Steakhouse - Home</h6>
                <!--Div Vídeo-->
                <div id="div_video" style="background-image:url('../cms/<?php echo($imagemSuperior); ?>'); background-position: center;">
                    <!--Div Vídeo e Barra de Pesquisa-->
                    <div id="div_videoBarraDePesquisa">
                    </div>
                    <!--Div Barra de Pesquisa-->
                    <div id="div_pesquisa">
                        <!--Form da barra de pesquisas-->
                        <form method="post" action="home.php">
                            <div id="div_caixa_pesquisa">
                                <input id="caixa_pesquisa" type="text" name="palavra" placeholder="Pesquise sua reserva com o nome do restaurante, rua, bairro, cidade, estado ou país" onfocus="expandirReservas()" onkeyup="filtrarReservas()">
                            </div>
                            <button id="botao_pesquisa" style="background-color:<?php echo($corTerciaria); ?>;">
                                <img src="../img/pesquisar.png" alt="">
                            </button>
                        </form>
                    </div>
                </div>
                <!--Div de reservas-->
                <div id="div_reservas">
                    <?php

                        //Comando SQL para todos os restaurantes com reserva
                        $sql = "select r.id_restaurante, r.nome as 'nomeRestaurante' , r.descricao, r.imagem, r.descricao, ed.logradouro,
                                ed.bairro, ed.rua, ed.numero, c.nome as 'nomeCidade', es.nome as 'nomeEstado', p.nome as 'nomePais'
                                from tbl_restaurante as r inner join tbl_endereco as ed on r.id_endereco = ed.id_endereco
                                inner join tbl_cidade as c on c.id_cidade = ed.id_cidade
                                inner join tbl_estado as es on es.id_estado = c.id_estado
                                inner join tbl_regiao as reg on reg.id_regiao = es.id_regiao
                                inner join tbl_pais as p on p.id_pais = reg.id_pais";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idRestaurante = $rs['id_restaurante'];
                            $nomeRestaurante = $rs['nomeRestaurante'];
                            $descRestaurante = $rs['descricao'];
                            $nomeEstado = $rs['nomeEstado'];
                            $nomeCidade = $rs['nomeCidade'];
                            $bairro = $rs['bairro'];
                            $rua = $rs['rua'];
                            $numero = $rs['numero'];
                            $foto = $rs['imagem'];

                            echo("<div class='reserva'>
                                <!--Foto do restaurante-->
                                <div class='foto_restaurante'>
                                    <img src='../cms/".$foto."' alt=''>
                                </div>
                                <!--Nome do restaurante-->
                                <div class='div_nomeEndRestaurante' style='color:".$corSecundaria."'>
                                    <!--Nome-->
                                    <div class='nome_res' style='background-color:".$corQuartenaria."'>
                                        ".$nomeRestaurante."
                                    </div>
                                    <!--Endereço-->
                                    <div class='end_res' style='background-color:".$corSecundaria."'>
                                        ".$nomeEstado." - ".$nomeCidade." - ".$bairro." - ".$rua." - Nº ".$numero."
                                    </div>
                                </div>
                                <!--Descrição do restaurante-->
                                <div class='descricao_restaurante' style='background-color:".$corSecundaria."'>
                                    <div class='texto_descricaoRes'>
                                        <span class='centra_txt'>".$descRestaurante."</span>
                                    </div>
                                </div>
                                <!--Opção fazer Reserva-->
                                <div class='div_botaoReserva' style='background-color:".$corPrimaria."'>
                                    <!--Botão reservar-->
                                    <a class='centralizar_botao' href='home.php?id=".$idRestaurante."&funcao=reservar'>
                                        <div class='botao_reservar' style='background-color:".$corQuartenaria."; color:".$corSecundaria."'>
                                            <span class='centralizar_texto'>Reservar</span>
                                        </div>
                                    </a>
                                </div>
                            </div>");
                        }


                    ?>
                </div>
				<div id="titulo_menus" style="background-color:<?php echo($corTerciaria);?>">
                      <span style="color:<?php echo($corSecundaria);?>">Menus</span>
					  <div id="linha_abaixoTitulo" style="background-color:<?php echo($corSecundaria);?>">
					  </div>
                  </div>
                <div id="menus">
                  <div id="div_menus">
                      <div class="menu">
                        <img src="../img/steakhouseCategoria.jpg" alt="" class="img_menu">
                        <div class="nome_menu">
                            <p>Steakhouse</p>
                        </div>
                      </div>
                      <div class="menu">
                        <img src="../img/vegetarianoCategoria.JPG" alt="">
                        <div class="nome_menu">
                            <p>Vegetariano</p>
                        </div>
                      </div>
                      <div class="menu">
                        <img src="../img/saudavelCategoria.JPG" alt="">
                        <div class="nome_menu">
                            <p>Saudável</p>
                        </div>
                      </div>
                  </div>
                </div>

                <!--Div Resumo Sobre Nós-->
                <div id="div_resumoSobreNos" style="background-image:url('../cms/<?php echo($imagemInferior); ?>'); background-position:center;">
                    <div id="div_texto_sobreNos">
                        <div id="titulo">
                            <span>The Ribs Steakhouse</span>
                        </div>
                        <div id="subtitulo">
                              <span>Nossa História</span>
                        </div>
						<?php
							//Comando SQL
							$sql = "select SUBSTR(texto,1,200) as 'texto' from tbl_sobrenos where status = 1";
							$select = mysql_query($sql);

							while($rs=mysql_fetch_array($select)){
						?>
                        <div id="texto_sobreNos">
                            <?php echo($rs['texto']); ?>...
                        </div>
						<?php
							}
						?>
						<a href="../sobrenos/sobrenos.php">
							<div id="botao_paraSn" style="background-color:<?php echo($corTerciaria);?>; color:<?php echo($corSecundaria); ?>">
								Sobre Nós
							</div>
						</a>
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
