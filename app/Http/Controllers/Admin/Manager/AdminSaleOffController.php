<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\SaleOff;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

class AdminSaleOffController extends Controller
{
    
    public function index($data=NULL)
    {
        $saleoffs = DB::table('saleoff')->paginate(5);
        if($data!=NULL) $data = array_merge($data,['saleoffs' => $saleoffs]);
        else $data = (['saleoffs' => $saleoffs]);
        return view('admin.saleoff.index', $data);
    }

    public function create($request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // $this->validate($request, [
        //     'filenames' => 'required',
        //     'filenames.*' => 'required'
        // ]);

        // $files = [];
        // if($request->hasfile('images'))
        // {
        //     foreach($request->file('images') as $file)
        //     {
        //         $name = time().rand(1,100).'.'.$file->extension();
        //         $file->move(public_path('files'), $name);  
        //         $files[] = $name;  
        //     }
        // }

        // $file= new Image();
        // $file->filenames = $files;
        // $file->save();

        // return back()->with('success', 'Data Your files has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOff $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOff $product)
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
    public function update(UpdateProductRequest $request, SaleOff $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOff $product)
    {
        //
    }
}
