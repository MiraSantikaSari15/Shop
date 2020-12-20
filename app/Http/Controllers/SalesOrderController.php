<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SalesOrder;
use App\Model\Product;
use App\Model\Customer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SalesOrderController extends Controller
{
    public function index()
    {
    	return view('pages.sales_order.index');
	}

	public function datatable(Request $request)
	{
		DB::statement(DB::raw('set @rownum=0'));
		$salesOrder  = SalesOrder::select('*', DB::raw('@rownum  := @rownum  + 1 AS rownum'))
		->with('customer')
		->with('product')
		->latest()
		->get();

		$datatables = Datatables::of($salesOrder);

		return $datatables
                ->addColumn('actions', function ($salesOrder) {
                    return '<form id="delete-row-' . $salesOrder->id . '" action="' . route('sales-order.destroy', $salesOrder->id) . '" method="POST">' . csrf_field() . method_field('DELETE') . '</form>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="' . route('sales-order.edit', $salesOrder->id) . '" class="dropdown-item"><i class="icon-database-edit2" title="Edit"></i>Edit</a>
                                            <a href="#" onClick="event.preventDefault(); document.getElementById(\'delete-row-' . $salesOrder->id . '\').submit();" class="dropdown-item"><i class="icon-database-remove" title="Delete"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>';
                })
                ->addColumn('name', function ($salesOrder) {
                	return $salesOrder->customer->name;
                })
                ->addColumn('address', function ($salesOrder) {
                	return Str::words(strip_tags($salesOrder->customer->address), 20, '...');
                })
                ->editColumn('product', function ($salesOrder) {
                   return $salesOrder->product->title;
                })
                ->editColumn('price', function ($salesOrder) {
                   return '<b>Rp. '.number_format($salesOrder->product->price).'</b>';
                })
                ->rawColumns(['actions', 'price'])
                ->make(true);
	}

	public function create()
	{
		$customers 	= Customer::all();
		$products	= Product::all();
		return view('pages.sales_order.create', compact('customers', 'products'));
	}

	public function detailCustomer($id)
	{
		$customer 	= Customer::whereId($id)->firstOrFail();

		$data 		= [
			'email'		=> $customer->email,
			'phone'		=> $customer->phone,
			'address'	=> strip_tags($customer->address)
		];

		return response()->json($data);
	}

	public function store(Request $request)
	{
		$request->validate([
			'customer'       	=> 'required',
			'products'       	=> 'required',
		]);

		$products = $request->products;

		foreach ($products as $key) {
			SalesOrder::create([
				'customer_id'	=> $request->customer,
				'product_id'	=> $key
			]);
		}

		return redirect()->route('sales-order.index');
	}
}
