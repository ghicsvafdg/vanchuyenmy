<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Exportable;
class ExportController extends Controller implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        $orders = User::all();
        foreach ($orders as $row) {
            $i=null;
            $j=null;
            $role = $row->role;
            if($role==0){
                $i='Quản trị';
            }elseif($role==1){
                $i='Người dùng';
            }

            $gender = $row->gender;
            if($gender==0){
                $j='Nam';
            }elseif($role==1){
                $j='Nữ';
            }

            $order[] = array(
                '0' => $row->id,
                '1' => $row->username,
                '2' => $row->email,
                '3' => $row->name,
                '4' => $row->phone,
               
                '5' => $i,
                '6'=>$j,
                '7'=>$row->dob,
                
            );
        }

        return (collect($order));
    }

    public function headings(): array
    {
        return [
            'id',
            'Tên đăng nhập',
            'Email',
            'Họ Tên',
            'Số điện thoại',
            'Vai trò',
            'Giới tính',
            'Ngày sinh',
        ];
    }

    public function export(){
        return Excel::download(new ExportController(), 'nguoi-dung.xlsx');
   }
    
}
