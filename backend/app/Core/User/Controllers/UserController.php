<?php

namespace App\Core\User\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Core\Common\Controllers\Controller;
use App\Core\Project\Models\User;
use App\Core\User\Resources\UserResource;

class UserController extends Controller
{
    public function getUserInfo(User $user) {
        return response()->success(new UserResource($user));
    }
}
