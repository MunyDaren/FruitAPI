<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AddToCart;

class AddToCartController extends Controller
{
    /**
     * Add a product to the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $product = Product::findOrFail($request->product_id);

            // Check if the product is already in cart, if yes, update quantity; otherwise, create new entry
            $cartItem = AddToCart::where('product_id', $product->id)->first();

            if ($cartItem) {
                // Update quantity
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // Create new cart item
                AddToCart::create([
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }

            return response()->json(['message' => 'Product added to cart successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add product to cart', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove a product from the cart.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart($id)
    {
        try {
            $cartItem = AddToCart::findOrFail($id);
            $cartItem->delete();

            return response()->json(['message' => 'Product removed from cart successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to remove product from cart', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all products in the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCart()
    {
        try {
            $cartItems = AddToCart::with('product')->get();

            return response()->json($cartItems, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch cart items', 'error' => $e->getMessage()], 500);
        }
    }
    public function clearCart()
    {
        try {
            // Delete all cart items
            AddToCart::truncate();

            return response()->json(['message' => 'Cart cleared successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to clear the cart', 'error' => $e->getMessage()], 500);
        }
    }
    public function updateQuantity(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $cartItem = AddToCart::findOrFail($id);

            // Update quantity
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            return response()->json(['message' => 'Cart item quantity updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update cart item quantity', 'error' => $e->getMessage()], 500);
        }
    }
}
