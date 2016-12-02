<?php

require_once("./php/html.php");
HTML::abrirhtml("MueblesBBB","<link rel='stylesheet' type='text/css' href='./css/estilo.css'");

?>

<div id="contenedor">
<p>Prueba</p>
<!-- creamos la cabecera con 3 div donde va el logo, buscador y redes sociales y acceso de los usuarios.-->
        <div id="cabecera1">
            <!--div para letrero de la empresa -->
            <div id="letrero">
                <img src="./img/PortadaMuebleBBB - copia.png" />
            </div>
            <!-- div para buscador de la empresa -->
            <div id="datos">
                <p> Siguenos en nuestras Redes Sociales </p><br/>
                <a href="URL-Twitter" target="_blank"><img alt="siguenos en Twitter" height="32" src="http://2.bp.blogspot.com/-CaF1EOBAWj4/UiX1AxmkZuI/AAAAAAAAB2Y/IioIplosXNo/s1600/Twitter+NEW.png" title="siguenos en Twitter" width="32" style="margin-right:15px" /></a>
                <a href="URL-FACEBOOK" target="_blank"><img alt="siguenos en facebook" height="32" src="http://2.bp.blogspot.com/-q_Tm1PpPfHo/UiXnJo5l-VI/AAAAAAAABzU/MKdrVYZjF0c/s1600/face.png" title="siguenos en facebook" width="32" style="margin-right:15px" /></a>
                <a href="URL-Instagram" target="_blank"><img alt="sígueme en Instagram" height="32" src="http://2.bp.blogspot.com/-kQop92g4NsM/UidPJ06ER1I/AAAAAAAACAA/0mj0jK5hhXM/s1600/instagram2.png" title="sígueme en Instagram" width="32" style="margin-right:15px" /></a>

             </div>
            <!-- div para iconos administracion -->
            <div id ="administracion">
                <div id="registro">
                  <a href="#" ><img src="./img/registro_icono.png"title="Entrar o Registrarse">
                </div>
                <div id="buscador">
                  <a href="#" ><img src="./img/unnamed.png"title="Buscador">
                </div>
            </div>
       </div>
<!-- creamos el menu mediante un div y dentro una lista horizontal-->
        <div id ="menu">
            <ul>
                <li class='top'><a class='top_link' href='#'><span>INICIO</span></a></li>
                </li>
                <li class='top'><a class='top_link' href='#'><span class='down'>Cocina </span></a>
                </li>
                <li class='top'><a class='top_link' href='#'><span class='down'>Baño</span></a>
                </li>
                <li class='top'><a class='top_link' href='#'><span class='down'>Dormitorio</span></a>
                </li>
                <li class='top'><a class='top_link' href='#'><span class='down'>Salon</span></a>
                </li>
                <li class='top'><a class='top_link' href='#'><span class='down'>Dormitorio</span></a>
                </li><li class='top'><a class='top_link' href='#'><span class='down'>Dormitorio</span></a>
                </li>
                
			</ul>		

        </div>
<!-- creamos con un div la zona donde irá el slider con las ofertas mas destacadas-->
        <div id="ofertas">
            <p>hola</p>
        
        </div>
            
<!--creamos la seccion donde estaran los productos mas destacados-->
        <div id ="destacados">
            <h1>Destacados del Mes </h1>
            <div id ="destaca1">
                <div id="foto">
                    <img src="./img/Articulos destacados/0133450_PE288918_S3.png" width="200px" heigth="200px"  id="fot"/>
                    <p> Mesa para comedor</p>
                   <div id="boton">
                      <a href ="#" class="button" />Añadir</a>
                    </div>
                </div>
            </div>

            <div id ="destaca1">
                 <div id="foto">
                    <img src="./img/Articulos destacados/0238901_PE378511_S3.png" width="200px" heigth="200px"  id="fot"/>
                    <p>Lampara Luminada </p>
                    <a href ="#" class="button"/>Añadir</a>
                </div>
            </div>

            <div id ="destaca1">
             <div id="foto">
                    <img src="./img/Articulos destacados/0243921_PE383211_S3.png" width="200px" heigth="200px"  id="fot"/>
                    <p>Cubo de Basura </p>
                    <a href ="#" class="button"/>Añadir</a>
                </div>
            </div>

            <div id ="destaca1">
             <div id="foto">
                    <img src="./img/Articulos destacados/0364902_PE548516_S3.png" width="200px" heigth="200px"  id="fot"/>
                    <p> Frigorifico No-Frost</p>
                    <a href="#" class="button"/>Añadir</a>
                </div>
            </div>
            
            <div id ="destaca1">
             <div id="foto">
                    <img src="./img/Articulos destacados/74484_PE191627_S3.png" width="200px" heigth="200px"  id="fot"/>
                    <p>Mesita de noche </p>
                    <a href="#" class="button"/>Añadir</a>
                </div>
            </div>

            <div id ="destaca1">
             <div id="foto">
                    <img src="./img/Articulos destacados/sillon-relax-reposapies-marron.png" width="200px" heigth="200px"  id="fot"/>
                    <p>Sillon reconfortable</p>
                    <a href="#" class="button"/>Añadir</a>
                </div>
            </div>

            
           
        </div>
        
        <div id="pie">
            <div id="comprar">
                <h5>PORQUE COMPRAR</h5>
                <ul>
                    <li>Como comprar</li>
                    <li>Formas de Pago</li>
                    <li>Gastos de envio</li>
                    <li>Preguntas frecuentes</li>
                    <li>Opiniones de Clientes</li>
                    <li>Ultimos Comentarios</li>
                </ul>
            </div>

            <div id="quienessomos">
            <h5>QUIENES SOMOS</h5>
                <ul>
                    <li>Quienes Somos</li>
                    <li>Nuestra tienda</li>
                    <li>Condiciones de compra</li>
                    <li>Devoluciones</li>
                    <li>Garamtias</li>
                    <li>Fabricantes</li>
                    <li>Afiliados</li>
                </ul>
            </div>

            <div id="contacto">
            <h5>CONTACTAR</h5>
                <ul>
                    <li>Centro de soporte</li>
                    <li>Aviso Legal</li>
                    <li>Privacidad</li>
                    <li>Politica de cookies</li>
                    <li>Trabaja con nosotros</li>
                </ul>
             </div>

            <div id="mandaofertas">
                
            </div>
        <div>









</div>














<?php

HTML::CerrarHtml();
?>