<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');
    //inclui o php Universal que utilizara em todas as páginas
    include_once('../externos/phpUniversal.php');

	//Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $selectPeriodo = "";
    $selectMesa = "";
    $dataMarcada = "";
    $dataAtual = "";
    $dateTimeReserva  = "";
    $horarioDataFeita = "";
    $dataProximaReserva = "";
    $dataHorarioAtual = "";

    $horarioFeito = "";

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
        <link rel="stylesheet" href="../css/cssUniversal.css">
        <link rel="stylesheet" href="../css/home_mobile.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="../jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="../jquery/jquerymaskplugin.js" ></script>
        <!--Script de Máscaras-->
        <script>
            
		function fecharReserva(){
			android.fechar();
		}
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
            <!--Cabeçalho-->
            <?php
                //Inclui o pop up do cadastro de reservas
                include_once('popUps/cadastroReserva_mobile.php');
                //Quando for clicado no botão reservar
                if(isset($_GET['funcao'])){
                    $funcao = $_GET['funcao'];
                    if(isset($_GET['id_cliente'])){
                        $id_cliente = $_GET['id_cliente'];
                        //Seleciona na tabela de reservas com o id do cliente
                        $sql = "select * from tbl_reserva where id_cliente = ".$id_cliente;
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
                                $sql = "select horarioDataFeita from tbl_reserva where id_cliente = ".$id_cliente." order by horarioDataFeita desc limit 1";
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
                                            android.toast("A reserva só poderá ser feita em <?php echo($dataProximaBR); ?> às <?php echo($horarioProxima); ?>");
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
                    }

                }

                //Botão de reserva
                if(isset($_POST['btnCadastrarReserva'])){
                    //Resgata os valores
                    $idCliente = $_SESSION['id_cliente'];
                    $idCliente = $_GET['id_cliente'];
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
                                      android.toast("Reserva feita. É possível visualizar nos históricos.");
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
            </section>
        </div>
    </body>
</html>
