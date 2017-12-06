<?php

    //Conexão com o banco
    include_once('../conexao/mysql.php');
    //inclui o php Universal que utilizara em todas as páginas
    include_once('../externos/phpUniversal.php');
    //Inclui o Pop Up Login
    include_once("areaUsuario/popUps/popUplogin.php");
    //Inclui o Pop Up Login do Funcionario
    include_once("areaUsuario/popUps/popUpLoginFuncionario.php");
    //Inclui o Pop Up Cadastro caso o usuário clique em cadastrar
    include_once("areaUsuario/popUps/popUpcadastro.php");

    //Retirando erros caso o campo esteja nulo
    $idEstadoAjax = "";

    $idEnderecoUsuario = "";
    $loginUsuario = "";
    $nomeUsuario = "";
    $sobrenomeUsuario = "";
    $senhaUsuario = "";
    $celularUsuario = "";
    $telefoneusuario = "";
    $emailUsuario = "";
    $fotoUsuario = "";

?>
<!--Colocar o campo com uma determinada restrição-->
<script>
    
    //Restringir o espaço
    function semEspaco(caractere){
        
        //Se o navegador for firefox ou chrome
        c1 = caractere.keyCode;
        //Se o navegador for internet
        c2 = caractere.which;
        
        if(c1 == 32 || c2 == 32){
            caractere.preventDefault();   
        }
        return true;
        
    }
    
    //Menu Responsivo
            
    function abrirMenuResponsivo(){
        $("#div_transparenteMenuResponsivo").css({"height":"100%"});
    }

    function fecharMenuResponsivo(){
        $("#div_transparenteMenuResponsivo").css({"height":"0px"});
    }
    
</script>
<header>
	<!--Include no SweetAlert-->
	<script src = "../sweetalert/sweetalert.min.js" > </script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="../sweetalert/core.js"></script>
    <!--Fundo do cabeçalho-->
    <div id="cabecalhoBg" style="background-color:<?php echo($corTerciaria); ?>; box-shadow: solid 1px 1px 12px <?php echo($corQuartenaria); ?>">
      <!--Logo-->
      <div id="logoCabecalho" style="background-color:<?php echo($corQuartenaria); ?>;">
          <div id="centralizar_mobile"><a href="../home/home.php"><img src=" ../img/logo.png" alt=""></a></div>
      </div>
      <!--Div menu-->
      <div id="div_areaMenu" style="background-color:<?php echo($corTerciaria); ?>;">
          <nav id="areaMenu">
              <ul>
                  <li><a href="../home/home.php" style="color:<?php echo($corSecundaria); ?>;">Home</a></li>
                  <li><a href="../cardapio/cardapio.php" style="color:<?php echo($corSecundaria); ?>;">Cardápio</a></li>
                  <li><a href="../sobrenos/sobrenos.php" style="color:<?php echo($corSecundaria); ?>;">Sobre Nós</a></li>
                  <li><a href="../faleconosco/faleconosco.php" style="color:<?php echo($corSecundaria); ?>;">Fale Conosco</a></li>
              </ul>
          </nav>
      </div>

      <?php

        //Inclui o módulos
        include_once('../modulos/cadastro.php');
        include_once('../modulos/autenticacaoUsuario.php');
        include_once('../modulos/autenticacaoFuncionario.php');

        if(isset($_SESSION['id_cliente'])){
            //Pegar dados do usuário caso ele esteja logado
            $idCliente = $_SESSION['id_cliente'];

            //Da um select em todas as informações do usuário
            $sql = "select * from tbl_cliente where id_cliente = ".$idCliente;

            $select = mysql_query($sql);

            while($rs=mysql_fetch_array($select)){
                $idEnderecoUsuario = $rs['id_endereco'];

                $loginUsuario = $rs['login'];
                $nomeUsuario = $rs['nome'];
                $sobrenomeUsuario = $rs['sobrenome'];
                $senhaUsuario = $rs['senha'];
                $celularUsuario = $rs['celular'];
                $telefoneusuario = $rs['telefone'];
                $emailUsuario = $rs['email'];
                $fotoUsuario = $rs['foto'];
            }
            
            //Inclui no cabeçalho a área do usuário cadastrado
            include_once('areaUsuario/usuario_cadastrado.php');
            
        }else{
            //Inclui a Área do Usuário, se for um usuário cadastrado terá funções diferentes de um não cadastrado
            include_once('areaUsuario/usuario_naoCadastrado.php');
        }

        
    ?>
    </div>
    <div id="botao_menu_responsivo" onclick="abrirMenuResponsivo()" style="background-color:<?php echo($corPrimaria); ?>;">
        <img src="../img/menu.png" alt="">
    </div>
</header>
<!--Div menu responsivo-->
<div id="div_transparenteMenuResponsivo" style="background-color:<?php echo($corPrimaria); ?>;">
    <div class="botao_fecharPopUp" onclick="fecharMenuResponsivo()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/fecharPopUp.png" alt="">
    </div>
    <div id="div_areaMenuResponsivo" style="background-color:<?php echo($corPrimaria); ?>;">
      <nav id="areaMenuResponsivo">
          <ul>
              <li><a href="../home/home.php" style="color:<?php echo($corSecundaria); ?>;">Home</a></li>
              <li><a href="../cardapio/cardapio.php" style="color:<?php echo($corSecundaria); ?>;">Cardápio</a></li>
              <li><a href="../sobrenos/sobrenos.php" style="color:<?php echo($corSecundaria); ?>;">Sobre Nós</a></li>
              <li><a href="../faleconosco/faleconosco.php" style="color:<?php echo($corSecundaria); ?>;">Fale Conosco</a></li>
          </ul>
      </nav>
    </div>
</div>    
<div id="espacoVazio" style="background-color:<?php echo($corTerciaria); ?>;"></div>

