# Tabla de Consistencia - Diagrama de Clases vs Implementacion

> **Proyecto:** Grow and Bloom
> **Autor:** Emily Cardona Castaneda
> **Fecha:** 2026-05-18
> **Objetivo:** Comparar elemento por elemento el diagrama de clases (Entregable 2) con el codigo fuente implementado en Laravel.

---

## 1. Resumen Ejecutivo

| Clase (Diagrama) | Clase (Codigo) | Estado General |
|------------------|----------------|----------------|
| User | User | :white_check_mark: Consistente |
| Order | Order | :white_check_mark: Consistente |
| Item | Item | :white_check_mark: Consistente |
| Plant | Plant | :white_check_mark: Consistente |
| Service | Service | :white_check_mark: Consistente |
| Category | Category | :white_check_mark: Consistente |

**Leyenda:**
- :white_check_mark: `Cumple` - El elemento existe en ambos y coincide.
- :warning: `Extra justificado` - El elemento existe en el codigo (atributo tecnico de Laravel) y se documenta como tal.

> **Cambios respecto al Entregable 1:**
> - Se elimino la clase `Payment` del diagrama. Sus atributos (`payment_method`, `payment_status`) se trasladaron a `Order`.
> - Se renombro `Product` -> `Plant` en codigo para alinear con el dominio del negocio (tienda de plantas).
> - Se elimino el modelo `Review` del codigo (no era central al flujo de e-commerce; se mantuvo el limite de 6 clases en el diagrama).
> - Se incorporo `Category` al diagrama (ya existia en codigo).
> - `Order.status` ahora representa SOLO el workflow (pending/completed/cancelled). El estado del pago vive en `Order.payment_status` (pending/paid/failed).
> - `Item.price` se renombro a `Item.unit_price`. `Item.item_type` se elimino (se infiere de la FK poblada `plant_id` o `service_id`). `Item.subtotal` es metodo calculado, no columna.

---

## 2. User

**Estado:** :white_check_mark: **Consistente**

| Elemento | Tipo (Diagrama) | Tipo (Codigo) | Observacion |
|----------|-----------------|---------------|-------------|
| `id` | int | int | :white_check_mark: |
| `name` | string | string | :white_check_mark: |
| `email` | string | string | :white_check_mark: |
| `password` | string | string | :white_check_mark: Hasheado |
| `phone` | string? | ?string | :white_check_mark: |
| `address` | string? | ?string | :white_check_mark: |
| `city` | string? | ?string | :white_check_mark: |
| `postal_code` | string? | ?string | :white_check_mark: |
| `role` | string | string | :white_check_mark: 'admin' \| 'user' |
| `orders[]` | Order[] | Order[] | :white_check_mark: hasMany |
| `email_verified_at` | - | timestamp | :warning: Extra de Laravel Authenticatable |
| `remember_token` | - | string | :warning: Extra de Laravel Authenticatable |
| CRUD / getters / setters | :white_check_mark: | :white_check_mark: | Heredado de Eloquent + accessors propios |

---

## 3. Order

**Estado:** :white_check_mark: **Consistente**

| Elemento | Tipo (Diagrama) | Tipo (Codigo) | Observacion |
|----------|-----------------|---------------|-------------|
| `id` | int | int | :white_check_mark: |
| `total` | int | int | :white_check_mark: |
| `status` | string | string | :white_check_mark: pending \| completed \| cancelled |
| `paymentStatus` | string | string (payment_status) | :white_check_mark: pending \| paid \| failed |
| `paymentMethod` | string | string (payment_method) | :white_check_mark: cash \| card \| transfer \| nequi |
| `created_at` | timestamp | timestamp | :white_check_mark: Reemplaza a "date" |
| `user_id` | - | int FK | :warning: Llave foranea de la relacion |
| `items[]` | Item[] | Item[] | :white_check_mark: hasMany |
| `user` | User | User | :white_check_mark: belongsTo |
| `placeOrder()` | metodo | metodo | :white_check_mark: status='pending', payment_status='pending' |
| `cancelOrder()` | metodo | metodo | :white_check_mark: status='cancelled' |
| `pay()` | metodo | metodo | :white_check_mark: payment_status='paid' |
| `calculateTotal()` | metodo | metodo | :white_check_mark: Suma item.calculateSubTotal() |
| CRUD / getters / setters | :white_check_mark: | :white_check_mark: | - |

---

## 4. Item

**Estado:** :white_check_mark: **Consistente**

| Elemento | Tipo (Diagrama) | Tipo (Codigo) | Observacion |
|----------|-----------------|---------------|-------------|
| `id` | int | int | :white_check_mark: |
| `quantity` | int | int | :white_check_mark: |
| `unitPrice` | int | int (unit_price) | :white_check_mark: |
| `order_id` | - | int FK | :warning: FK de la relacion |
| `plant_id` | - | int FK nullable | :warning: FK de la relacion polimorfica |
| `service_id` | - | int FK nullable | :warning: FK de la relacion polimorfica |
| `order` | Order | Order | :white_check_mark: belongsTo |
| `plant` | Plant? | Plant? | :white_check_mark: belongsTo (nullable) |
| `service` | Service? | Service? | :white_check_mark: belongsTo (nullable) |
| `calculateSubTotal()` | metodo | metodo | :white_check_mark: quantity * unit_price |
| `getDisplayName()` | metodo | metodo | :white_check_mark: Resuelve nombre desde Plant o Service |
| CRUD / getters / setters | :white_check_mark: | :white_check_mark: | - |

---

## 5. Plant

**Estado:** :white_check_mark: **Consistente**

| Elemento | Tipo (Diagrama) | Tipo (Codigo) | Observacion |
|----------|-----------------|---------------|-------------|
| `id` | int | int | :white_check_mark: |
| `name` | string | string | :white_check_mark: |
| `size` | string | string | :white_check_mark: |
| `brand` | string | string | :white_check_mark: |
| `price` | int | int | :white_check_mark: |
| `exclusive` | bool | bool | :white_check_mark: |
| `image` | string? | ?string | :white_check_mark: |
| `description` | string? | ?string | :white_check_mark: |
| `color` | string | string | :white_check_mark: |
| `discount` | int | int | :white_check_mark: |
| `active` | bool | bool | :white_check_mark: |
| `stock` | int | int | :white_check_mark: |
| `category_id` | - | int FK | :warning: FK de la relacion |
| `category` | Category | Category | :white_check_mark: belongsTo |
| `items[]` | Item[] | Item[] | :white_check_mark: hasMany |
| CRUD / getters / setters | :white_check_mark: | :white_check_mark: | - |

---

## 6. Service

**Estado:** :white_check_mark: **Consistente**

| Elemento | Tipo (Diagrama) | Tipo (Codigo) | Observacion |
|----------|-----------------|---------------|-------------|
| `id` | int | int | :white_check_mark: |
| `name` | string | string | :white_check_mark: |
| `employee` | string? | ?string | :white_check_mark: |
| `description` | string? | ?string | :white_check_mark: |
| `price` | int | int | :white_check_mark: |
| `duration` | string? | ?string | :white_check_mark: |
| `active` | bool | bool | :white_check_mark: |
| `features` | array | array (JSON) | :white_check_mark: |
| `image` | string | string | :white_check_mark: |
| `items[]` | Item[] | Item[] | :white_check_mark: hasMany |
| `getFormattedPrice()` | metodo | metodo | :white_check_mark: |
| CRUD / getters / setters | :white_check_mark: | :white_check_mark: | - |

---

## 7. Category

**Estado:** :white_check_mark: **Consistente**

| Elemento | Tipo (Diagrama) | Tipo (Codigo) | Observacion |
|----------|-----------------|---------------|-------------|
| `id` | int | int | :white_check_mark: |
| `name` | string | string | :white_check_mark: |
| `description` | string | string | :white_check_mark: |
| `plants[]` | Plant[] | Plant[] | :white_check_mark: hasMany |
| CRUD / getters / setters | :white_check_mark: | :white_check_mark: | - |

---

## 8. Conclusiones

1. **Diagrama y codigo en perfecta consistencia.** Las 6 clases del diagrama del Entregable 2 coinciden uno-a-uno con los modelos en `app/Models/`. No hay clases extra en codigo ni clases del diagrama omitidas.

2. **Eliminacion de Payment justificada.** Payment era una entidad redundante: sus unicos atributos esenciales (`payment_method`, `payment_status`) son metadatos de la transaccion, no entidades por derecho propio. Trasladarlos a Order simplifica el modelo sin perder informacion.

3. **Renombrar Product->Plant alinea el dominio.** El negocio Grow and Bloom es una tienda de plantas; mantener "Product" generico contradice el lenguaje ubicuo (Domain-Driven Design).

4. **Separacion `status` / `paymentStatus`.** El estado del workflow (pending/completed/cancelled) y el estado del pago (pending/paid/failed) son conceptos distintos. Mezclarlos en un solo campo (como hacia el codigo original con valores como 'paid' y 'shipped' en `status`) era un anti-patron.

5. **`subtotal` como metodo calculado.** Evita la posibilidad de inconsistencia entre `quantity * unit_price` y un valor persistido obsoleto.

6. **`item_type` eliminado.** La distincion plant vs service ahora se infiere de cual FK esta poblada (`plant_id` o `service_id`), eliminando el riesgo de desincronizacion.

7. **Sin Review.** La funcionalidad de resenas se removio para cumplir el limite de 6 clases. Si se quisiera reincorporar como funcionalidad interesante, se podria implementar sin necesidad de un modelo dedicado (por ejemplo, integrado en otro flujo).
