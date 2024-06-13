<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    public function info() {
        $apiKey = 'fake-api-key-123456489';
        return view('admin.api.docs', compact('apiKey'));
    }
}
