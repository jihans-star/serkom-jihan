<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $users = User::where('role', 'Operator')->get();

        return view('admin.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.add_user');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:225',
            'username' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'Operator',
        ]);

        return redirect()->route('admin.user.index')->with('success','Operator baru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Menggunakan view yang sama untuk melihat sekaligus mengedit data
        return view('admin.show_user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Username harus unik, tapi abaikan pengecekan untuk user yang sedang diedit ini sendiri
            'username' => 'required|string|max:30|unique:users,username,' . $user->id,
            // Password opsional (hanya diisi jika ingin mengganti password baru)
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
        ];

        // Jika kolom password diisi, update passwordnya
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Data operator berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Operator berhasil dihapus!');
    }
}
