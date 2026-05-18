<?php

// Author: Emily Cardona Castañeda

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ITEM ATTRIBUTES
 * $this->attributes['id'] - int - contains the item primary key (id)
 * $this->attributes['quantity'] - int - contains the item quantity
 * $this->attributes['unit_price'] - int - contains the item unit price at time of purchase
 * $this->attributes['order_id'] - int - contains the related order id
 * $this->attributes['plant_id'] - int|null - contains the related plant id
 * $this->attributes['service_id'] - int|null - contains the related service id
 * $this->attributes['created_at'] - timestamp - contains item creation date
 * $this->attributes['updated_at'] - timestamp - contains item update date
 * $this->order - Order - contains the associated order
 * $this->plant - Plant|null - contains the associated plant
 * $this->service - Service|null - contains the associated service
 */
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'unit_price',
        'order_id',
        'plant_id',
        'service_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getUnitPrice(): int
    {
        return $this->attributes['unit_price'];
    }

    public function setUnitPrice(int $unitPrice): void
    {
        $this->attributes['unit_price'] = $unitPrice;
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getPlantId(): ?int
    {
        return isset($this->attributes['plant_id']) ? (int) $this->attributes['plant_id'] : null;
    }

    public function setPlantId(?int $plantId): void
    {
        $this->attributes['plant_id'] = $plantId;
    }

    public function getServiceId(): ?int
    {
        return isset($this->attributes['service_id']) ? (int) $this->attributes['service_id'] : null;
    }

    public function setServiceId(?int $serviceId): void
    {
        $this->attributes['service_id'] = $serviceId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }

    public function getPlant(): ?Plant
    {
        return $this->plant;
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function isService(): bool
    {
        return $this->getServiceId() !== null;
    }

    public function getDisplayName(): string
    {
        if ($this->isService() && $this->getService()) {
            return $this->getService()->getName();
        }

        if ($this->getPlant()) {
            return $this->getPlant()->getName();
        }

        return __('order.unknown_item');
    }

    public function calculateSubTotal(): int
    {
        return $this->getQuantity() * $this->getUnitPrice();
    }

    public function getFormattedUnitPrice(): string
    {
        return number_format($this->getUnitPrice(), 0, ',', '.').' '.__('plant.currency');
    }

    public function getFormattedSubtotal(): string
    {
        return number_format($this->calculateSubTotal(), 0, ',', '.').' '.__('plant.currency');
    }
}
