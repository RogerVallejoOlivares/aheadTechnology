# aheadTechnology
Prueba técnica
Aplicación web que solicita los datos bancarios a los clientes y los almacena de forma que posteriormente se pueda enviar una factura a dichos clientes.
Framework utilizado: Symfony 5.1
BBDD: Mysql 8
Lenguaje de programación: PHP 7.3


---

## Requisitos
 [PHP](https://www.php.net/downloads.php)<p> Tener instalada una versión de PHP 7.2.5 o superior <br></p>
 [Composer](https://getcomposer.org/download/)<p> Tener Composer instalado para instalar los packages necesarios del proyecto<br></p>
 [Mysql](https://dev.mysql.com/doc/refman/8.0/en/installing.html) [Mysql Workbench](https://dev.mysql.com/downloads/workbench/)<p> Tener instalado el Mysql 8 y algún administrador visual como por ejemplo Mysql Workbench</p>
 [Symfony](https://symfony.com/doc/current/setup.html) <p>Usaremos la versión 5.1</p>

---

## [Symfony CLI](https://symfony.com/download)
<p>Instalar el binario de Symfony para poder usar sus herramientas y correr el proyecto localmente (stand Alone Symfony)
</p>

---

#### Opcional
<p>Symfony nos permite comprobar si tu PC tiene todos los requirements<br></p>
<code>symfony check:requirements</code>

---

## Probar proyecto
<p>Nos colocaremos en el directorio donde este localizado el proyecto
<code>cd aheadTechnology</code><br></p>
<p>Ahora lanzaremos la query para que composer se encarge de dejar listo el proyecto con todas sus dependencias
<code>composer install</code><br></p>
<p>Editaremos el fichero .env para configurar nuestra BBDD tiene que parecerse a algo así:
<code>DATABASE_URL=mysql://usuario:contraseña@127.0.0.1:3306/nombreBasedeDatos</code><br></p>
<p>Finalmente usaremos el web server que nos ofrece symfony para correr el proyecto localmente
<code>symfony server:start</code><br></p>

---

### Recordad lanzar las dos migraciones
<p> el proyecto tiene dos migraciones, una con la creación de las tablas y la segunda con la inserción de 35 registros a la base de datos</p>
<code>php bin/console doctrine:migrations:execute --up 'DoctrineMigrations\[Nombre de la version]'
</code>

