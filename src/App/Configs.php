<?php
    namespace App;

# CONFIGURAÇÕES DO BANCO E DADOS #
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    define('db_name','panelapp');


# CONFIGURAÇÕES DO SITE #
    define('titulo_site', "Cpanel");
    define('logo_site', './assets/img/logo.png');
    define('favicon', 'https://tutoriaiseinformatica.com/assets/images/logo-icon-122x122.png');
    define('icon_ceo', 'https://tutoriaiseinformatica.com/blog/images/defaultimg.png');
    define('base_href','http://localhost/cpanel/');
    
# CONFIGURAÇÕES CEO E METAS
    define("ceo", [
        'keywords' => '',
        'description' => '',
    ]);

# CONFIGURAÇÕES DO SERVIDOR
    define("host_ip", "localhost");
    define("host_root", "d:\\nodeServers\\");


# CONFIGURAÇÕES DE DATA #
    date_default_timezone_set("America/Sao_Paulo");


