<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Http\Requests\Order\CheckoutRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class OrderController extends Controller
{
    use AuthorizesRequests;

    private const CART_KEY = 'shopping_cart';

    public function __construct(private readonly CartService $cartService) {}

    public function index(): View
    {
        $authenticatedUserId = (int) Auth::id();

        $viewData = [
            'orders' => Order::with('items.product')
                ->where('user_id', $authenticatedUserId)
                ->orderByDesc('id')
                ->get(),
            'title' => __('order.index_title'),
        ];

        return view('orders.index', ['viewData' => $viewData]);
    }

    public function show(Order $order): View
    {
        $this->authorize('view', $order);
        $order->loadMissing('items.product');

        $viewData = [
            'order' => $order,
            'title' => __('order.show_title'),
        ];

        return view('orders.show', ['viewData' => $viewData]);
    }

    public function checkout(): View|RedirectResponse
    {
        $cart = Session::get(self::CART_KEY, []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', __('order.cart_empty'));
        }

        $cartItems = $this->cartService->buildCartItems();
        $user = Auth::user();

        $viewData = [
            'title' => __('checkout.title'),
            'cartItems' => $cartItems,
            'totalQuantity' => $cartItems->sum(fn (Item $item) => $item->getQuantity()),
            'totalAmount' => $cartItems->sum(fn (Item $item) => $item->calculateSubTotal()),
            'user' => $user,
        ];

        return view('checkout.index', ['viewData' => $viewData]);
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        $cart = Session::get(self::CART_KEY, []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', __('order.cart_empty'));
        }

        $validated = $request->validated();
        $paymentMethod = (string) $validated['payment_method'];
        $authenticatedUser = Auth::user();

        $authenticatedUser->setName($validated['name']);
        $authenticatedUser->setEmail($validated['email']);
        $authenticatedUser->setPhone($validated['phone']);
        $authenticatedUser->setAddress($validated['address']);
        $authenticatedUser->setCity($validated['city']);
        $authenticatedUser->setPostalCode($validated['postal_code']);
        $authenticatedUser->save();

        $authenticatedUserId = (int) $authenticatedUser->getId();

        $order = DB::transaction(function () use ($cart, $paymentMethod, $authenticatedUserId) {
            $order = new Order;
            $order->setUserId($authenticatedUserId);
            $order->setPaymentMethod($paymentMethod);
            $order->setDate(date('Y-m-d'));
            $order->setStatus('pending');
            $order->setTotal(0);
            $order->save();

            $total = 0;

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

                $newStock = max(0, $product->getStock() - (int) $quantity);
                $product->setStock($newStock);
                $product->save();

                $total += $item->calculateSubTotal();
            }

            $order->setTotal($total);
            $order->save();

            return $order;
        });

        Session::forget(self::CART_KEY);

        return redirect()->route('order.show', $order->getId())
            ->with('success', __('order.created_successfully'));
    }
}
