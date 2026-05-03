<?php

// Author: Emily Cardona Castañeda

namespace App\Services;

use App\Models\Item;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_KEY          = 'shopping_cart';
    private const CART_SERVICES_KEY = 'shopping_cart_services';

    // ── PRODUCTOS ────────────────────────────────────────────────────────────

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function addProduct(Product $product, int $requestedQuantity): void
    {
        $cart        = $this->getCart();
        $productId   = $product->getId();
        $current     = (int) ($cart[$productId] ?? 0);
        $newQuantity = min($product->getStock(), $current + max(1, $requestedQuantity));

        if ($newQuantity > 0) {
            $cart[$productId] = $newQuantity;
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function updateProductQuantity(Product $product, int $quantity): void
    {
        $cart      = $this->getCart();
        $productId = $product->getId();

        if (! array_key_exists($productId, $cart)) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = min($product->getStock(), $quantity);
        }

        Session::put(self::CART_KEY, $cart);
    }

    public function removeProduct(int $productId): void
    {
        $cart = $this->getCart();

        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
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
        $serviceId    = $service->getId();

        // Solo se permite un servicio del mismo tipo
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
        $productItems = $this->buildProductItems();
        $serviceItems = $this->buildServiceItems();

        return $productItems->merge($serviceItems)->values();
    }

    private function buildProductItems(): Collection
    {
        $cart = $this->getCart();

        if (count($cart) === 0) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->where('active', true)
            ->get()
            ->keyBy(fn (Product $p) => $p->getId());

        return collect($cart)
            ->filter(fn (int $qty, int $pid) => $qty > 0 && isset($products[$pid]))
            ->map(function (int $qty, int $pid) use ($products) {
                $product = $products[$pid];

                $item = new Item;
                $item->setProductId($product->getId());
                $item->setServiceId(null);
                $item->setItemType('product');
                $item->setQuantity($qty);
                $item->setPrice($product->getPrice());
                $item->setRelation('product', $product);
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
                $item->setProductId(null);
                $item->setServiceId($service->getId());
                $item->setItemType('service');
                $item->setQuantity(1);
                $item->setPrice($service->getPrice());
                $item->setRelation('service', $service);
                $item->setRelation('product', null);

                return $item;
            })
            ->values();
    }
}
