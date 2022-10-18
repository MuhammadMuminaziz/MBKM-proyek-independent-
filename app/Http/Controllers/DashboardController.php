<?php

namespace App\Http\Controllers;

use App\Models\KartuRm;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Year::latest()->first();
        if ($data->year != date('Y')) {
            $y = $data->year + 1;
            Year::create(['year' => $y]);
        }

        // KartuRm::withTrashed()->restore();
        return view('index');
    }

    public function createAccount()
    {
        $this->authorize('admin');
        return view('users.registrasi');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('failed', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function users()
    {
        $this->authorize('admin');
        $data = User::all();
        return view('users.index', compact('data'));
    }

    public function viewUser($id)
    {
        $this->authorize('admin');
        $data = User::find($id);
        return view('users.view', compact('data'));
    }

    public function deleteUser($id)
    {
        $this->authorize('admin');
        User::find($id)->delete();
        return back()->with('success', 'Data Berhasil di Hapus!');
    }

    public function registrasi(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'type' => 'required',
            'password' => 'required|min:6'
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['photo'] = $request->photo;
        User::create($data);
        return back()->with('success', 'Akun Berhasil dibuat!');
    }

    public function user($id)
    {
        $data = User::find($id);
        return view('user', compact('data'));
    }

    public function editUser(Request $request)
    {
        $data = $request->validate([
            'photo' => 'image|file|max:5120'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'place' => $request->place,
            'birth' => $request->birth,
            'address' => $request->address,
        ];
        $photo = $request->photo;
        $name = date('Ymdhis') . '.' . $photo->getClientOriginalExtension();
        $user = User::find($request->id);
        if ($photo) {
            if ($user->photo != 'default.png') {
                unlink('img/users/' . $user->photo);
            }
            $photo->move('img/users', $name);
            $data['photo'] = $name;
        } else {
            $data['photo'] = $user->photo;
        }
        User::where('id', $request->id)->update($data);
        return back()->with('success', 'Profile berhasil di edit!..');
    }
}
