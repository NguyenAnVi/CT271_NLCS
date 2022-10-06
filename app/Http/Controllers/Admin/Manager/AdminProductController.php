<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SaleOff;

class AdminProductController extends Controller
{
	public function index($data=NULL)
	{
		$products = Product::paginate(5);
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
		return back()->withErrors(['success'=> 'Sản phẩm đã được thêm']);
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

	public function update(Request $request,$p)
	{
		// find object
		$product = Product::find($p);

		// create Product object and append data:
		// disable timestamp adding:
		$product->timestamps = false;

		//affect count
		$prop = 0;

		if($request->has('name_check')){
			// validate NAME
			$this->validate($request, [
				'name' => 'required|string',
			]);
			$product->name = $request->name;
			$prop ++;
		}

		if($request->has('price_check')){
			$this->validate($request, [
				'price' => 'required',
			]);
			if($request->price > 0){
				$product->price = $request->price;
				$prop ++;
			} else {
				return back()->withErrors([
					'price' => 'Giá bán phải lớn hơn 0đ',
				]);
			}
		}

		if($request->has('detail_check')){
			$this->validate($request, [
				'detail', 'string|max:5000',
			]);
			$product->detail = $request->detail;
			$prop ++;
		}

		if($request->has('saleoff_check')){
			if($request->saleoff > 0){
				$product->saleoff_id = $request->saleoff;
				$prop ++;
			} else {
				return back()->withErrors([
					'saleoff' => 'Saleoff không hợp lệ',
				]);
			}
		}

		if($request->has('images_check')){
			// 1. delete old images
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

			// 2. add new images
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
			}else {
				// make imageurl null if there's no banner
				$product->images = "";
			}
			
			
			$prop++;
		}
		if($prop)$product->save();
		return redirect()->route('admin.product')->withErrors(['success' => $prop.' thuộc tính đã thay đổi.']);
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
		// if ($request->ajax()) {
		// 	$output = '';
		// 	$products_data = DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get();
		// 	if ($products_data) {
		// 		foreach ($products_data as $item) {
		// 			$output .= '<tr><td>'.$item->id.'</td><td>';
		// 			if(getImageAt($item->images, 0))
		// 			  $output.= '<img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 1 / 1;" src="'.getImageAt($item->images, 0).'">';
		// 			$output.='</td><td>'.$item->name.'</td><td>'.number_format($item->price, 0, ',', '.').'đ</td><form id="item-'.$item->id.'-destroy-form" method="POST" action="'.route('admin.product.destroy',$item->id).'" hidden>'.csrf_token().'@method(\'delete\')</form>';
		// 			$item_saleoff = SaleOff::where('id', $item->saleoff_id)->first();
		// 			$output .= '<td uk-tooltip="';
		// 			if($item_saleoff->amount != 0)
		// 			  $output .= $item_saleoff->amount;
		// 			else
		// 			  $output .= $item_saleoff->percent;
		// 			$output .= '">'.$item_saleoff->name.'</td><td><button form="item-'.$item->id.'-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
		// 			<td><button form="item-'.$item->id.'-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td></tr>';
		// 		}
		// 	}
		// 	return Response($output);
		// }
		// if ($request->ajax()) {
		// 	$o =[];
		// 	$products = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
		// 	if ($products) {
		// 		$o .='<div uk-grid class="uk-flex-between uk-margin-small">';
		// 		$o .=$products->links();
		// 		$o .='<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm sản phẩm mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button><form hidden id="create-form" action="'.route('admin.product.create').'" method="GET"><input type="hidden" name="_token" value="'.csrf_token().'"</form></div>';
		// 		$o .='<div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">';
		// 		$o .='<div class="uk-overflow-auto">';
		// 		$o .='<table class="uk-table uk-table-middle uk-table-divider">';
		// 			$o .='<thead>							<tr>';
		// 				$o .=	'<th class="uk-table-shrink">ID</th>';
		// 					$o .='	<th class="uk-width-small"></th>';
		// 				$o .='	<th>Tên SP</th>					<th class="uk-width-small" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Giá</th>';
		// 			$o .=	'<th class="uk-width-small" uk-tooltip="Chương trình KM đang áp dụng">KM</th>';
		// 					$o .=	'<th class="uk-table-shrink">Sửa</th>';
		// 					$o .=	'<th class="uk-table-shrink">Xóa</th>';
		// 					$o .=	'</tr>';
		// 					$o .='</thead>';
		// 				$o .='<tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;">';
		// 			foreach ($products as $item){
		// 				//@include('partials/productTableRow', ['item'=> $item])
		// 				$o .= '<tr><td>'.$item->id.'</td><td>'.getCollection($item->images).'</td><td>'.$item->name.'</td><td>'.number_format($item->price, 0, ',', '.').' đ</td><form id="item-'.$item->id.'-destroy-form" method="POST" action="'.route('admin.product.destroy',$item->id).'" hidden><input type="hidden" name="_token" value="'.csrf_token().'"> <input type="hidden" name="method" value="delete"></form>
		// 				<form id="item-'.$item->id.'-edit-form" method="GET" action="'.route('admin.product.edit',$item->id).'" hidden></form>';
		// 				$item_saleoff = SaleOff::where('id', $item->saleoff_id)->first();
		// 				$o .= '<td class="uk-text-truncate" uk-tooltip="';
		// 				if(isset($item_saleoff->amount)){
		// 					$o .= 'Giảm';
		// 					if($item_saleoff->amount != 0){
		// 						$o.= number_format($item_saleoff->amount, 0, ',', '.').' đ';
		// 					} else {
		// 						$o.= $item_saleoff->percent.'%';
		// 					}
		// 				}
		// 				$o.='">';
		// 				if(isset($item_saleoff->name)){
		// 					$o.=$item_saleoff->name;
		// 				}
		// 				$o.='</td><td><button form="item-'.$item->id.'-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
		// 				<td><button form="item-'.$item->id.'-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>
		// 				</tr>';
		// 			}
		// 			$o .= '</tbody></table></div></div>';
		// 			error_log($o);
		// 	}
		// 	return Response(json_encode($o));
		// }
		// if ($request->ajax()!== NULL) {
		//     $output = [];
		//     $products_data = DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get();
		//     if ($products_data) {
		//         foreach ($products_data as $item) {
		//             $output = array_merge($output, [$item]);
		//         }
		//     }
		//     return Response(json_encode($output));
		// }
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
		
	}

	public function removeSaleoff($saleoff_id){
		$check = 0;
		$products = Product::where('saleoff_id', $saleoff_id)->get();
		foreach ($products as $item){
			$item->timestamps = false;
			$item->saleoff_id = 1;
			$item->save();
			$check++;
		}
		return $check;
	}
}
