# aheadTechnology
ahead

## Requerimientos
<p>PHP: Tener instalada una versión de PHP 7.2.5 o superior <br>
Composer: Tener Composer instalado para instalar los packages necesarios del proyecto<br>
Mysql: Tener instalado el Mysql 8 y algún administrador visual como por ejemplo Mysql Workbench</p>

## [Symfony CLI](https://symfony.com/download)
<p>Instalar el binario de Symfony para poder usar sus herramientas y correr el proyecto localmente (stand Alone Symfony)
</p>

#### Opcional
<p>Symfony nos permite comprobar si tu PC tiene todos los requirements<br></p>
<code>symfony check:requirements</code>



## Probar proyecto
<p>Nos colocaremos en el directorio donde este localizado el proyecto</p>
<code>cd aheadTechnology</code><br>
<p>Ahora lanzaremos la query para que composer se encarge de dejar listo el proyecto con todas sus dependencias</p>
<code>composer install</code><br>
<p>Editaremos el fichero .env para configurar nuestra BBDD tiene que parecerse a algo así:</p>
<code>DATABASE_URL=mysql://usuario:contraseña@127.0.0.1:3306/nombreBasedeDatos</code><br>
<p>Finalmente usaremos el web server que nos ofrece symfony para correr el proyecto localmente</p>
<code>symfony server:start</code><br>
