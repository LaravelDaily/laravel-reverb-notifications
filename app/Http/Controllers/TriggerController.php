<?php

namespace App\Http\Controllers;

use App\Events\TriggerNotificationEvent;
use App\Events\TriggerPrivateNotificationEvent;
use App\Models\User;
use Illuminate\Http\Request;

class TriggerController extends Controller
{
    public function __invoke(Request $request)
    {
        switch ($request->input('type')) {
            case 'public':
                event(new TriggerNotificationEvent('Hello World!'));
                break;
            case 'private':
                $user = User::findOrFail($request->input('user_id'));
                event(new TriggerPrivateNotificationEvent('Hello in private!', $user));
                break;
        }
    }
}
