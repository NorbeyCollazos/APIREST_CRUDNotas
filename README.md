#API REST CRUD NOTAS
##Desarrollado en PHP

A continuación se describe el funcionamiento del api rest para cada una de las operaciones del CRUD

Para el envío de datos (método POST)

[http://192.168.3.2/apirestcrudnotas/notas](http://192.168.3.2/apirestcrudnotas/notas)

se envían los datos en formato json de la siguiente manera

```json
{
        "titulo": "titulo de la nota",
        "nota": "texto de la nota"
 }
```

Para obtener la lista de datos (método GET)

[http://192.168.3.2/apirestcrudnotas/notas](http://192.168.3.2/apirestcrudnotas/notas)              (se obtiene todos los datos)

[http://192.168.3.2/apirestcrudnotas/notas?page=1](http://192.168.3.2/apirestcrudnotas/notas?page=1)              (se obtiene todos los datos con paginación de 100 en 100)

Para editar los datos (método PUT)

[http://192.168.3.2/apirestcrudnotas/notas](http://192.168.3.2/apirestcrudnotas/notas)

se envían los datos en formato json de la siguiente manera

```json
{
	"id": "1",        
	"titulo": "titulo de la nota",
	"nota": "texto de la nota"
 }
```

Para eliminar los datos (método DELETE)

[http://192.168.3.2/apirestcrudnotas/notas](http://192.168.3.2/apirestcrudnotas/notas)

se envían los datos en formato json de la siguiente manera

```json
{
	"id": "1"
 }
```

También se puede enviar por el header
