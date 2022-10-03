<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SaleOff;
use stdClass;

class AdminProductController extends Controller
{
    
    public function index($data=NULL)
    {
        $products = DB::table('products')->paginate(5);
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

    public function create()
    {
        $data = ([
            'saleoffs' => SaleOff::all(),
        ]);
        return view('admin.product.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'detail' => 'max:5000',
        ]);
        
        $product= new Product();
        $product->timestamps = false;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = ($request->detail!=NULL)?$request->detail:"";
        $product->saleoff_id = ($request->saleoff<0)?0:$request->saleoff;
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

    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if($product){
            $data=([
                'saleoffs' => SaleOff::all(),
                'product' => $product,
            ]);

            // return view('tested', ['msg'=>'right']);    
            return view('admin.product.edit', $data);
        }
        return $this->notFound();
        return view('tested', ['msg'=>'error']);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy($p)
    {
        $product = Product::find($p);
        
        // delete images
        if($product->images != ""){
            $files = array_filter(
                glob(
                    storage_path(
                        'app/public/products/'.$product->id.'/*'
                    )
                ),
                "is_file"
            );
            foreach($files as $file) unlink($file); // delete files

            rmdir(storage_path(
                'app/public/products/'.$product->id
            ));
        }
        // return view('tested', ['msg'=>$product]);
        // delete record from database
        $product->delete();
        unset($product);
        return redirect()->route('admin.product')->withErrors(['success' => 'Đã xóa 1 SP']);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products_data = DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            if ($products_data) {
                foreach ($products_data as $item) {
                    $output .= '<tr><td>'.$item->id.'</td><td>';
                    if(getImageAt($item->images, 0))
                      $output.= '<img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 1 / 1;" src="'.getImageAt($item->images, 0).'">';
                    $output.='</td><td>'.$item->name.'</td><td>'.number_format($item->price, 0, ',', '.').'đ</td><form id="item-'.$item->id.'-destroy-form" method="POST" action="'.route('admin.product.destroy',$item->id).'" hidden>'.csrf_token().'@method(\'delete\')</form>';
                    $item_saleoff = SaleOff::where('id', $item->saleoff_id)->first();
                    $output .= '<td uk-tooltip="';
                    if($item_saleoff->amount != 0)
                      $output .= $item_saleoff->amount;
                    else
                      $output .= $item_saleoff->percent;
                    $output .= '">'.$item_saleoff->name.'</td><td><button form="item-'.$item->id.'-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
                    <td><button form="item-'.$item->id.'-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td></tr>';
                }
            }
            return Response($output);
        }
    }
}
