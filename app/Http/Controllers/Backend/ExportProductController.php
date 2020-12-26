<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Exportable;
class ExportProductController extends Controller implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        $orders = Product::all();
        foreach ($orders as $row) {
            $price =$row->price;
            $promotion =$row->promotion;
            $order[] = array(
                '0' => $row->id,
                '1' => $row->name,
                '2' => $row->quantity,
                '3' => $price*1000,
                '4' => $promotion*1000,
               
                // '5' => $i,
                // '6'=>$j,
                // '7'=>$row->dob,
                
            );
        }

        return (collect($order));
    }

    public function headings(): array
    {
        return [
            'id',
            'Tên sản phẩm',
            'Số lượng sản phẩm',
            'Giá bán(VND)',
            'Giá khuyến mãi(VND)',
            // 'Vai trò',
            // 'Giới tính',
            // 'Ngày sinh',
        ];
    }

    public function export(){
        return Excel::download(new ExportProductController(), 'san-pham.xlsx');
   }
    
}
