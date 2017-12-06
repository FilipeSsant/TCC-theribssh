<footer>
    <!--Linha-->
    <div id="linhaRodape">
    </div>
    <!--Fundo do Rodapé-->
    <div id="rodapeBg" style="background-color:<?php echo($corQuartenaria); ?>;">
        <!--Div rua do restaurante-->
        <div id="nomeRuaRodape">
            <span style="color:<?php echo($corSecundaria); ?>;">Av. Luiz Carlos Berrini</span>
        </div>
        <!--Div logo da empresa-->
        <div id="divLogoRodape">
            <!--Logo-->
            <div id="logoRodape">
                <img src="../img/logo.png" alt="">
            </div>
        </div>
        <!--Div acolhedora de redes sociais-->
        <div id="divRedeSocial">
            <!--Redes Sociais-->
            <div id="divAgrupadoraRedeSocial">
                <?php

                    //Comando SQL
                    $sql = "select * from tbl_redesocial where status = 1";
                
                    $select = mysql_query($sql) or die(mysql_error());
                
                    while($rs=mysql_fetch_array($select)){
                ?>
                    <div class="redeSocial">
                        <a href="<?php echo($rs['link']); ?>"><img src="../cms/<?php echo($rs['imagem']); ?>" alt=""></a> 
                    </div>   
                <?php
                    }

                ?>
            </div>
        </div>
        <!--Div Todos os Direitos Reservados-->
        <div id="divTodosDireitos">
            <div id="todosDireitos">
                <span style="color:<?php echo($corSecundaria); ?>;">2017 © The Ribs Steakhouse. Todos os Direitos Reservados.</span>
            </div>
        </div>
        <a href="../apk/theribssh.apk">
            <div id="divAndroid_baixar">
                <div id="foto_android">
                    <img src="../img/android.png" alt="">
                </div>
                <div id="texto_android">
                    Baixe o Nosso Aplicativo Aqui!
                </div>
            </div>
        </a>    
    </div>

</footer>
