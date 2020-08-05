<?php
  namespace App;

  class Controller{
    protected $controller;
    protected $model;

    public function __construct(){

      $url = (isset($_GET['pagina']) && isset($_SESSION['cpanel_username'])) ? $_GET['pagina'] : 'login';
      $explode = explode('/', $url);

      if($explode[0] == 'login' && $this->authenticationLogin() == true){
        self::redirect("dashboard", 0);
        exit();
      }

      $i = [
        "App\\Controllers\\".$explode[0]."Controller", 
        "App\\Models\\".$explode[0]."Model",
      ];

      $dir =  "src/app/Controllers/".$explode[0]."Controller.php";
      if(file_exists($dir)){
        $this->controller = new $i[0];
        $this->model = new $i[1];

        return $this->controller->index();
      }else{
        self::view("404/index.html", []);
      }
      
    }

    public static function view($dir, $params){
      $loader = new \Twig\Loader\FilesystemLoader('src/App/Views/');
      $twig = new \Twig\Environment($loader);

      echo $twig->render($dir, $params);
    }

    public static function getUrl(){
      $e = isset($_GET['pagina']) ? $_GET['pagina'] : 'dashboard';
      $e = explode('/', $e);

      return $e;
  }

  public static function getData($f){
    return date($f);
  }

  public static function alert($type, $title, $description){
    echo "
    <script>
			swal({
				title: '{$title}',
				text: '{$description}',
        icon: '{$type}',
				timer: 2000
				});
		</script>";
  }

  public static function redirect($l, $t){
    echo "<meta http-equiv='refresh' content='{$t}; URL={$l}'/>";
  }

  protected function authenticationLogin(){
    if(isset($_SESSION['cpanel_username'])){
      return true;
    }else{
      return false;
    }
  }


}

