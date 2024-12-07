<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendUser;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = FrontendUser::where('user_type', 'customer')->paginate(10);
        return view('admin.customers.index', compact('customer'));
    }

    public function show(FrontendUser $user)
    {
        return view('admin.customers.show', compact('user'));
    }

    public function destroy(FrontendUser $user)
    {
        $user->delete();
        return redirect()->route('customers.index')->with('success', 'Seller deleted successfully.');
    }
}