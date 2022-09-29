<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\SaleOff;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSaleOffController extends Controller
{

    public function index($data = NULL)
    {
        $saleoffs = DB::table('saleoffs')->paginate(5);
        if ($data != NULL) $data = array_merge($data, ['saleoffs' => $saleoffs]);
        else $data = (['saleoffs' => $saleoffs]);
        return view('admin.saleoff.index', $data);
    }

    public function create(Request $request)
    {
        return view('admin.saleoff.create');
    }

    public function store(Request $request)
    {
        //// 
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $saleoff = new SaleOff;
        $saleoff->timestamps = false;

        $saleoff->name = $request->name;

        if ($request->boolean('price_check')) {
            $saleoff->amount = $request->price_amount;
            $saleoff->percent = 0;
        } else {
            $saleoff->amount = 0;
            $saleoff->percent = $request->price_percent;
        }

        if (strcmp($request->saleoff_starttime, $request->saleoff_endtime) < 0) {
            $saleoff->starttime = $request->saleoff_starttime;
            $saleoff->endtime = $request->saleoff_endtime;
        } else {
            return back()->withInput()->withErrors([
                'saleoff_endtime' => 'Thời gian kết thúc KM phải lớn hơn thời gian bắt đầu',
            ]);
        }
        echo view('tested', ['msg' => $saleoff->starttime . $saleoff->endtime]);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $saleoff->name)) . '-' . time() . '.' . $file->extension();
            $file->storeAs('public/saleoff/banners', $name);

            $saleoff->imageurl = $name;
        } else {
            $saleoff->imageurl = "";
        }

        $saleoff->save();

        $last_inserted = $saleoff->id;

        return redirect()->route('admin.saleoff')->withErrors(['success' => 'Đã tạo thành công CTKM ' . $saleoff->name . '.']);
    }

    public function edit($saleoff)
    {
        $sf = SaleOff::where('id', $saleoff)->first();
        if (!$sf) return $this->notFound();
        $data = ([
            'saleoff' => $sf,
        ]);
        return view('admin.saleoff.edit', $data);
    }

    public function update(Request $request, $saleoff)
    {
        //
    }

    public function destroy($saleoff)
    {
        //
    }
}
