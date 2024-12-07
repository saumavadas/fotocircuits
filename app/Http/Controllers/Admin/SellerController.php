<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendUser;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = FrontendUser::where('user_type', 'seller')->paginate(10);
        return view('admin.sellers.index', compact('sellers'));
    }

    public function show(FrontendUser $user)
    {
        return view('admin.sellers.show', compact('user'));
    }

    public function destroy(FrontendUser $user)
    {
        $user->delete();
        return redirect()->route('sellers.index')->with('success', 'Seller deleted successfully.');
    }
}