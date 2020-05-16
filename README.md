# SIBW

Aqui se colgarán las práctiacs de la asignatura de SIBW para mantener un histórico y tener un backup
___

## P1
**FESTIVALEROS**
La página web a realizar se basará en una web de imformación sobre festivales. 
Los tres archivos html se corresponden con tres páginas del sitio web a desarrollar.

> **PORTADA.HTML** Es la portada del sitio web y, junto al menu y la barra lateral, incluye una cuadrícula en la que se añaden los eventos.
>**EVENTO.HTML** Es la vista general de un evento en particular. Inlcuye informacion sobre el evento y fotos, junto con el logo y la barra lateral anteriormente mencionadas.
> **IMPRIMIR.HTML** Es la vista general de un evento, al igual que la página anterior, pero solamente con la información del evento y las fotografías, es decir, no incluye el menú ni la barra lateral.

---

## P2
Añadida la opción de dejar comentarios en el `html` de **evento**, mediante una pestaña desplegable implementada con `javascript`. Sin embargo esto no representa una funcionalidad real ya que lo único que se realiza es incluir el comentario en el `html` mediante `javascript`. 
Además, también mediante `javascript`, se realiza una censura mientras el usuario escribe el comentario para intercambiar ciertas palabras por un número equivalente a su longitud de asteríscos

> `Ej: censura -> *******`

---
## P3
Se comienza a implementar la web mediante plantillas mediante el uso de la tecnología **[twig]** y **php**.

Además se añade una base de datos para albergar toda la información de la web que se está implementando, cuya estructura en un primer momento se define en el archivo [mysql/tablas.txt](P3/mysql/tablas.txt).

La estructura de los archivos se reparte ahora de la siguiente manera:

* **./css:** Contiene las hojas de estilo del sitio web y del modo imprimir de los eventos.
* **./img:** Contiene las imágenes que se usan en el sitio.
* **./js:** Contiene los archivos con el código `javascript` de la web.
* **./mysql:** Contiene la definición y los primeros insert de la BD.
* **./plantillas:** Contiene los archivos html realizados mediante las herramientas que proporciona **[twig]**
* **./ :** Contiene los **php** que controlan el funcionamiento del sitio web. Tanto los que generan el html mediante **[twig]** como los que implementan ciertas funciones (conexiones a MySQL).

---
## P4
Implementación de todas las funcionalidades necesarias para no tener que recurrir a la inclusión de contenido mediante la consola de MySQL o phpMyAdmin.
El sitio ahora presenta todos los formularios necesarios para incluir eventos, moderar comentairos (editar y eliminar), además de posibilitar el registro y el inicio de sesión a los usuarios.

La web ahora presenta los siguientes tipos de usuarios:
* **Anónimos:** Pueden registrarse e iniciar sesión
* **Usuarios:** Identificados en el sitio. Pueden dejar comentarios y cambiar su información desde el panel de configuración.
* **Moderadores:** Todas las opciones de los usuarios. Además, pueden modificar y eliminar comentarios en los eventos. También tienen acceso desde el panel de configuración a una lista de todos los comentarios ordenados por eventos, desde donde pueden editar o eliminar los mismos.
* **Gestores:** Todas las opciones de los usuarios. Además, pueden incluir eventos y modificar los mismos, desde los propios eventos o a través de la pestaña correspondiente a ello en el panel de configuración. En los eventos pueden incluirse imágenes y etiquetas. 
* **Superusuarios:** Todas las opcioens del resto de usuarios (Usuarios, Moderadores y Gestores). Además, desde el panel de configuración puede acceder a un gestor de permisos para en cualquier momento convertir a un usuario en cualquiera de los tipos anteriormente mencionados

---
## P5
Se incluye el concepto de **publicar un evento**. Los eventos pueden estar **guardados** en el sistema **como "borrador"** sin estar publicados, por lo que únicamente serán visibles para los gestores y los superusuarios. Solo serán visibles para el resto de usuarios cuando se publiquen.

Además se añade una **barra de búsqueda** para buscar por nombre del evento o por su contenido. La búsqueda se realiza haciendo uso de **[ajax]**, realizando una petición al servidor. Éste ejecutará una búsqueda para todos los eventos en caso de que el usuario esté identificado como gestor o superusuario, y únicamente para los eventos publicados en caso contrario.

Debajo de la barra de búsqueda se despliegan los resultados, que son enlaces al evento en cuestión. Si se pulsa el botón de búsqueda se mostrará una lista similar a la portada del sitio pero únicamente con los resultados de la búsqueda.

[twig]: https://twig.symfony.com/
[ajax]: https://api.jquery.com/jQuery.ajax/