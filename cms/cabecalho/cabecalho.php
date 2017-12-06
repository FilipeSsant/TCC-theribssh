<?php

    //Fazer aparecer o atalho para o Fechamento do pedido caso o funcionário seja um garçom
    $displayFechamentoPedido = "display:block";

    if(isset($_SESSION['id_funcionario'])){
        //Pegar dados do usuário caso ele esteja logado
        $idFuncionarioUniversal = $_SESSION['id_funcionario'];

        //Da um select em todas as informações do usuário
        $sql = "select f.cpf, f.nome_completo, f.num_registro, f.sexo, f.telefone, f.celular, format(f.salario,2,'de_DE') as 'salario' , f.dt_nasc, f.email, f.dia_pagamento, f.comissao,            f.login, f.senha, f.foto, c.nome as 'nomeCargo', f.id_cargo, r.nome as 'nomeRestaurante', f.id_restaurante, cid.id_estado,
               e.id_cidade, e.id_endereco, e.logradouro, e.bairro, e.rua, e.aptbloco, e.numero from tbl_funcionario as f
               inner join tbl_cargo as c on f.id_cargo = c.id_cargo 
               inner join tbl_restaurante as r on f.id_restaurante = r.id_restaurante
               inner join tbl_endereco as e on e.id_endereco = f.id_endereco
               inner join tbl_cidade as cid on cid.id_cidade = e.id_cidade where id_funcionario = ".$idFuncionarioUniversal;

        $select = mysql_query($sql);

        while($rs=mysql_fetch_array($select)){
            $loginFuncionarioU = $rs['login'];
            $cargoFuncionarioU = $rs['nomeCargo'];
            $idCargoFuncionarioU = $rs['id_cargo'];
            $idRestauranteFuncionarioU = $rs['id_restaurante'];
            $emailFuncionarioU = $rs['email'];
            $nomeFuncionarioU = $rs['nome_completo'];
            $fotoFuncionarioU = $rs['foto'];
            
            $_SESSION['idCargoFuncionarioU'] = $idCargoFuncionarioU;
            $_SESSION['idRestauranteFuncionarioU'] = $idRestauranteFuncionarioU;
            
        }
    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

?>
<header>
	<!--Include no SweetAlert-->
	<script src = "sweetalert/sweetalert.min.js" > </script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="sweetalert/core.js"></script>
    <div id="cabecalho_cms">
        <!--Div para o Logo-->
        <div id="div_logoCabecalho">
            <a href="../modulos/sairSessao.php"><img src="img/logo.png" alt=""></a>
        </div>
        <!--Div para o texto do CMS-->
        <div id="div_tituloCabecalho">
            CMS - Gerenciamento do Site
        </div>
        <!--Div do usuário cadastrado-->
        <div id="areaAbrirLogin">
            <div id="areaUser">
                <!--Imagem do usuário-->
                <a href="home.php">
                    <div id="imgUser" onmouseover="abrirDetalhesUser()" onmouseout="fecharDetalhesUser()">
                        <img src="<?php echo($fotoFuncionarioU); ?>" alt=""/>
                    </div>
                </a>    
                <!--Divs de texto-->
                <div id="txtUser">
                    <!--Divs textos para login ou cadastro-->
                    <div id="texto1_areaDoUsuario">
                        <span>BEM VINDO</span>
                    </div>
                    <div id="texto2_areaDoUsuario">
                        <span><?php echo($nomeFuncionarioU); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>

    $(window).resize(function() {
        
        var widthbody = $("body").width();
        
        console.log(widthbody);
        
        if(widthbody == 1861){
            $("#div_tituloCabecalho").css("width","74%");
        }
        
        if(widthbody == 1674){
            $("#div_tituloCabecalho").css("width","72%");
        }
        
        if(widthbody == 1522){
            $("#div_tituloCabecalho").css("width","70%");
        }
        
        if(widthbody == 1338){
            $("#div_tituloCabecalho").css("width","67%");
        }
        
    });
    
    $(document).ready(function(){
                      
        var widthbody = $("body").width();
        
        console.log(widthbody);
        
        if(widthbody == 1861){
            $("#div_tituloCabecalho").css("width","74%");
        }
        
        if(widthbody == 1674){
            $("#div_tituloCabecalho").css("width","72%");
        }
        
        if(widthbody == 1522){
            $("#div_tituloCabecalho").css("width","70%");
        }
        
        if(widthbody == 1338){
            $("#div_tituloCabecalho").css("width","67%");
        }
        
    });
    
</script>
<?php
    //Inclui o popUp com informações do usuário quando se passa o mouse sobre a imagem do usuario
    include_once('popUpDetalhesUsuario.php');
?>
