<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Http\Requests\Order\CheckoutRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Services\CartService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class OrderController extends Controller
{
    use AuthorizesRequests;

    private const CART_KEY          = 'shopping_cart';
    private const CART_SERVICES_KEY = 'shopping_cart_services';

    public function __construct(private readonly CartService $cartService) {}

    public function index(): View
    {
        $authenticatedUserId = (int) Auth::id();

        $viewData = [];
        $viewData['title'] = __('order.my_orders_title');
        $viewData['orders'] = Order::with('items.product', 'items.service')
            ->where('user_id', $authenticatedUserId)
            ->orderByDesc('id')
            ->get();

        return view('orders.index', ['viewData' => $viewData]);
    }

    public function show(Order $order): View
    {
        $this->authorize('view', $order);
        $order->loadMissing('items.product', 'items.service');

        $viewData = [];
        $viewData['title'] = __('order.detail_title');
        $viewData['order'] = $order;

        return view('orders.show', ['viewData' => $viewData]);
    }

    public function checkout(): View|RedirectResponse
    {
        $cart         = Session::get(self::CART_KEY, []);
        $cartServices = Session::get(self::CART_SERVICES_KEY, []);

        if (count($cart) === 0 && count($cartServices) === 0) {
            return redirect()->route('cart.index')
                ->with('error', __('cart.empty'));
        }

        $cartItems = $this->cartService->buildCartItems();

        $viewData = [];
        $viewData['title'] = __('order.checkout_title');
        $viewData['cartItems'] = $cartItems;
        $viewData['totalQuantity'] = $cartItems->sum(fn (Item $item) => $item->getQuantity());
        $viewData['totalAmount'] = $cartItems->sum(fn (Item $item) => $item->calculateSubTotal());
        $viewData['user'] = Auth::user();

        return view('checkout.index', ['viewData' => $viewData]);
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        $cart         = Session::get(self::CART_KEY, []);
        $cartServices = Session::get(self::CART_SERVICES_KEY, []);

        if (count($cart) === 0 && count($cartServices) === 0) {
            return redirect()->route('cart.index')
                ->with('error', __('cart.empty'));
        }

        $paymentMethod       = (string) $request->validated('payment_method');
        $authenticatedUser   = Auth::user();
        $authenticatedUserId = (int) $authenticatedUser->getId();

        $order = new Order;
        $order->setUserId($authenticatedUserId);
        $order->setPaymentMethod($paymentMethod);
        $order->setDate(date('Y-m-d'));
        $order->setStatus('pending');
        $order->setTotal(0);
        $order->save();

        $total = 0;

        // ── Products ──────────────────────────────────────────────────────
        foreach ($cart as $productId => $quantity) {
            $product = Product::where('active', true)->find((int) $productId);

            if (! $product || (int) $quantity <= 0) {
                continue;
            }

            $item = new Item;
            $item->setOrderId($order->getId());
            $item->setProductId($product->getId());
            $item->setServiceId(null);
            $item->setItemType('product');
            $item->setQuantity((int) $quantity);
            $item->setPrice($product->getPrice());
            $item->save();

            $product->setStock(max(0, $product->getStock() - (int) $quantity));
            $product->save();

            $total += $item->calculateSubTotal();
        }

        // ── Services ──────────────────────────────────────────────────────
        foreach ($cartServices as $serviceId => $quantity) {
            $service = Service::where('active', true)->find((int) $serviceId);

            if (! $service) {
                continue;
            }

            $item = new Item;
            $item->setOrderId($order->getId());
            $item->setProductId(null);
            $item->setServiceId($service->getId());
            $item->setItemType('service');
            $item->setQuantity(1);
            $item->setPrice($service->getPrice());
            $item->save();

            $total += $item->calculateSubTotal();
        }

        $order->setTotal($total);
        $order->save();

        Session::forget(self::CART_KEY);
        Session::forget(self::CART_SERVICES_KEY);

        return redirect()->route('order.show', $order->getId())
            ->with('success', __('order.placed_successfully'));
    }
}