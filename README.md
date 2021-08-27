# API REST CRUD NOTAS
## Desarrollado en PHP

A continuación se describe el funcionamiento del api rest para cada una de las operaciones del CRUD

Para el envío de datos (método POST)

[http://apirestcrudnotas.ncrdesarrollo.com/notas](http://apirestcrudnotas.ncrdesarrollo.com/notas)

se envían los datos en formato json de la siguiente manera

```json
{
        "titulo": "titulo de la nota",
        "nota": "texto de la nota",
		"imagen": "se debe enviar en formato base64"
 }
```

Para obtener la lista de datos (método GET)

[http://apirestcrudnotas.ncrdesarrollo.com/notas](http://apirestcrudnotas.ncrdesarrollo.com/notas)              (se obtiene todos los datos)

[http://apirestcrudnotas.ncrdesarrollo.com/notas?page=1](http://apirestcrudnotas.ncrdesarrollo.com/notas?page=1)              (se obtiene todos los datos con paginación de 100 en 100)


Para ver el detalle del registro (método GET) le pasamos el id del registro por parámetro en la url

[http://apirestcrudnotas.ncrdesarrollo.com/notas?id=](http://apirestcrudnotas.ncrdesarrollo.com/notas?id=1)


Para editar los datos (método PUT)

[http://apirestcrudnotas.ncrdesarrollo.com/notas](http://apirestcrudnotas.ncrdesarrollo.com/notas)

se envían los datos en formato json de la siguiente manera

```json
{
	"id": "1",        
	"titulo": "titulo de la nota",
	"nota": "texto de la nota",
	"imagen": "se debe enviar en formato base64"
 }
```

Para eliminar los datos (método DELETE)

[http://apirestcrudnotas.ncrdesarrollo.com/notas](http://apirestcrudnotas.ncrdesarrollo.com/notas)

se envían los datos en formato json de la siguiente manera

```json
{
	"id": "1"
 }
```

También se puede enviar por el header
