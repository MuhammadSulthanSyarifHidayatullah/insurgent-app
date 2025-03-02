<?php

namespace App\Services;

use App\Models\User;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    public function sendNewProductNotification(Product $product)
    {
        $users = User::whereNotNull('phone')->get();
        $message = $this->getNewProductTemplate($product);

        foreach ($users as $user) {
            $this->sendWhatsAppMessage($user->phone, $message);
        }
    }

    public function sendCheckoutNotification(User $user, Invoice $invoice)
    {
        $message = $this->getCheckoutTemplate($user, $invoice);
        $this->sendWhatsAppMessage($user->phone, $message);
    }

    private function sendWhatsAppMessage($phone, $message)
    {
        Http::withHeaders([
            'Authorization' => config('services.fonnte.api_key'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
        ]);
    }

    private function getNewProductTemplate(Product $product)
    {
        return "New Product Alert! 🎉\n\n" .
               "We're excited to introduce our latest product:\n\n" .
               "🛍️ {$product->name}\n" .
               "💰 Price: Rp " . number_format($product->price, 2, ',', '.') . "\n\n" .
               "Be among the first to check it out! Shop now at Partisan.com\n\n" .
               "Thank you for being a valued customer!\n" .
               "Best regards,\n" .
               "Partisan";
    }

    private function getCheckoutTemplate(User $user, Invoice $invoice)
    {
        return "Thank you for your purchase, {$user->name}! 🛒\n\n" .
               "Order Details:\n" .
               "🧾 Invoice #: {$invoice->id}\n" .
               "💰 Total Amount: Rp " . number_format($invoice->total_amount, 2, ',', '.') . "\n" .
               "📦 Status: " . ucfirst($invoice->status) . "\n\n" .
               "We're processing your order and will update you soon.\n\n" .
               "Thank you for shopping with us!\n" .
               "Best regards,\n" .
               "Partisan";
    }
}

