<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Models\Code;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Exportable;
class ExportCodeController extends Controller implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        $orders = Code::all();
        foreach ($orders as $row) {
            $i=null;
            $role = $row->role;
            if($role==0){
                $i='Giảm bằng tiền mặt';
            }elseif($role==1){
                $i='Giảm theo phần trăm';
            }
            $order[] = array(
                '0' => $row->id,
                '1' => $row->code,
                '2' => $row->amount,
                '3' => $i,
                '4' => $row->use_time,
                '5' => $row->end_time,
               
             
                
            );
        }

        return (collect($order));
    }

    public function headings(): array
    {
        return [
            'id',
            'Mã giảm giá',
            'Số lượng giảm',
            'Hình thức giảm',
            'Số lượt sử dụng',
            'Thời gian hết hạn'
           
        ];
    }

    public function export(){
        return Excel::download(new ExportCodeController(), 'ma-giam-gia.xlsx');
   }
    
}
