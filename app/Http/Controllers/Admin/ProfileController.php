<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedId = intval(Auth::id());

        $user = User::find($loggedId);

        if ($user) {
            return view('admin.profile.index', [
                'user' => $user
            ]);
        }

        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if ($user) {

            $datas = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $datas['name'],
                'email' => $datas['email']
            ], [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:100'
            ]);

            $user->name = $datas['name'];

            if ($user->email != $datas['email']) {
                $hasEmail = User::where('email', $datas['email'])->get();
                if (count($hasEmail) === 0) {
                    $user->email = $datas['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            if (!empty($datas['password'])) {
                if (strlen($datas['password']) >= 4) {
                    if ($datas['password'] === $datas['password_confirmation']) {
                        $user->password = Hash::make($datas['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password',
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('profile', ['user' => $loggedId])
                    ->withErrors($validator);
            }

            $user->save();
            return redirect()->route('profile')->with('warning', 'Informações alterada com sucesso!');
        }
        return redirect()->route('profile');
    }
}
