<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\SaleOff;

class AdminProductController extends Controller
{
    
    public function index($data=NULL)
    {
        
        $products = DB::table('products')->paginate(5);
        $saleoffs = DB::table('saleoffs');

        if($data!=NULL) 
            $data = array_merge($data,[
                'products' => $products, 
                'saleoffs' => SaleOff::all(),
            ]);
        else 
            $data = ([
                'products' => $products,
                'saleoffs' => SaleOff::all(),
            ]);
        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ([
            'saleoffs' => SaleOff::all(),
        ]);
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'detail' => 'string|max:500',
        ]);

        
        $product= new Product();
        $product->timestamps = false;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->saleoff_id = $request->saleoff;
        $product->images = "";
        
        $product->save();

        if($request->has('images')){
            $count = 1;
            $files = [];
            foreach($request->file('images') as $file)
            {
                $name = $count.preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $product->name)) . '-' . time() . '.' . $file->extension();
                $file->storeAs('public/products/'.$product->id.'/', $name);
                $name = asset('storage/products/'.$product->id).'/'.$name;
                $files[] = $name;
                $count++;
                
            }
            
            $product->images = $files;
            // return view('tested', ['msg'=>$count.'.'.$product->name.'.'.$f ]);
        }else {
            // make imageurl null if there's no banner
            $product->images = "";
        }
        
        $product->save();
        return back()->withInput()->withErrors(['success'=> 'Sản phẩm đã được thêm']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
