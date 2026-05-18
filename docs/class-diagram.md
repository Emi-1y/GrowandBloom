# Diagrama de Clases Actualizado - Grow and Bloom

> **Fecha:** 2026-05-18  
> **Autor:** Emily Cardona Castañeda  
> **Basado en:** Modelos en `app/Models/` tras refactorización

---

## 1. Diagrama PlantUML

Ver archivo: [`class-diagram.puml`](./class-diagram.puml)

---

## 2. Resumen de Clases

### Plant
| Atributo | Tipo | Descripción |
|----------|------|-------------|
| id | int | PK |
| name | string | Nombre de la planta |
| size | string | Tamaño o presentación |
| brand | string | Marca |
| price | int | Precio |
| exclusive | bool | ¿Es exclusiva? |
| image | ?string | Imagen |
| description | ?string | Descripción |
| color | string | Color o variedad |
| discount | int | % descuento |
| active | bool | ¿Activa? |
| stock | int | Cantidad en stock |
| category_id | int | FK a Category |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relaciones:**
- `belongsTo` → **Category**
- `hasMany` → **Item**

---

### Service
| Atributo | Tipo | Descripción |
|----------|------|-------------|
| id | int | PK |
| name | string | Nombre del servicio |
| employee | ?string | Empleado asignado |
| description | ?string | Descripción |
| price | int | Precio |
| duration | ?string | Duración estimada |
| active | bool | ¿Activo? |
| features | string {JSON} | Características |
| image | ?string | Imagen |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relaciones:**
- `hasMany` → **Item**

---

### Item
| Atributo | Tipo | Descripción |
|----------|------|-------------|
| id | int | PK |
| quantity | int | Cantidad |
| unit_price | int | Precio unitario (snapshot) |
| order_id | int | FK a Order |
| plant_id | ?int | FK a Plant (nullable) |
| service_id | ?int | FK a Service (nullable) |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relaciones:**
- `belongsTo` → **Order**
- `belongsTo` → **Plant** (nullable)
- `belongsTo` → **Service** (nullable)

**Lógica:**
- `isService()` devuelve `true` si `service_id !== null`
- `calculateSubTotal()` = `quantity * unit_price`

---

### Order
| Atributo | Tipo | Descripción |
|----------|------|-------------|
| id | int | PK |
| total | int | Total de la orden |
| payment_method | string | Método de pago |
| status | string | `pending`, `completed`, `cancelled` |
| payment_status | string | `pending`, `paid`, `failed` |
| user_id | int | FK a User |
| created_at | timestamp | |
| updated_at | timestamp | |

**Constantes:**
- `STATUS_PENDING = 'pending'`
- `STATUS_COMPLETED = 'completed'`
- `STATUS_CANCELLED = 'cancelled'`
- `PAYMENT_PENDING = 'pending'`
- `PAYMENT_PAID = 'paid'`
- `PAYMENT_FAILED = 'failed'`

**Relaciones:**
- `belongsTo` → **User**
- `hasMany` → **Item**

---

### User
| Atributo | Tipo | Descripción |
|----------|------|-------------|
| id | int | PK |
| name | string | Nombre |
| email | string | Correo |
| email_verified_at | timestamp | Verificación email |
| password | string | Contraseña (hash) |
| role | string | `admin` o `user` |
| phone | ?string | Teléfono |
| address | ?string | Dirección |
| city | ?string | Ciudad |
| postal_code | ?string | Código postal |
| remember_token | string | Token remember me |
| created_at | timestamp | |
| updated_at | timestamp | |

**Constantes:**
- `ROLE_ADMIN = 'admin'`
- `ROLE_USER = 'user'`

**Relaciones:**
- `hasMany` → **Order**

---

### Category
| Atributo | Tipo | Descripción |
|----------|------|-------------|
| id | int | PK |
| name | string | Nombre |
| description | ?string | Descripción |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relaciones:**
- `hasMany` → **Plant**

---

## 3. Diagrama de Relaciones (Texto)

```
┌─────────────┐         ┌─────────────┐
│   Category  │1────*   │    Plant    │
│             │─────────│             │
└─────────────┘         └──────┬──────┘
                               │
                               │ belongsTo
                               │
                         ┌─────┴─────┐
                         │   Item    │
                         │(plant_id) │
                         └─────┬─────┘
                               │
                    ┌──────────┼──────────┐
                    │          │          │
                    │    belongsTo        │
                    │          │          │
               ┌────┴────┐     │    ┌────┴────┐
               │  Order  │1───*    │ Service │
               │         │         │         │
               └────┬────┘         └────┬────┘
                    │                    │
                    │ belongsTo          │
                    │                    │
               ┌────┴────┐               │
               │   User  │               │
               │         │               │
               └─────────┘               │
                                        │
                                   ┌────┴────┐
                                   │   Item  │
                                   │(service)│
                                   └─────────┘
```

---

## 4. Notas Importantes

1. **Payment no es una clase independiente.** Sus atributos (`payment_method`, `payment_status`) viven dentro de **Order**.
2. **Review fue eliminado.** No estaba en el diagrama original del proyecto.
3. **Plant** reemplazó a **Product** para alinearse con el dominio del vivero.
4. **Item** usa `plant_id` y `service_id` como claves foráneas mutuamente excluyentes. `isService()` determina el tipo.
