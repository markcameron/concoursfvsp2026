<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QrRedirectController extends Controller
{
    public function __invoke(Request $request, string $slug): RedirectResponse
    {
        $qrCode = QrCode::where('slug', $slug)->firstOrFail();

        $qrCode->visits()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect($qrCode->destination);
    }
}
