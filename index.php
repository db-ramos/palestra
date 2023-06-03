<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0BAC6C">
    <script src="https://unpkg.com/@phosphor-icons/web" defer></script>
    <title>Sistema de Palestras</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <header>
        <h1><a href="./"><i class="ph ph-chalkboard-teacher"></i> Palestras <i class="ph ph-users-four"></i></a></h1>
        <nav class="secao">
            <ul>
                <li><a href="?page=cadastrar"><i class="ph ph-identification-card"></i> Cadastrar </a></li>
                <li><a href="?page=excluir"><i class="ph ph-trash"></i> Excluir</a></li>
                <li><a href="?page=listar"><i class="ph ph-user-list"></i> Listar</a></li>
                <li><a href="?page=alterar"><i class="ph ph-pencil-simple"></i> Editar</a></li>
            </ul>
        </nav>
    </header>

    <section class="secao">
    <?php 
        require "./controllers/Palestra.php";
        $palestra = new Palestra();
        $page = isset($_GET['page']) ? $_GET['page'] : "";

        switch ($page) {
            case 'cadastrar':                
                if(isset($_POST["bt_cadastrar"])) {                   
                    $titulo = $_POST['titulo'];
                    $palestrante = $_POST['palestrante'];
                    $data = $_POST['data'];
                    $hora = $_POST['hora'];         
                    $resultado = $palestra->cadastrar($titulo,$palestrante,$data,$hora);
                    require "resultado.php";
                }else{    
                    require "cadastrar.php";
                }               
                break;    
            case 'excluir':
                if(isset($_POST["bt_excluir"])) {                   
                    $id = $_POST['id'];                             
                    $resultado = $palestra->excluir($id);
                    require "resultado.php";
                }else{    
                    require "excluir.php";
                }               
                break;      
            case 'alterar':
                if(isset($_POST["bt_editar"])){
                    $id = $_POST['id'];
                    require "alterar_editar.php";
                }else if (isset($_POST["bt_salvar"])){
                    $id = $_POST['id'];
                    $titulo = $_POST['titulo'];
                    $palestrante = $_POST['palestrante'];
                    $data = $_POST['data'];
                    $hora = $_POST['hora'];         
                    $resultado = $palestra->alterar($id,$titulo,$palestrante,$data,$hora);
                    require "resultado.php";
                }else{
                    require "alterar.php";
                }
                break;
            default:                
                require "listar.php";
                break;
        }
    ?>
    </section>

</body>

</html>