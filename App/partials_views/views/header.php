<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLANINCORP || <?php echo $title ?></title>
    <link rel="shortcut icon" href="./assets/img/icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   
    <link rel="stylesheet" href=<?php echo './assets/css/main.css?time='.time().'' ?>>
    <link rel="stylesheet" href=<?php echo './assets/css/inventario.css?time='.time().'' ?>>

    
</head>

<body>

<main class="container">

    <nav class="navigation">
        <ul>
            <li>
                <a class="logo" href="./home">
                <img width="44" src="./assets/img/logo3.png" alt="">
                    <span class="title">
                    <h4>PLANINCORP</h4>
                </span>
                </a>
            </li>
            <li>
                <a title="Inicio" href="./home">
                    <span class="icon"><i class="fas fa-home" aria-hidden="true"></i></span>
                    <span class="title">Inicio</span>
                </a>
            </li>
            <li>
                <a title="Categorias" href="./category">
                    <span class="icon"><i class="fas fa-tags" aria-hidden="true"></i></span>
                    <span class="title">Categorias</span>
                </a>
            </li>
            <li>
                <a title="Proveedores" href="./provider">
                    <span class="icon"><i class="fas fa-address-card"></i></span>
                    <span class="title">Proveedores</span>
                </a>
            </li>
            <li>
                <a title="Productos" href="./product">
                    <span class="icon"><i class="fas fa-box-open" aria-hidden="true"></i></span>
                    <span class="title">Productos</span>
                </a>
            </li>
            <li>
                <a title="Compras" href="./buying">
                    <span class="icon"><i class="fas fa-shopping-cart" aria-hidden="true"></i></span>
                    <span class="title">Compras</span>
                </a>
            </li>
            
            <li>
                <a title="Inventario" href="./inventory">
                    <span class="icon"><i class="fas fa-warehouse" aria-hidden="true"></i></span>
                    <span class="title">Inventario</span>
                </a>
            </li>
        
        </ul>

        <a title="Cerrar Sesión" class="sign-out" href="./destroy">
                    <span class="icon"><i class="fas fa-sign-out-alt" aria-hidden="true"></i></span>
                    <span class="title">Cerrar Sesi&oacute;n</span>
        </a>
    </nav>

    <header>
        <i id="btn_menu" class="fas fa-bars" aria-hidden="true"></i>

        <img id="img_profile" title="Bienvenid@ demo@planincorp.com.mx" class="profile" src="https://cdn.imgbin.com/22/11/7/imgbin-business-3d-computer-graphics-three-dimensional-space-person-company-3d-villain-U1kmv4yfA3hu7ecykjCVGLWdN.jpg" alt="">
        <div class="menu">

            <ul>
                <li>
                    <a href="./area"> <i class="fas fa-building" aria-hidden="true"></i> &Aacute;reas</a>
                </li>
                
                <li>
                    <a href="./staff"> <i class="fas fa-user-friends" aria-hidden="true"></i> Personal</a>
                </li>
          
                <li>
                    <a class="menu-signout" href="./destroy"> <i class="fas fa-sign-out-alt" aria-hidden="true"></i> Cerrar Sesi&oacute;n</a>
                </li>
            </ul>
        </div>
    
    </header>

    
