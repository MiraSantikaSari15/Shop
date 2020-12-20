<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\FileHelpers;

class CustomerController extends Controller
{
    public function index()
    {
    	return view('pages.customers.index');
	}

	public function datatable(Request $request)
	{
		DB::statement(DB::raw('set @rownum=0'));
		$customers  = Customer::select('*', DB::raw('@rownum  := @rownum  + 1 AS rownum'))
		->latest()
		->get();

		$datatables = Datatables::of($customers);

		return $datatables
                ->addColumn('actions', function ($customers) {
                    return '<form id="delete-row-' . $customers->id . '" action="' . route('customers.destroy', $customers->id) . '" method="POST">' . csrf_field() . method_field('DELETE') . '</form>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="' . route('customers.edit', $customers->id) . '" class="dropdown-item"><i class="icon-database-edit2" title="Edit"></i>Edit</a>
                                            <a href="#" onClick="event.preventDefault(); document.getElementById(\'delete-row-' . $customers->id . '\').submit();" class="dropdown-item"><i class="icon-database-remove" title="Delete"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>';
                })
                ->addColumn('image', function ($customers) {
                	return "<img src='/assets/img/customers/".$customers->image."' width='100%'>";
                })
                ->editColumn('address', function ($customers) {
                   return Str::words(strip_tags($customers->address), 20, '...');
                })
                ->rawColumns(['image', 'address', 'actions'])
                ->make(true);
	}

	public function create()
	{
		return view('pages.customers.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name'       		=> 'required',
			'date_of_birth'     => 'required',
			'email'       		=> 'required',
			'phone'       		=> 'required',
			'address' 			=> 'required',
			'image'       		=> 'required|mimes:jpg,jpeg,png',
		]);

		$file = $request->file('image');
        if ($file) {
            $name_file = $file->hashName();
            $destinasi = 'assets/img/customers/';
            $file->move($destinasi, $name_file);
        } else {
        	$name_file = null;
        }

		Customer::create([
			'name' 			=> $request->name,
			'date_of_birth'	=> $request->date_of_birth,
			'email' 		=> $request->email,
			'phone' 		=> $request->phone,
			'address' 		=> $request->address,
			'image' 		=> $name_file,
		]);

		return redirect()->route('customers.index');
	}

	public function edit(Customer $customer)
	{
		return view('pages.customers.edit', compact('customer'));
	}

	public function update(Request $request, Customer $customer)
	{
		$request->validate([
			'name'       		=> 'required',
			'date_of_birth'     => 'required',
			'email'       		=> 'required',
			'phone'       		=> 'required',
			'address' 			=> 'required',
			'image'       		=> 'mimes:jpg,jpeg,png',
		]);

		$file = $request->file('image');
        if ($file) {
            $name_file = $file->hashName();
            $destinasi = 'assets/img/customers/';
            $file->move($destinasi, $name_file);
        } else {
        	$name_file = $customer->image;
        }

		$customer->update([
			'name' 			=> $request->name,
			'date_of_birth'	=> $request->date_of_birth,
			'email' 		=> $request->email,
			'phone' 		=> $request->phone,
			'address' 		=> $request->address,
			'image' 		=> $name_file,
		]);

		return redirect()->route('customers.index');

	}

	public function destroy(Customer $customer)
	{
		$customer->delete();

		return redirect()->route('customers.index');
	}
}
