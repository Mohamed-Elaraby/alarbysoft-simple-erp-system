<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Product;
use App\PurchaseInvoice;
use App\PurchaseInvoiceProducts;
use App\Purchases;
use App\SaleOrder;
use App\SaleOrderProducts;
use App\Store;
use App\Supplier;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','CheckRole:admin']);
    }

    /* Admin Dashboard */
    public function dashboard ()
    {
        return view('admin.dashboard');
    }

    /* CURD Users*/
    public function users ()
    {
        return "Admin Users";
    }

    public function createUser ()
    {
        //
    }

    public function storeUser(Request $request, User $user)
    {
        //
    }

    public function editUser($id)
    {
        //
    }

    public function updateUser($id, Request $request)
    {
        //
    }

    public function destroyUser(Request $request)
    {
        //
    }

    public function get_quantity_Available ()
    {
        $id = $_GET['productId'];
        $quantity_Available = Product::where('id', $id)->first();
        echo $quantity_Available->quantity;
    }

}
