<?php

namespace App\Http\ViewComposers;

use App\Models\LeaveRequest;
use Illuminate\View\View;
use App\Models\Orders\Order;
use Illuminate\Support\Facades\Auth;

class CountersComposer
{
    /**
     * CountersComposer constructor.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $view->with([
                'pendingCount' => LeaveRequest::pending()->count(),
                'pendinginplaceCount' => LeaveRequest::pendinginplace()->count(),
//                'assignedCount' => Order::assignedCount(),
//                'submittedCount' => Order::submittedCount(),
//                'revisionsCount' => Order::revisionsCount(),
//                'disputesCount' => Order::disputesCount(),
//                'notificationsCount' => Auth::user()->unreadNotifications->count(),
//                'messagesCount' => Auth::user()->unreadMessages->count(),
            ]);
        }
    }
}
