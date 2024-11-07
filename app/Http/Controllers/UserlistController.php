<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserlistController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all'); // Default filter is 'all'

        // Query builder awal
        $query = User::query();

        // Mapping untuk filter
        $filters = [
            'admin' => function ($query) {
                $query->where('type', 'admin');
            },
            'officer' => function ($query) {
                $query->where('type', 'officer');
            },
            'user' => function ($query) {
                $query->where('type', 'user');
            },
        ];

        // Terapkan filter jika ada di mapping
        if (isset($filters[$filter])) {
            $filters[$filter]($query);
        }

        // Mengambil data berdasarkan query
        $UserList = $query->get();

        return view('UserList.index', compact('UserList'));
    }

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Cek jika user bertipe 'admin'
        if ($user->type === 'admin') {
            return redirect()->route('user.list')->with('error', 'Admin users cannot be deleted.');
        }
    
        // Hapus user jika bukan 'admin'
        $user->delete();
    
        return redirect()->route('user.list')->with('success', 'User deleted successfully');
    }
    
}
