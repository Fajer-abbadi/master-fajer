<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
{
    View::composer('*', function ($view) {
        // احسب عدد الرسائل غير المقروءة التي وصلت إلى المسؤول فقط
        $adminId = Auth::id(); // الحصول على ID المسؤول الحالي
        $newMessagesCount = Message::where('receiver_id', $adminId)
            ->where('is_read', 0)
            ->count();

        // مرر المتغير لجميع الـ views
        $view->with('newMessagesCount', $newMessagesCount);
    });
}

}
