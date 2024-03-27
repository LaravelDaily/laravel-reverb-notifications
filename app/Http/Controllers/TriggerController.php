<?php

namespace App\Http\Controllers;

use App\Events\TriggerNotificationEvent;
use App\Events\TriggerPrivateNotificationEvent;
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
                event(new TriggerPrivateNotificationEvent('Hello in private!', auth()->user()));
                break;
        }
    }
}
