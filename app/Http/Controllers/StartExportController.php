<?php

namespace App\Http\Controllers;

use App\Jobs\ExportPdfDataJob;

class StartExportController extends Controller
{
    public function __invoke()
    {
        dispatch(new ExportPdfDataJob(auth()->id()));

        return redirect()->back();
    }
}
