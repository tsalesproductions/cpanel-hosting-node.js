<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="select">Criar/Deletar Controllers</label><br>
        <select name="acao" id="select">
        <option value="c">Criar</option>
        <option value="d">Deletar</option>
        </select>
        <input type="text" name="controller" required>
        <input type="submit" name="criar" value="Ok"/>
    </form>
    
    <?php
        function create($c){
            $dir = "src/App/Controllers/".$_POST['controller']."Controller.php";
            if(file_exists($dir)){
                die("Controller já existente");
            }else{
                createController($c, controller($_POST['controller']));
                createModel($c, model($_POST['controller']));
                createView($_POST['controller']);
                echo "Criado com sucesso!!";
            }
        }
    
        function controller($name){
            return "<?php
            namespace App\Controllers;
        
            use app\Controller;
            use App\Models\\".$name."Model;
        
            class {$name}Controller extends {$name}Model{
                public function index(){
                    Controller::view('{$name}/index.html', []);
                }
            }";
        }
    
        function model($name){
            return "<?php
            namespace App\Models;
        
            use App\Connection;
        
            class {$name}Model extends Connection{
                
            }";
        }
    
        function createController($c, $t){
            $fp = fopen("src/App/Controllers/{$c}Controller.php","wb");
            fwrite($fp,$t);
            fclose($fp);
        }
    
        function createModel($m, $t){
            $fp = fopen("src/App/Models/{$m}Model.php","wb");
            fwrite($fp,$t);
            fclose($fp);
        }
    
        function createView($v){
            $content = "Eu estou na $v";
            mkdir("src/App/Views/$v", 0700);
            $fp = fopen("src/App/views/$v/index.html","wb");
            fwrite($fp,$content);
            fclose($fp);
        }

        function rrmdir($dir) {
            if (is_dir($dir)) {
              $objects = scandir($dir);
              foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                  if (filetype($dir."/".$object) == "dir") 
                     rrmdir($dir."/".$object); 
                  else unlink   ($dir."/".$object);
                }
              }
              reset($objects);
              rmdir($dir);
            }
        }
        

        function delete($name){
            $dir = 
            [   
                "src/App/Controllers/{$name}Controller.php",
                "src/App/Models/{$name}Model.php",
                "src/App/Views/{$name}"
                
            ];
            if(file_exists($dir[0])){
                rrmdir($dir[2]);
                unlink($dir[0]);
                unlink($dir[1]);
                echo "Deletado com sucesso!!";
            }else{
                echo "Controller não encontrado";
            }
        }
    
        if(isset($_POST['criar'])){
            if($_POST['acao'] == "c"){
                create($_POST['controller']);   
            }else{
                delete($_POST['controller']);
            }
              
        }
    ?>
</body>
</html>