<!--Div de Cadastro-->
<div id="div_foraEnquete" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUpEnquetes()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/fecharPopUp.png" alt="">
    </div>
    <!--Div de Login-->
    <div id="div_enquete">
        <?php

            //Comando SQL com inner join
            $sql = "select e.titulo, o.alternativa1, o.alternativa2, o.alternativa3, e.id_enquete, o.alternativa4, p.pergunta
                    from tbl_enquete as e inner join tbl_pergunta as p on e.id_enquete = p.id_enquete inner join
                    tbl_opcao as o on p.id_pergunta = o.id_pergunta where e.status = 1";

            $select = mysql_query($sql) or die(mysql_error());

            while($rs=mysql_fetch_array($select)){
                $idEnquete = $rs['id_enquete'];
        ?>
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;"><?php echo($rs['titulo']); ?></span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formEnquete" method="post" action="faleconosco.php">
                <!--Título da Janela-->
                <div id="div_tituloJanela" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;"><?php echo($rs['pergunta']); ?></span>
                </div>
                <!--Opções-->
                <div id="div_radioButton">
                    <label class="texto_radio"><input checked type="radio" class="radio_button" name="alternativa" value="1"><?php echo($rs['alternativa1']); ?><br></label>
                    <label class="texto_radio"><input type="radio" class="radio_button" name="alternativa" value="2"><?php echo($rs['alternativa2']); ?><br></label>
                    <?php
                    
                        if($rs['alternativa3'] != null){
                            ?><label class="texto_radio"><input type="radio" class="radio_button" name="alternativa" value="3"><?php echo($rs['alternativa3']); ?><br></label><?php
                        }
                
                        if($rs['alternativa4'] != null){
                            ?><label class="texto_radio"><input type="radio" class="radio_button" name="alternativa" value="4"><?php echo($rs['alternativa4']); ?><br></label><?php
                        }
                    
                    ?>
                </div>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" name="btn_respEnquete" onClick="expandirParaNovaSenha()" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Enviar</span>
                </button>
            </form>
        </div>
        <?php
            }
        ?>
    </div>
</div>
