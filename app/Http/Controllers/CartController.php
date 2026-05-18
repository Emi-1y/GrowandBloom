<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\Item;
use App\Models\Plant;
use App\Models\Service;
use App\Services\CartService;
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

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(AddToCartRequest $request): RedirectResponse
    {
        $itemType = $request->input('item_type', 'plant');
        $quantity = (int) $request->validated('quantity', 1);

        if ($itemType === 'service') {
            $serviceId = (int) $request->input('service_id');
            $service = Service::where('active', true)->findOrFail($serviceId);
            $this->cartService->addService($service);

            return redirect()->route('cart.index')
                ->with('success', __('cart.service_added'));
        }

        $plantId = (int) $request->validated('plant_id', 0);
        $plant = Plant::where('active', true)->findOrFail($plantId);
        $this->cartService->addPlant($plant, $quantity);

        return redirect()->route('cart.index')
            ->with('success', __('cart.plant_added'));
    }

    public function update(UpdateCartItemRequest $request, Plant $plant): RedirectResponse
    {
        $activePlant = Plant::where('active', true)->findOrFail($plant->getId());
        $quantity = (int) $request->validated('quantity');

        $this->cartService->updatePlantQuantity($activePlant, $quantity);

        return redirect()->route('cart.index')
            ->with('success', __('cart.updated'));
    }

    public function remove(Plant $plant): RedirectResponse
    {
        $this->cartService->removePlant($plant->getId());

        return redirect()->route('cart.index')
            ->with('success', __('cart.plant_removed'));
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
