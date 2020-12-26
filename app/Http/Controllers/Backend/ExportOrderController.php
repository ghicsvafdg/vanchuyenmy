<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Exportable;
class ExportOrderController extends Controller implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        $orders = Order::all();
        foreach ($orders as $row) {

            $order[] = array(
                '0' => $row->id,
                '1' => $row->order_code,
                '2' => $row->name,
                '3' => $row->phone,
                '4' => $row->address,
               
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
            'Mã đơn hàng',
            'Họ tên khách hàng',
            'Số điện thoại',
            'Địa chỉ',
            // 'Vai trò',
            // 'Giới tính',
            // 'Ngày sinh',
        ];
    }

    public function export(){
        return Excel::download(new ExportOrderController(), 'don-hang.xlsx');
   }
    
}
