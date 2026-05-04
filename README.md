### Grow and Bloom — Vivero & Jardinería

## Stack tecnológico

| Capa | Tecnología |
|------|-----------|
| Backend | Laravel 12 (PHP 8.2+) |
| Frontend | Blade + Bootstrap 5.3 |
| Estilos | CSS propio (`public/css/app.css`) |
| Tipografía | Cormorant Garamond · DM Sans |
| Base de datos | MySQL |
| Testing | PHPUnit + SQLite en memoria |

### Pasos

**1. Clonar o descomprimir el proyecto**
```bash
cd grow_and_bloom
```

**2. Instalar dependencias PHP**
```bash
composer install
```

**3. Copiar el archivo de entorno**
```bash
cp .env.example .env
```

**4. Generar la clave de la aplicación**
```bash
php artisan key:generate
```

**5. Configurar la base de datos en `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grow_and_bloom
DB_USERNAME=root
DB_PASSWORD=
```

> Crear la base de datos antes de continuar:
> ```sql
> CREATE DATABASE grow_and_bloom;
> ```

**6. Ejecutar migraciones y seeders**
```bash
php artisan migrate --seed
```

**7. Levantar el servidor de desarrollo**
```bash
php artisan serve
```

**8. Abrir en el navegador**
```
http://127.0.0.1:8000
```