<?php
use App\Models\SaleOff;

if (!function_exists('getImageAt')) {
    function getImageAt($array, $position)
    {
        if($array)
        return json_decode(str_replace('\\','',$array))[$position];
        return NULL;
    }
}

if (!function_exists('getCollection')){
    function getCollection($array) {
        $output = '<div style="width:10rem; height:5rem;overflow: hidden" uk-slider="center:true; finite :true; ">';
        $output .= '<ul class="uk-grid uk-slider-items uk-child-width-1-1">';
        if($array){
            $js = json_decode(str_replace('\\','',$array));
            foreach ($js as $item){
                $output .= '<li><img style="object-fit: cover;width:10rem; height:5rem;" src="'. $item . '"></li>';
            }
        }
        $output .= '</ul></div>';
        return $output;
    }
} 

// function products_table_row($item){
//     $output = '<tr>';
//     $output .= '<td>'.$item->id.'</td>';
//     $output .= '<td>' . getCollection($item->images) . '</td>';
//     $output .= '<td>' . $item->name . '</td>';
//     $output .= '<td>' . number_format($item->price, 0, ',', '.') . 'đ</td>';
//     $output .= '<form id="item-' . $item->id . '-destroy-form" method="POST" action="' . route('admin.product.destroy',$item->id) . '" hidden><input type="hidden" name="_token" value="'. csrf_token() .'" /> <input type="hidden" name="_method" value="delete"></form>';
//     $output .= '<form id="item-' . $item->id . '-edit-form" method="GET" action="' . route('admin.product.edit',$item->id) . '" hidden></form>';
//     $item_saleoff = SaleOff::where('id', $item->saleoff_id)->first();
//     $output .= '<td class="uk-text-truncate" uk-tooltip="';
//     if(isset($item_saleoff->amount)){
//         $output .= 'Giảm';
//         if($item_saleoff->amount != 0){
//             $output .= number_format($item_saleoff->amount, 0, ',', '.').'đ';
//         } else { 
//             $output .= $item_saleoff->percent.'%';
//         }
//     }
//     $output .= '">';
//     if(isset($item_saleoff->name))$output .= $item_saleoff->name;
//     $output.= '</td>';
//     $output .= '<td><button form="item-' . $item->id . '-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>';
//     $output .= '<td><button form="item-' . $item->id . '-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>';
//     $output .= '</tr>';

//     return $output;
// }

// function products_table($products){
//     $o = '<div uk-grid class="uk-flex-between uk-margin-small">';
// 	$o.= json_decode($products)->links();
// 	$o.= '<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm sản phẩm mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>';
//     $o.= '<form hidden id="create-form" action="' . route('admin.product.create') . '" method="GET"><input type="hidden" name="_token" value="'. csrf_token() .'" /></form>';
//     $o.= '</div>';
//     $o.= '<div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">';
//     $o.= '<div class="uk-overflow-auto">';
//     $o.= '<table class="uk-table uk-table-middle uk-table-divider">';
//     $o.='<thead>';
//     $o.='<tr>';
//     $o.='<th class="uk-table-shrink">ID</th>';
//     $o.='<th class="uk-width-small"></th>';
//     $o.='<th>Tên SP</th>';
//     $o.='<th class="uk-width-small" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Gia</th>';
//     $o.='<th class="uk-width-small" uk-tooltip="Chương trình KM đang áp dụng">KM</th>';
//     $o.='<th class="uk-table-shrink">Sửa</th>';
//     $o.='<th class="uk-table-shrink">Xóa</th>';
//     $o.='</tr>';
//     $o.='</thead>';
//     $o.='<tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;">';
//     foreach ($products as $item)
//         $o.= products_table_row($item);
//     $o.='</tbody>';
//     $o.='</table>';
//     $o.='</div>';
//     $o.='</div>';

//     return $o;
// }

if (!function_exists('unified_format')) {
    function unified_format($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
    
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }
}

// if(!function_exists('category')){
//     function category($categories, $parent_id = 0, $char= '')
//     {
//         $html = '';

//         foreach ($categories as $key => $item) {
//             if ($item->parent_id == $parent_id){
//                 $html .= '
//                 <tr>
//                     <td> '. $item->id .' </td>
//                     <td> '.$char. $item->name .' </td>
//                     <td> '.active($item->status) .' </td>
//                     <td> '. $item->updated_at .' </td>
//                     <td>
//                         <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'.$item->id.'">
//                             <i class="fa-solid fa-pen-to-square"></i>
//                         </a>

//                         <a href="#" class="btn btn-danger btn-sm"
//                             onclick="removeRow('.$item->id.',\'/admin/menus/destroy\')">
//                         <i class="fa-solid fa-trash"></i>
//                         </a>
//                     </td>
//                 <tr>
//                 ';

//                 unset($item[$key]);

//                 // $html .= self::menu($categories, $item->id, $char.'|---');
//                 $html .= category($categories, $item->id, $char.$item->name.' => ');
//             }
//         }

//         return $html;
//     }
// }

// function active($active = 0) : string
// {
//     return $active == 0 ? '<span class = "btn btn-danger btn-xs">NO</span>'
//             :'<span class = "btn btn-success btn-xs">YES</span>' ;
// }

if(!function_exists('category')){
    function numToText($amount)
    {
            if($amount <=0)
            {
                return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
            }
            $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
            $TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
            $textnumber = "";
            $length = strlen($amount);
        
            for ($i = 0; $i < $length; $i++)
            $unread[$i] = 0;
        
            for ($i = 0; $i < $length; $i++)
            {              
                $so = substr($amount, $length - $i -1 , 1);               
            
                if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                    for ($j = $i+1 ; $j < $length ; $j ++)
                    {
                        $so1 = substr($amount,$length - $j -1, 1);
                        if ($so1 != 0)
                            break;
                    }                      
                        
                    if (intval(($j - $i )/3) > 0){
                        for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                            $unread[$k] =1;
                    }
                }
            }
        
            for ($i = 0; $i < $length; $i++)
            {       
                $so = substr($amount,$length - $i -1, 1);      
                if ($unread[$i] ==1)
                continue;
            
                if ( ($i% 3 == 0) && ($i > 0))
                $textnumber = $TextLuythua[$i/3] ." ". $textnumber;    
            
                if ($i % 3 == 2 )
                $textnumber = 'trăm ' . $textnumber;
            
                if ($i % 3 == 1)
                $textnumber = 'mươi ' . $textnumber;
            
            
                $textnumber = $Text[$so] ." ". $textnumber;
            }
        
            //Phai de cac ham replace theo dung thu tu nhu the nay
            $textnumber = str_replace("không mươi", "lẻ", $textnumber);
            $textnumber = str_replace("lẻ không", "", $textnumber);
            $textnumber = str_replace("mươi không", "mươi", $textnumber);
            $textnumber = str_replace("một mươi", "mười", $textnumber);
            $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
            $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
            $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
        
            // return ucfirst($textnumber." đồng chẵn");
            return ucfirst($textnumber);

    }
}

