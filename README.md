## Mapeo Relacional:

### Donantes y Donaciones:
Unidireccional. Cada donante puede realizar varias donaciones, pero una donación está vinculada a un solo donante.
Por lo tanto, en la tabla de Donaciones, existe clave foránea que hace referencia al ID del donante que realizó esa donación.

### Donantes y Contacto:
Autoreferencial. Cada donante tiene su propio contacto.
En la tabla de Donantes, podrías tener un campo que almacene el ID del contacto asociado a ese donante.

### Donaciones y Proyectos:
Multidireccional. Cada donación se dirige a un proyecto, y un proyecto puede recibir varias donaciones.

En la tabla de Donaciones, tendrías una clave foránea que hace referencia al ID del proyecto al que se dirige esa donación.
En resumen:

La relación entre Donaciones y Proyectos es multidireccional.