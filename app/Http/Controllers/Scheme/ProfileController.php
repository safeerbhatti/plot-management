<?php

namespace App\Http\Controllers\Scheme;

use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $scheme = Scheme::find($id);
        $slug = $scheme->slug;
        return view('schemes.profile', compact('scheme', 'slug'));
    }
}
