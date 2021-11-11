<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        $input = $request->validated();
        $avatar = $input['avatar'];

        if ($avatar->isValid()) {
            $path = $avatar->store('images', 'public');
            $input['avatar'] = $path;
        }

        return User::create($input);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $input = $request->validated();
        $avatar = $input['avatar'];

        if ($avatar->isValid()) {
            Storage::disk('public')->delete($user->avatar);
            $path = $avatar->store('images', 'public');
            $input['avatar'] = $path;
        }
        $user->fill($input);
        $user->save();

        return $user;
    }

    public function updateAvatar(User $user, UserUpdateRequest $request)
    {
        $input = $request->validated();
        $avatar = $input['avatar'];

        if ($avatar->isValid()) {
            Storage::disk('public')->delete($user->avatar);
            $path = $avatar->store('images', 'public');
            $user->avatar = $path;
            $user->save();
        }

        return $user;
    }
}
