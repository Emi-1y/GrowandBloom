<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\RemoveFromCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\Item;
use App\Models\Product;
use App\Models\Service;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService) {}

    public function index(): View
    {
        $cartItems = $this->cartService->buildCartItems();

        $viewData = [];
        $viewData['title'] = __('cart.title');
        $viewData['cartItems'] = $cartItems;
        $viewData['totalQuantity'] = $cartItems->sum(fn (Item $item) => $item->getQuantity());
        $viewData['totalAmount'] = $cartItems->sum(fn (Item $item) => $item->calculateSubTotal());

        return view('cart.index', ['viewData' => $viewData]);
    }

    public function add(AddToCartRequest $request): RedirectResponse
    {
        $itemType = $request->input('item_type', 'product');
        $quantity = (int) $request->validated('quantity', 1);

        if ($itemType === 'service') {
            $serviceId = (int) $request->input('service_id');
            $service = Service::where('active', true)->findOrFail($serviceId);
            $this->cartService->addService($service);

            return redirect()->route('cart.index')
                ->with('success', __('cart.service_added'));
        }

        $productId = (int) $request->validated('product_id', 0);
        $product = Product::where('active', true)->findOrFail($productId);
        $this->cartService->addProduct($product, $quantity);

        return redirect()->route('cart.index')
            ->with('success', __('cart.product_added'));
    }

    public function update(UpdateCartItemRequest $request, Product $product): RedirectResponse|JsonResponse
    {
        $activeProduct = Product::where('active', true)->findOrFail($product->getId());
        $quantity = (int) $request->validated('quantity');

        $this->cartService->updateProductQuantity($activeProduct, $quantity);

        if ($request->expectsJson()) {
            $cartItems = $this->cartService->buildCartItems();
            $cartItem = $cartItems->first(
                fn (Item $item) => $item->getItemType() === 'product'
                    && $item->getProductId() === $activeProduct->getId()
            );

            if ($cartItem === null) {
                return response()->json(['success' => false], 404);
            }

            return response()->json([
                'success' => true,
                'price' => $cartItem->getPrice(),
                'quantity' => $cartItem->getQuantity(),
                'subtotal' => $cartItem->calculateSubTotal(),
                'totalQuantity' => $cartItems->sum(fn (Item $i) => $i->getQuantity()),
                'totalAmount' => $cartItems->sum(fn (Item $i) => $i->calculateSubTotal()),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', __('cart.updated'));
    }

    public function remove(RemoveFromCartRequest $request, Product $product): RedirectResponse
    {
        $this->cartService->removeProduct($product->getId());

        return redirect()->route('cart.index')
            ->with('success', __('cart.product_removed'));
    }

    public function removeService(int $serviceId): RedirectResponse
    {
        $this->cartService->removeService($serviceId);

        return redirect()->route('cart.index')
            ->with('success', __('cart.service_removed'));
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')
            ->with('success', __('cart.cleared'));
    }
}
