<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PLANINCORP Sistema de Compras JavaScript PHP MVC">
    <meta name="author" content="aasanchezlazcano@gmail.com">
    <link rel="shortcut icon" href="./assets/img/icon.png" type="image/x-icon">

    <title>PLANINCORP || Sistema de Compras</title>
   
    <link rel="stylesheet" href="./assets/css/login.css?v=<?php echo time() ?>">

  </head>

  <body>

    <section>
        <div class="container">
            <div class="signinBx">

                <img src="./assets/img/logoplanin.jpg" alt="">

                <hr/>

                <form class="form" form action="./public/login" method="POST" >
        
                    <label for="inputEmail" class="sr-only">Email</label>
                    
                    <input id="inputEmail" type="text" name="email" placeholder="demo@planincorp.com.mx" readonly autofocus>

                    <label for="inputPassword" class="sr-only">Contrase&ntilde;a</label>

                    <input id="inputPassword" type="password" name="pass" readonly placeholder="**********">

                    <input type="submit" value="Entrar"></button>

                </form>

            </div>
    </section>
  
  </body>

</html>
