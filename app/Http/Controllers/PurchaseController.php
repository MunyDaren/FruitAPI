<?php

namespace App\Http\Controllers;
use App\Models\AddToCart;
use Illuminate\Http\Request;
use App\Models\Purchase;
class PurchaseController extends Controller
{
    public function confirmOrder(Request $request)
    {
        // Validate request
        $request->validate([
            'total_amount' => 'required|numeric',
        ]);

        try {
            // Create a new purchase record
            $purchase = Purchase::create([
                'total_amount' => $request->total_amount,
            ]);

            // Optionally, clear the cart after creating the purchase
            AddToCart::truncate(); // Remove all items from the cart

            return response()->json(['message' => 'Order confirmed successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to confirm order', 'error' => $e->getMessage()], 500);
        }
    }
}
