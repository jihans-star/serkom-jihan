<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.add_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'username' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:Admin,Operator',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => 'Aktif',
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Pengelola baru berhasil disimpan');
    }

    public function show(User $user)
    {
        return view('admin.user.show_user', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.show_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:30|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:Admin,Operator',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data pengelola berhasil diperbarui!');
    }

    public function toggleStatus(User $user)
    {
        $user->update([
            'status' => $user->status === 'Aktif'
                ? 'Nonaktif'
                : 'Aktif'
        ]);

        $pesan = $user->status === 'Aktif'
            ? 'Pengelola berhasil diaktifkan.'
            : 'Pengelola berhasil dinonaktifkan.';

        return redirect()
            ->route('admin.user.index')
            ->with('success', $pesan);
    }

    public function destroy(User $user)
    {
        if ($user->beritas()->exists()) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Pengelola tidak dapat dihapus karena sudah memiliki berita.');
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Pengelola berhasil dihapus.');
    }
}
