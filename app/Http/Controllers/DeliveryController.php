<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\models\District;
use App\models\Ward;
use App\models\Feeship;
use App\Models\SliderModel;

class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {
        $province = Province::orderby('matp', 'ASC')->get();

        return view('admin.delivery.add_delivery')->with(compact('province'));
    }
    public function selete_delivery(request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output ='';
            if ($data['action'] == 'province') {
                $selete_district =  District::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                    $output.='<option >Select</option>';
                foreach ($selete_district as $key => $district) {
                    $output.= '<option value="'.$district->maqh.'">'.$district->name_quanhuyen.'</option>';
                }
            } else {
                $selete_wards =  Ward::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                    $output.='<option >Select</option>';
                foreach ($selete_wards as $key => $wards) {
                    $output.= '<option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function insert_delivery(Request $request) {
        $data = $request->all();
        $fee_ship = new FeeShip();
        $fee_ship->fee_matp = $data['province'];
        $fee_ship->fee_maqh = $data['district'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];

        $fee_ship->save();
    }
    public function selete_feeship() {
        $feeship = FeeShip::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th>Province/City</th>
                            <th>District/City</th>
                            <th>Wards</th>
                            <th>Fee Ship</th>
                        </tr>
                    </thread>
                    <tbody>';
                    foreach ($feeship as $key => $value) {
        $output .= '    <tr>
                            <td>'.$value->Province->name_city.'</td>
                            <td>'.$value->District->name_quanhuyen.'</td>
                            <td>'.$value->Ward->name_xaphuong.'</td>
                            <td contenteditable data-feeship_id="'.$value->fee_id.'" class="fee_feeship_edit">'.number_format($value->fee_feeship).'</td>
                        </tr>';
                    }
        $output .= '  </tbody>
                </table> </div>';
        echo $output;
    }
    public function update_feeship(request $request){
        $data = $request->all();
        $fee_ship =  FeeShip::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], ',');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
