<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
	protected $categoryService;

	public function __construct(CategoryService $categoryService)
	{
		$this->categoryService = $categoryService;
	}

	public function getAll($pages = 0)
    {
        if($pages == 0)
            return Category::orderby('id', 'asc')->get();
        else
            return Category::orderby('id', 'asc')->paginate($pages);
    }

	public function create()
	{
		return view('admin.layouts.create', [
			'categories' => $this->getAll(),
			'title' => 'Thêm danh muc',
			'formView' => 'admin.manager.category.categoryAddForm',
		]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'detail' => 'max:5000',
		]);
		try{
			$category = new Category();
			$category->timestamps = false;
			$category->name = $request->name;
			$category->parent_id = $request->parent_id;
			$category->detail = (!$request->detail)?(''):$request->detail;
			$category->status = ($request->status)?(1):(0);
			$category->save();

			return back()->withInput()->withErrors(['success'=> 'Tạo danh mục thành công']);

		}catch (\Exception $err){
			//session::flash('error',$err->getMessage());
			return back()->withInput()->withErrors(['danger'=> 'Tạo danh mục không thành công: '.$err->getMessage()]);
		}

		return true;
		return back()->withInput()->withErrors(['danger'=> 'Tạo danh mục không thành công']);
	}

	public function index()
	{
		return view('admin.layouts.index',[
			'collection' => $this->getAll(5),
			'title' => 'Danh sách các danh mục',
			'createRoute' => route('admin.category.create'),
			'tableView' => 'admin.manager.category.categoryTable',
		]);
	}

	public function edit($id)
	{
		$category = Category::find($id);
		if($category)
			return view('admin.layouts.edit',[
				'category' => $category,
				'categories' => $this->categoryService->getParent(),
				'title' => 'Thay đổi thông tin danh mục',
				'formView' => 'admin.manager.category.categoryEditForm',
			]);
		else return back()->withErrors(['warning'=>'Khong tim thay ID']);
	}

	public function update($id, Request $request)
	{
			$category = Category::find($id);
			$prop = 0;

			if($category){
				$category->timestamps = false;
				if ($request->has('name_check')){
					$this->validate($request, [
						'name' => 'required',
					], [
						'name.required' => 'Không được để trống tên danh mục.'
					]);
					$category->name = $request->name;
					$prop++;
				}

				if ($request->has('parent_id_check')){
					if(Category::find($request->parent_id) === NULL)
						return back()->withErrors(['parent_id.exists' => 'Danh mục cha đã chọn không có trong cơ sở dữ liệu.']);
					$category->parent_id = $request->parent_id;
					$prop++;
				}

				if ($request->has('detail_check')){
					$this->validate($request, [
						'detail' => 'max:5000',
					], [
						'detail.max' => 'Số lượng kí tự tối đa không vượt quá :max',
					]);
					$category->detail = $request->detail;
					$prop++;
				}

				if ($request->has('status_check')){
					$category->status = ($request->status==1)?(1):(0);
					$prop++;
				}
				try{
					$category->save();
				} catch(\Exception $e){
					return back()->withInput()->withErrors(['danger'=> 'Có lỗi xảy ra khi đang lưu thay đổi lên cơ sở dữ liệu ('.$e->getMessage().')']);
				}
				// Update successfully
			}
			else{
				return back()->withErrors([
					'danger' => 'Khong tim thay ID',
				]);
			}
			return back()->withErrors(['success'=>'Thay đổi thành công ('.$prop.' thuộc tính)']);
	}

	public function destroy(Request $request): JsonResponse
	{
		$result = $this->categoryService->destroy($request);
		if ($result){
			return response()->json([
				'error' => false,
				'message' => 'Xóa thành công danh mục'
			]);
		}

		return response()->json([
			'error' => true
		]);
	}

	public function switchstatus( Request $request)
	{
		if ($request->ajax()) {
			$c = Category::find($request->id);
			$c->timestamps = false;
			$c->status = ($c->status==0)?(1):(0);
			$c->save();
			return Response((checkStatus(intval($c->id), intval($c->status))));  
			// return Response('thanh cong');
		}
	}

	public function search (Request $request){
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('categories')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}