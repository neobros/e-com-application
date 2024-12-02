<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BrandManagementController extends Controller
{
    public function addBrand()
    {
        return view('admin.brandManagement.addBrand');
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255|unique:brands',
         ]);

        Brand::create([
            'brand_name' => $request->brand_name,   
        ]);

        return redirect()->back()->with([
            'success'  =>  'Brand Added Successfully.', 
        ]);
    }

    public function brandList()
    {
        $brandList = Brand::all();

        return view('admin.brandManagement.brandList')->with([
            'brandList'  =>  $brandList, 
        ]);
    }

    public function brandDelete($brand_id)
    {   
        Brand::where('brand_id', $brand_id)->delete();
        return redirect()->back()->with('success', 'Brand Delete Successfully.');
    }

    public function addItems()
    {
        $brandList = Brand::all();

        return view('admin.brandManagement.addItems')->with([
            'brandList'  =>  $brandList, 
        ]);
    }


    public function storeItems(Request $request)
    {
        $request->validate([
            'item_name'      => 'required|string|max:255',
            'brand_id'      => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description'    => 'required',
            'cost_price' => 'required|integer|min:1',
            'sell_price' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ]);

        try{

            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = str_replace('.', '', microtime(true)) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
            }

            $storageOptions = ['storage64GB', 'storage128GB', 'storage256GB', 'storage512GB', 'storage1TB', 'storage2TB'];
            $storage = array_filter($request->only($storageOptions), fn($value) => $value !== null);
            $storageJson = json_encode(array_values($storage));
            
            $product = new Product([
                    'item_name' =>$request->item_name,
                    'storage' =>$storageJson,
                    'image' =>$imageName,
                    'cost_price' =>$request->cost_price,  
                    'sell_price' =>$request->sell_price,
                    'quantity' =>$request->quantity,
                    'description' =>$request->description,
                    'brand_id' =>$request->brand_id,
                    'admin_id' => Auth::guard('admin')->user()->id,
                ]);

            $product->save();
            
            return redirect()
            ->back()
            ->with('success', 'New Item added successfully.');

        }
        catch(\Exception $error){
            return redirect()
            ->back()
            ->with('delete', 'Something goes wrong. Please try again.');
        }

    }

    public function itemsList()
    {
        $productList = Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')->select('products.*', 'brands.brand_name')->get();
        $brandList = Brand::all();
        return view('admin.brandManagement.itemsList')->with([
            'productList'  =>  $productList, 
            'brandList'  =>  $brandList, 
        ]);
    }

    public function cngItemStatus($product_id,$status)
    {   
        $update = [
            'status' => $status,
        ];
        Product::where('product_id',$product_id)->update($update);
        return redirect()->back()->with('success', 'Status Change Successfully.');
    }

    public function itemDelete($product_id)
    {   
        try
        {
            $data = Product::where('product_id', $product_id)->first();

            if (file_exists("uploads/". $data->image)) {
                unlink("uploads/". $data->image);
            }
         
            Product::where('product_id', $product_id)->delete();
                  
            return redirect()->back()->with('success', 'Brand Delete Successfully.'); 
        }
        catch(\Exception $error){
            return redirect()
            ->back()
            ->with('delete', 'Something goes wrong. Please try again.');
        }
    }

    public function itemEdit($product_id)
    {
        $productData = Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')->where('product_id' , $product_id)->select('products.*', 'brands.brand_name')->first();
        $brandList = Brand::all();
        return view('admin.brandManagement.itemEdit')->with([
            'productData'  =>  $productData, 
            'brandList'    =>  $brandList,
        ]);
    }


    public function editItemData(Request $request)
    {
        $request->validate([
            'item_name'      => 'required|string|max:255',
            'brand_id'      => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'description'    => 'required',
            'cost_price' => 'required|integer|min:1',
            'sell_price' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ]);

        try{

            $storageOptions = ['storage64GB', 'storage128GB', 'storage256GB', 'storage512GB', 'storage1TB', 'storage2TB'];
            $storage = array_filter($request->only($storageOptions), fn($value) => $value !== null);
            $storageJson = json_encode(array_values($storage));

            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = str_replace('.', '', microtime(true)) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);

                $data = Product::where('product_id', $request->product_id)->first();

                if (file_exists("uploads/". $data->image)) {
                    unlink("uploads/". $data->image);
                }

            }
            
            $update = [
                'item_name' => $request->item_name,
                'storage' => $storageJson,
                'cost_price' => $request->cost_price,
                'sell_price' => $request->sell_price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'brand_id' => $request->brand_id,
            ];
            
            if (isset($imageName)) {
                $update['image'] = $imageName;
            }
            
            Product::where('product_id', $request->product_id)->update($update);

            return redirect()
            ->back()
            ->with('success', 'Item update successfully.');

        }
        catch(\Exception $error){
            return redirect()
            ->back()
            ->with('delete', 'Something goes wrong. Please try again.');
        }

    }

    public function searchProducts(Request $request)
    {
        // Start the query with the base data join
        $query = Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')
                        ->select('products.*', 'brands.brand_name');
    
        // Filter by item name (only apply filter if item_name is provided)
        if ($request->has('item_name') && $request->item_name) {
            $query->where('products.item_name', 'like', '%' . $request->item_name . '%');
        }
    
        // Filter by brand ID (only apply filter if brand_id is provided)
        if ($request->has('brand_id') && $request->brand_id) {
            $query->where('products.brand_id', $request->brand_id);
        }
    
        // Filter by status (only apply filter if status is provided)
        if ($request->has('status') && $request->status !== null) {
            $query->where('products.status', $request->status);
        }
    
        // Filter by price range (only apply filter if price values are provided)
        if ($request->has('startAmount') && $request->startAmount) {
            $query->where('products.sell_price', '>=', $request->startAmount);
        }
    
        if ($request->has('endAmount') && $request->endAmount) {
            $query->where('products.sell_price', '<=', $request->endAmount);
        }
    
        // Filter by date range (only apply filter if dates are provided)
        if ($request->has('startDate') && $request->startDate) {
            $query->where('products.created_at', '>=', $request->startDate);
        }
    
        if ($request->has('endDate') && $request->endDate) {
            $query->where('products.created_at', '<=', $request->endDate);
        }
    
        // Fetch the filtered product list
        $productList = $query->get();
    
        // Return a JSON response with the filtered data
        return response()->json([
            'status' => 'success',
            'data' => $productList
        ]);
    }
    

}
