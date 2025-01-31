<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function index()
    {
        $users = User::all();
        $templates = $this->getMessageTemplates();
        return view('admin.notifications.index', compact('users', 'templates'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'message' => 'required|string',
        ]);

        $successCount = 0;
        $failCount = 0;

        if ($request->user_id === 'all') {
            $users = User::whereNotNull('phone')->get();
        } else {
            $users = User::where('id', $request->user_id)->whereNotNull('phone')->get();
        }

        foreach ($users as $user) {
            $response = Http::withHeaders([
                'Authorization' => config('services.fonnte.api_key'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $user->phone,
                'message' => $request->message,
            ]);

            if ($response->successful()) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        $message = "Messages sent successfully to {$successCount} users.";
        if ($failCount > 0) {
            $message .= " Failed to send to {$failCount} users.";
        }

        return back()->with('success', $message);
    }

    private function getMessageTemplates()
    {
        return [
            'order_confirmation' => "Dear [Customer Name],\n\nThank you for your order #[Order Number]. We're pleased to confirm that your order has been received and is being processed.\n\nEstimated delivery date: [Delivery Date]\n\nIf you have any questions, please don't hesitate to contact us.\n\nBest regards,\n Partisan",
            'shipping_notification' => "Hello [Customer Name],\n\nGreat news! Your order #[Order Number] has been shipped and is on its way to you.\n\nTracking Number: [Tracking Number]\nEstimated Delivery: [Delivery Date]\n\nThank you for choosing us!\n\nBest regards,\n Partisan",
            'special_offer' => "Exclusive Offer for [Customer Name]!\n\nEnjoy a special [Discount]% discount on your next purchase. Use code [Promo Code] at checkout.\n\nValid until: [Expiry Date]\n\nShop now at [Your Website]\n\nBest regards,\n Partisan",
        ];
    }
}

