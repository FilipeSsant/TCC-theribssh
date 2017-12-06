<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_opcoesPergunta.php">
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
                <span><?php echo($tituloPopUp); ?> Alternativas</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroAlternativas" method="post" action="crud_opcoesPergunta.php">
                <!--Alternativas-->
                <input class="input_texto" value="<?php echo($alternativa1); ?>" type="text" name="txt_alternativa1" placeholder="Alternativa 1" required><br>
                <input class="input_texto" value="<?php echo($alternativa2); ?>" type="text" name="txt_alternativa2" placeholder="Alternativa 2" required><br>
                <input class="input_texto" value="<?php echo($alternativa3); ?>" type="text" name="txt_alternativa3" placeholder="Alternativa 3"><br>
                <input class="input_texto" value="<?php echo($alternativa4); ?>" type="text" name="txt_alternativa4" placeholder="Alternativa 4"><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Pergunta
                </div>
                <!--Select Enquete-->
                <select class="select" name="selectPergunta" required>
                    <option selected disabled>Selecione uma Pergunta</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_pergunta";
                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idPergunta = $rs['id_pergunta'];
                            $pergunta = $rs['pergunta'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($selectPergunta == $idPergunta){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idPergunta);?>"><?php echo($pergunta); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_perguntaEnquete">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
