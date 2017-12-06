<!--Div de Cadastro-->
<div id="div_foraCadastroReserva" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <a href="home.php">
        <div class="botao_fecharPopUp" onClick="fecharPopUpCadastroReserva()" style="background-color:<?php echo($corQuartenaria); ?>;">
            <img src="../img/fecharPopUp.png" alt="">
        </div>
    </a>
    <!--Div de Login-->
    <div id="div_cadastroReserva">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;">Reservar</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div class="formulario_cadastro">
            <form name="formCadastroReserva" method="post" action="#">
                <script>

                    var mesEscrito = "";
                    var mesNumerico = <?php echo($mesNumerico); ?>;
                    var dia = <?php echo(cal_days_in_month(CAL_GREGORIAN, $mesNumerico, $ano)); ?>;
                    var ano = <?php echo($ano); ?>;
                    var minimoMes = mesNumerico - 1;
                    var maximoMes = mesNumerico + 1;

                    $(document).ready(function(){
                        nomeMes();
                    });

                    //Pega o dia para verificar no banco de dados se a mesa foi reservada naquele dia
                    function mudarSelectMesa(){
                        //Coloca na variavel o value que está na caixa
                        var periodoSelecionado = $("#selectPeriodo").val();
                        var idRestaurante = <?php echo($_GET['id']); ?>;
                        var dataPreMarcada = $("#input_dia").val();
                        //Coloca na variavel a url que vai redirecionar para fazer o processo
                        var url = "../ajax/mudarSelectMesa.php";
                        $.ajax({
                            //Define o método
                            method:"POST",
                            //Define a url
                            url:url,
                            //Coloca em formato JSON as informações para passar pelo POST
                            data:{periodoselecionado:periodoSelecionado, idrestaurante:idRestaurante, datapremarcada:dataPreMarcada},
                            success:function(dados){
                                //Manda os dados que será concebido como $resultado para a div ou input em questão
                                $("#selectMesa").html(dados);
                            }
                        });
                    }

                    //Pega o dia para verificar no banco de dados se a mesa foi reservada naquele dia
                    function verificarPeriodoAtivo(){
                        //Coloca na variavel o value que está na caixa
                        var idRestaurante = <?php echo($_GET['id']); ?>;
                        var dataPreMarcada = $("#input_dia").val();
                        //Coloca na variavel a url que vai redirecionar para fazer o processo
                        var url = "../ajax/verificarPeriodoAtivo.php";
                        $.ajax({
                            //Define o método
                            method:"POST",
                            //Define a url
                            url:url,
                            //Coloca em formato JSON as informações para passar pelo POST
                            data:{idrestaurante:idRestaurante, datapremarcada:dataPreMarcada},
                            success:function(dados){
                                //Manda os dados que será concebido como $resultado para a div ou input em questão
                                $("#selectPeriodo").html(dados);
                            }

                        });
                    }


                    function nomeMes(){
                        switch(mesNumerico){
                            case 1:
                                mesEscrito = "Janeiro";
                                break;
                            case 2:
                                mesEscrito = "Fevereiro";
                                break;
                            case 3:
                                mesEscrito = "Março";
                                break;
                            case 4:
                                mesEscrito = "Abril";
                                break;
                            case 5:
                                mesEscrito = "Maio";
                                break;
                            case 6:
                                mesEscrito = "Junho";
                                break;
                            case 7:
                                mesEscrito = "Julho";
                                break;
                            case 8:
                                mesEscrito = "Agosto";
                                break;
                            case 9:
                                mesEscrito = "Setembro";
                                break;
                            case 10:
                                mesEscrito = "Outubro";
                                break;
                            case 11:
                                mesEscrito = "Novembro";
                                break;
                            case 12:
                                mesEscrito = "Dezembro";
                                break;
                        }

                        $("#nome_mes").html(mesEscrito+" - "+ano);
                        var idRestaurante = <?php echo($_GET['id']); ?>;

                        //Coloca na variavel a url que vai redirecionar para fazer o processo
                        var url = "../ajax/mudarMes.php";

                        $.ajax({
                            //Define o método
                            method:"POST",
                            //Define a url
                            url:url,
                            //Coloca em formato JSON as informações para passar pelo POST
                            data:{mesnumerico:mesNumerico, ano:ano, idrestaurante:idRestaurante},
                            success:function(dados){
                                //Manda os dados que será concebido como $resultado para a div ou input em questão
                                $(".divDia_mes").html(dados);
                            }

                        });

                    }

                    function mesProximo(){
                        if (mesNumerico + 1 <= maximoMes){
                            mesNumerico = mesNumerico + 1;
                            if(mesNumerico > 12){
                                ano = ano + 1;
                                mesNumerico = 1;
                            }
                            nomeMes();
                        }
                    }

                    function mesAnterior(){
                        if (mesNumerico - 1 > minimoMes){
                            mesNumerico = mesNumerico - 1;
                            if(mesNumerico < 1){
                                ano = ano - 1;
                                mesNumerico = 12;
                            }
                            nomeMes();
                        }
                    }

                </script>
                <!--Calendário-->
                <div id="div_calendario">
                    <div id="setas_calendario" style="background-color:<?php echo($corQuartenaria); ?>; color:<?php echo($corSecundaria); ?>;">
                        <div class="anterior" title="Mês Anterior" onclick="mesAnterior()"><span class="centralizar_texto">&#10094;</span></div>
                        <div class="proximo" title="Próximo Mês" onclick="mesProximo()"><span class="centralizar_texto">&#10095;</span></div>
                    </div>
                    <div class="div_mes" style="background-color:<?php echo($corTerciaria); ?>; color:<?php echo($corSecundaria); ?>;">
                        <span class="centralizar_texto" id="nome_mes" ></span>
                    </div>
                    <div class="divDia_semana" style="background-color:<?php echo($corPrimaria); ?>; color:<?php echo($corSecundaria); ?>;">
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Dom</span>
                        </div>
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Seg</span>
                        </div>
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Ter</span>
                        </div>
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Qua</span>
                        </div>
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Qui</span>
                        </div>
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Sex</span>
                        </div>
                        <div class="dia_semana">
                            <span class="centralizar_texto" >Sab</span>
                        </div>
                    </div>
                </div>
                <script>
                    var diaAnterior = "";
                    //Pegar o dia para depois inserir-lo
                    function pegarDia(dia, diaAt){
                        $("#input_dia").val(ano+"-"+mesNumerico+"-"+dia);
                        if(diaAnterior == diaAt){
                            $("#dia"+diaAnterior).css({"background-color":"#1768bb"});
                        }else{
                            $("#dia"+diaAnterior).css({"background-color":"<?php echo($corPrimaria); ?>"});
                        }

                        $("#dia"+dia).css({"background-color":"#dc9a05"});
                        diaAnterior = dia;
                    }
                </script>
                <div class="divDia_mes">
                </div>
                <input id="input_dia" type="hidden" name="txt_dtMarcada">
                <!--Select Período-->
                <select id="selectPeriodo" class="select" name="selectPeriodo" onchange="mudarSelectMesa()" required>
                   <option value="" selected disabled>Selecione um Período</option>
                </select><br>
                <!--Select quantidade de assentos-->
                <select id="selectMesa" class="select" name="selectMesa" required>
                    <option value="" selected disabled>Selecione a quantidade de lugares</option>
                </select><br>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" name="btnCadastrarReserva" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Reservar</span>
                </button>
            </form>
        </div>
    </div>
</div>
