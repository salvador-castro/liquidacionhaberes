# liquidacionHaberes

Sistema de gestión de empleados y liquidación de haberes, desarrollado en **Laravel**.

Este proyecto permite administrar empleados, categorías, usuarios, roles, y preparar la base para futuros módulos de liquidaciones salariales.

El mismo esta en proceso de armado.

---

## 📄 Características principales

- Autenticación de usuarios.
- Gestor de empleados (ABM: alta, baja y modificación).
- Gestor de usuarios (solo para Super Admins y RRHH).
- Asignación de roles y permisos con **Spatie Laravel-Permission**.
- Validaciones de formularios (Front-End y Back-End).
- Panel de control (“Dashboard”) post login.

---

## 💡 Tecnologías utilizadas

- **Laravel** 10+
- **PHP** 8.2+
- **MySQL**
- **TailwindCSS** (estilos básicos)
- **Spatie/laravel-permission** para roles y permisos
- **Breeze** para autenticación rápida

---

## 🚀 Requisitos previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- MySQL o MariaDB

---

## 🔧 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/tuusuario/liquidacionHaberes.git
cd liquidacionHaberes
```

2. **Instalar dependencias**
```bash
composer install
npm install && npm run dev
```

3. **Crear archivo `.env`**
```bash
cp .env.example .env
```

4. **Configurar la base de datos**
Editar `.env` y completar:
```
DB_DATABASE=liquidacionhaberes
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

5. **Generar la clave de aplicación**
```bash
php artisan key:generate
```

6. **Migrar las tablas y sembrar datos iniciales**
```bash
php artisan migrate --seed
```

7. **Levantar el servidor de desarrollo**
```bash
php artisan serve
```

---

## 🧬 Roles disponibles

- **Super Admin**: acceso total al sistema.
- **RRHH**: gestión de empleados y usuarios, nivel inferior a Super Admin.
- **Empleado**: puede ver solo su información.

> **Nota:** Los roles se asignan automáticamente en el seeding inicial para pruebas.

---

## 🕹️ Comandos útiles

- Actualizar dependencias:
  ```bash
  composer update
  npm update
  ```
- Ejecutar migraciones:
  ```bash
  php artisan migrate:fresh --seed
  ```
- Limpiar caches:
  ```bash
  php artisan optimize:clear
  ```

---

## 📚 Estructura básica de carpetas

```
liquidacionHaberes/
├── app/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
├── public/
├── resources/
│   ├── views/
│   │   ├── empleados/
│   │   ├── layouts/
│   │   └── usuarios/
├── routes/
│   └── web.php
├── .env.example
└── README.md
```

---

## 📊 Mejoras a futuro

- Módulo completo de Liquidaciones de sueldos.
- Reportes en PDF y exportaciones.
- Filtros avanzados por categoría, fecha de ingreso, etc.
- Historial de movimientos de empleados.
- Mejoras de UI/UX.

---

## 📅 Licencia

Este proyecto es de uso libre para fines educativos o personales. Se encuentra bajo la licencia MIT. 

> **Disclaimer**: Aún en desarrollo. No utilizar en entornos de producción sin pruebas adicionales.

---

> Desarrollado con ❤️ por Salvador Castro.