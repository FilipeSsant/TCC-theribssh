<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_perguntaEnquete.php">
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
                <span><?php echo($tituloPopUp); ?> Pergunta</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroPergunta" method="post" action="crud_perguntaEnquete.php">
                <!--Pergunta-->
                <input class="input_texto" value="<?php echo($pergunta); ?>" type="text" name="txt_nomePergunta" placeholder="Pergunta" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Enquetes
                </div>
                <!--Select Enquete-->
                <select class="select" name="selectEnquete" required>
                    <option selected disabled>Selecione uma Enquete</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_enquete";
                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idEnquete = $rs['id_enquete'];
                            $tituloEnquete = $rs['titulo'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($idEnqueteAlterar == $idEnquete){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                            
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idEnquete);?>"><?php echo($tituloEnquete); ?></option>
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
