<?php

?>
<!--Área do usuário não cadastrado-->
<div id="areaAbrirLogin">
    <div id="areaUser" style="background-color:<?php echo($corQuartenaria); ?>;">
        <!--Imagem do usuário-->
        <a href="../meuperfil/meuperfil.php">
            <div id="imgUser" onclick="abrirDetalhesUser()">
                <img src="../<?php echo($fotoUsuario); ?>" alt=""/>
            </div>
        </a>
        <!--Divs de texto-->
        <div id="txtUser" style="background-color:<?php echo($corQuartenaria); ?>;">
            <!--Divs textos para login ou cadastro-->
            <div id="texto1_areaDoUsuario">
                <span style="color:<?php echo($corSecundaria); ?>;">BEM VINDO</span>
            </div>
            <div id="texto2_areaDoUsuario">
                <span style="color:<?php echo($corSecundaria); ?>;"><?php echo($nomeUsuario);?> <?php echo($sobrenomeUsuario); ?></span>
            </div>
        </div>
        <!--Div para sair da conta-->
        <div id="div_sairUser" style="background-color:<?php echo($corQuartenaria); ?>;">
            <a href="../modulos/sairSessao.php"><img src="../img/sair.png" alt="" title="Sair da sessão"></a>
        </div>
    </div>
</div>
