<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;

class UserMetaController extends Controller
{
    public function index($userId)
    {
        $user = User::with('metas')->findOrFail($userId);
        return view('admin.user_metas.index', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'meta_key' => 'required|string|max:255',
            'meta_value' => 'required|string',
        ]);

        $user = User::findOrFail($userId);
        $user->metas()->create($request->only('meta_key', 'meta_value'));

        return redirect()->route('admin.user_metas.index', $userId)->with('success', 'Meta added successfully.');
    }

    public function destroy($userId, $metaId)
    {
        $user = User::findOrFail($userId);
        $user->metas()->where('id', $metaId)->delete();

        return redirect()->route('admin.user_metas.index', $userId)->with('success', 'Meta deleted successfully.');
    }
}