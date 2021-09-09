<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->id() != 1) {
            abort(403);
        }

        $users = User::all();

        return view('dashboard.user.index', compact('users'));
    }

    public function create()
    {
        if (auth()->id() != 1) {
            abort(403);
        }

        return view('dashboard.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create(
            array_merge(
                $request->validated(),
                [
                    'password' => bcrypt($request->password)
                ]
            )
        );

        return redirect()->route('user.index')->with('status', "Berhasil menambah akun {$user->name}");
    }

    public function edit(User $user)
    {
        if (!$this->checkPermission($user)) {
            abort(403);
        }

        return view('dashboard.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if (!$this->checkPermission($user)) {
            abort(403);
        }

        $user->update(array_merge(
            $request->validated(),
            [
                'password' => $request->filled('password') ? bcrypt($request->password) : $user->password
            ]
        ));

        return redirect()->route('kegiatan.index')->with('status', "Berhasil mengubah akun {$user->name}");
    }

    public function destroy(User $user)
    {
        if (auth()->id() != 1) {
            abort(403);
        }

        $user->delete();

        return redirect()->route('user.index')->with('status', "Berhasil menghapus akun {$user->name}");
    }

    protected function checkPermission(User $user): bool
    {
        if (auth()->id() == $user->id)
            return true;


        if (auth()->id() == 1)
            return true;

        return false;
    }
}
