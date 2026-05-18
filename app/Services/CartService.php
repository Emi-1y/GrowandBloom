<?php

// Author: Emily Cardona Castañeda

namespace App\Services;

use App\Models\Item;
use App\Models\Plant;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_KEY = 'shopping_cart';

    private const CART_SERVICES_KEY = 'shopping_cart_services';

    // ── PLANTS ───────────────────────────────────────────────────────────────

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function addPlant(Plant $plant, int $requestedQuantity): void
    {
        $cart = $this->getCart();
        $plantId = $plant->getId();
        $current = (int) ($cart[$plantId] ?? 0);
        $newQuantity = min($plant->getStock(), $current + max(1, $requestedQuantity));

        if ($newQuantity > 0) {
            $cart[$plantId] = $newQuantity;
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function updatePlantQuantity(Plant $plant, int $quantity): void
    {
        $cart = $this->getCart();
        $plantId = $plant->getId();

        if (! array_key_exists($plantId, $cart)) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$plantId]);
        } else {
            $cart[$plantId] = min($plant->getStock(), $quantity);
        }

        Session::put(self::CART_KEY, $cart);
    }

    public function removePlant(int $plantId): void
    {
        $cart = $this->getCart();

        if (array_key_exists($plantId, $cart)) {
            unset($cart[$plantId]);
            Session::put(self::CART_KEY, $cart);
        }
    }

    // ── SERVICIOS ────────────────────────────────────────────────────────────

    public function getCartServices(): array
    {
        return Session::get(self::CART_SERVICES_KEY, []);
    }

    public function addService(Service $service): void
    {
        $cartServices = $this->getCartServices();
        $serviceId = $service->getId();

        if (! isset($cartServices[$serviceId])) {
            $cartServices[$serviceId] = 1;
            Session::put(self::CART_SERVICES_KEY, $cartServices);
        }
    }

    public function removeService(int $serviceId): void
    {
        $cartServices = $this->getCartServices();

        if (array_key_exists($serviceId, $cartServices)) {
            unset($cartServices[$serviceId]);
            Session::put(self::CART_SERVICES_KEY, $cartServices);
        }
    }

    // ── COMBINADO ────────────────────────────────────────────────────────────

    public function clear(): void
    {
        Session::forget(self::CART_KEY);
        Session::forget(self::CART_SERVICES_KEY);
    }

    public function buildCartItems(): Collection
    {
        $plantItems = $this->buildPlantItems();
        $serviceItems = $this->buildServiceItems();

        return $plantItems->merge($serviceItems)->values();
    }

    private function buildPlantItems(): Collection
    {
        $cart = $this->getCart();

        if (count($cart) === 0) {
            return collect();
        }

        $plants = Plant::whereIn('id', array_keys($cart))
            ->where('active', true)
            ->get()
            ->keyBy(fn (Plant $p) => $p->getId());

        return collect($cart)
            ->filter(fn (int $qty, int $pid) => $qty > 0 && isset($plants[$pid]))
            ->map(function (int $qty, int $pid) use ($plants) {
                $plant = $plants[$pid];

                $item = new Item;
                $item->setPlantId($plant->getId());
                $item->setServiceId(null);
                $item->setQuantity($qty);
                $item->setUnitPrice($plant->getPrice());
                $item->setRelation('plant', $plant);
                $item->setRelation('service', null);

                return $item;
            })
            ->values();
    }

    private function buildServiceItems(): Collection
    {
        $cartServices = $this->getCartServices();

        if (count($cartServices) === 0) {
            return collect();
        }

        $services = Service::whereIn('id', array_keys($cartServices))
            ->where('active', true)
            ->get()
            ->keyBy(fn (Service $s) => $s->getId());

        return collect($cartServices)
            ->filter(fn (int $qty, int $sid) => isset($services[$sid]))
            ->map(function (int $qty, int $sid) use ($services) {
                $service = $services[$sid];

                $item = new Item;
                $item->setPlantId(null);
                $item->setServiceId($service->getId());
                $item->setQuantity(1);
                $item->setUnitPrice($service->getPrice());
                $item->setRelation('service', $service);
                $item->setRelation('plant', null);

                return $item;
            })
            ->values();
    }
}
