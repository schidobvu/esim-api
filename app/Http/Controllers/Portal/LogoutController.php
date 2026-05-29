<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\PersonalAccessTokenArchive;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->user()->tokens()->each(function ($token) {
            PersonalAccessTokenArchive::create(collect($token->toArray())->except(['updated_at', 'created_at', 'abilities'])->toArray());
            $token->delete();
        });
        return $this->respond()->ok()->json();
    }
}
