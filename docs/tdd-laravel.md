# Desarrollo TDD con Laravel

Paquete PHPUnit.

## Ejecución de los tests

```bash
php artisan test
```

## Base de datos para tests

Se crea una base de datos propia para tests (por ejemplo, products_test), con el mismo usuario y contraseña que la base de datos real.

La base de datos se configura en el archivo **phpunit.xml**:

```xml
<env name="DB_CONNECTION" value="mysql"/>
<env name="DB_DATABASE" value="products_test"/>
```

## Archivos de tests

- Carpeta base: **tests**.
- Test unitarios: **tests/Unit**.
- Test funcionales: **tests/Feature**.

Creación de un test de funcionalidad, manteniendo la estructura de carpetas del método que se quiere probar:

```bash
# Crear test de integración
php artisan make:test Http/Controllers/ProductController/IndexTest

# Crear test de unitario
php artisan make:test UserTest --unit
```

Las clases de test que utilicen la base de datos deberán incluir el trait `use RefreshDatabase;`.

Los tests que utilicen funcionalidades de LAravel deben extender de `use Tests\TestCase;`, el resto de `use PHPUnit\Framework\TestCase;`.

```php
<?php
namespace Tests\Feature\Http\Controllers\ProductController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Product;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_list()
    {
        $product = Product::factory()->create();

        $this->get(route('products.index'))
            ->assertStatus(200)
            ->assertSee($product->name);
    }
}
```

## Creación de los archivos de la entidad para el CRUD

Creación del modelo, migración, factory y controlador:

```bash
php artisan make:model Product -mfc
```

## Crear la ruta

```php
Route::resource('products', ProductController::class)->names('products');
```

```bash
php artisan route:list
```

## Crear método del controlador

Cuando la vista está vacía la llamada a assertSee da verdadero y el test no falla.


## Pasos generales

1. Crear el test para una funcionalidad concreta (método de un controlador).
2. Probar y corregir los fallos.
3. Refactorizar.
4. Hacer lo mismo para todas las funcionalidades. Sólo trabajamos con el editor, la consola y la base de datos de tests.
5. Ejecutar las migraciones en la base de datos real.
6. Trabajar con las vistas y probar visualmente en el navegador y en la consola (ejecutar y completar los tests).

## Tests de aceptación

```bash
composer require --dev laravel/dusk
php artisan dusk:install
```

Se habrá creado la carpeta tests/Browser.

Ejecutar los tests:

```bash
php artisan dusk
```

Google Chrome debe estar actualizado y la variable APP_URL en el archivo .env debe tener un valor correcto.


Crear test:

```bash
php artisan dusk:make PageTest
```

Si en el archivo DuskTestCase se comenta la línea `'--headless',` se abrirá el navegador al ejecutar los tests.

Si hay errores con la versión del driver de Chrome al hacer dusk:install, actuaizar Chrome (Ayuda - Información de Google Chrome).
