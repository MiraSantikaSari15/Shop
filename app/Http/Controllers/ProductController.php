<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\FileHelpers;

class ProductController extends Controller
{
    public function index()
    {
    	return view('pages.products.index');
	}

	public function datatable(Request $request)
	{
		DB::statement(DB::raw('set @rownum=0'));
		$products  = Product::select('*', DB::raw('@rownum  := @rownum  + 1 AS rownum'))
		->latest()
		->get();

		$datatables = Datatables::of($products);

		return $datatables
                ->addColumn('actions', function ($products) {
                    return '<form id="delete-row-' . $products->id . '" action="' . route('products.destroy', $products->id) . '" method="POST">' . csrf_field() . method_field('DELETE') . '</form>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="' . route('products.edit', $products->id) . '" class="dropdown-item"><i class="icon-database-edit2" title="Edit"></i>Edit</a>
                                            <a href="#" onClick="event.preventDefault(); document.getElementById(\'delete-row-' . $products->id . '\').submit();" class="dropdown-item"><i class="icon-database-remove" title="Delete"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>';
                })
                ->addColumn('image', function ($products) {
                	return "<img src='/assets/img/products/".$products->image."' width='100%'>";
                })
                ->editColumn('description', function ($products) {
                    return Str::words(strip_tags($products->description), 20, '...');
                })
                ->editColumn('created_at', function ($products) {
                    return $products->created_at->diffForHumans();
                })
                ->rawColumns(['image', 'description', 'actions'])
                ->make(true);
	}

	public function create()
	{
		return view('pages.products.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'title'       	=> 'required',
			'size'       	=> 'required',
			'price'       	=> 'required',
			'stock'       	=> 'required',
			'description' 	=> 'required',
			'image'       	=> 'required|mimes:jpg,jpeg,png',
		]);

		$file = $request->file('image');
        if ($file) {
            $name_file = $file->hashName();
            $destinasi = 'assets/img/products/';
            $file->move($destinasi, $name_file);
        } else {
        	$name_file = null;
        }

		Product::create([
			'title' 		=> $request->title,
			'slug'			=> Str::of($request->title)->replace(' ', '-'),
			'size' 			=> $request->size,
			'price' 		=> $request->price,
			'stock' 		=> $request->stock,
			'description' 	=> $request->description,
			'image' 		=> $name_file,
		]);

		return redirect()->route('products.index');
	}

	public function edit(Product $product)
	{
		return view('pages.products.edit', compact('product'));
	}

	public function update(Request $request, Product $product)
	{
		$request->validate([
			'title'       	=> 'required',
			'size'       	=> 'required',
			'price'       	=> 'required',
			'stock'       	=> 'required',
			'description' 	=> 'required',
			'image'       	=> 'mimes:jpg,jpeg,png',
		]);


		$file = $request->file('image');
        if ($file) {
            $name_file = $file->hashName();
            $destinasi = 'assets/img/products/';
            $file->move($destinasi, $name_file);
        } else {
        	$name_file = $product->image;
        }

		$product->update([
			'title' 		=> $request->title,
			'size' 			=> $request->size,
			'price' 		=> $request->price,
			'stock' 		=> $request->stock,
			'description' 	=> $request->description,
			'image' 		=> $name_file,
		]);

		return redirect()->route('products.index');

	}

	public function destroy(Product $product)
	{
		$product->delete();

		return redirect()->route('products.index');
	}
}
