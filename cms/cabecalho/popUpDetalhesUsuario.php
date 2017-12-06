<!--Janela ver Perfil ou Sair-->
<div id="ponta_divInfoUsuario" onmouseover="abrirDetalhesUser()" onmouseout="fecharDetalhesUser()">
</div>
<div id="informacoes_usuario" onmouseover="abrirDetalhesUser()" onmouseout="fecharDetalhesUser()">
    <!--Agrupadora de Login, E-mail e Visualização do Perfil-->
    <div id="div_meuPerfil">
        <!--Div login-->
        <div id="div_nomeLogin">
            <b><?php echo($loginFuncionarioU); ?></b>
        </div>
        <!--Div cargo-->
        <div id="div_cargoUser">
            <b><?php echo($cargoFuncionarioU); ?></b>
        </div>
        <!--Div email-->
        <div id="div_cargoUser">
            <?php echo($emailFuncionarioU); ?>
        </div>
    </div>
    <!--Div para sair da conta-->
    <div id="div_sairUser">
        <a href="../modulos/sairSessao.php"><button id="botao_popUpUserSair" type="button"?>Sair</button></a>
    </div>
</div>
