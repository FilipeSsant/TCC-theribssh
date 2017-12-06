<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_mesa.php">
        <div class="botao_fecharPopUp" onClick="fecharPopUp()">
            <img src="img/fecharPopUp.png" alt="">
        </div>
    </a>    
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <span><?php echo($tituloPopUp); ?> Mesa</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroMesas" method="post" action="crud_mesa.php">
                <!--Nome da mesa-->
                <input class="input_texto" value="<?php echo($nomeMesa); ?>" type="text" name="txt_nomeMesa" placeholder="Nome da Mesa" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Restaurante
                </div>
                <!--Select Restaurante-->
                <select class="select" name="selectRestaurante" required>
                    <option selected disabled>Selecione um Restaurante</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_restaurante";
                    
                        $select = mysql_query($sql) or die(mysql_error());
                    
                        while($rs=mysql_fetch_array($select)){
                            $idRestaurante = $rs['id_restaurante'];
                            $nomeRestaurante = $rs['nome'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($idRestauranteBanco == $idRestaurante){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                            
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idRestaurante);?>"><?php echo($nomeRestaurante); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Tipo de mesa
                </div>
                <!--Select Tipo de Mesa-->
                <select class="select" name="selectTipoMesa" required>
                    <option selected disabled>Selecione qual o tipo de mesa</option>
                    <?php

                        //Comando SQl
                        $sql = "select * from tbl_tipomesa";
                    
                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idTipoMesa = $rs['id_tipomesa'];
                            $nomeTipo = $rs['nome'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($idTipoMesaBanco == $idTipoMesa){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idTipoMesa);?>"><?php echo($nomeTipo); ?> Assentos</option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_mesa">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
