<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shipping;
use App\Model\Mallsouryou;
use DB;


class ShippingController extends Controller
{
   public function index()
   {
     $companies=Shipping::where('bango',5)->get();

     $detail=[];
     $kens=\Config('ken');

       foreach ($companies as $key => $value) {

         $t_data=Mallsouryou::where('kenmei','一律')->first();

        if ($t_data!=null) {
          $detail['normal_price']=$t_data->souryou0;
          $detail['frozen_price']=$t_data->souryou1;
          $detail['cold_price']=$t_data->souryou2;
        }else{
          $detail['normal_price']=null;
          $detail['frozen_price']=null;
          $detail['cold_price']=null;
        }
        $detail['name']=$value->mallsoukobango1;
        $detail['normal_ok']='1';
        $detail['frozen_ok']=$value->point1;
        $detail['cold_ok']=$value->point2;
        $detail['cash_on_delivery']=number_format($value->souryougenkai);
        $detail['delivery_duration']=$value->mallsoukobango2;
        $detail['delivery_time']=$value->yobi13;
       }


     return view('Admin.Shipping.index',compact('kens','detail','companies'));
   } 
   
   public static function read_detail(Request $request)
    {

     $company=$request['company'];
     $shipping=Shipping::where('bango',$company)->first();

     $t_data=Mallsouryou::where('kenmei','一律')->first();
     $ken_data=Mallsouryou::orderBy('ken')->get();

     $detail['name']=$company;
     $detail['normal_ok']='1';
     $detail['normal_price']=isset($t_data->souryou0)?$t_data->souryou0:null;
     $detail['cash_on_delivery']=$shipping->souryougenkai;
     $detail['delivery_duration']=$shipping->mallsoukobango2;
     $detail['delivery_time']=$shipping->yobi13;
    

     return json_encode([$detail,$ken_data]);
   }

   public static function insert(Request $request){
     $data=$request->all();
     $kokyaku1_one=Shipping::find(5);

     $mallsoukobango1=$kokyaku1_one->mallsoukobango1;
 
        DB::beginTransaction();
        try {
         
           $shipping = [];

           $shipping['souryougenkai']=$data['cash_on_delivery_fee'];
           if ($data['duration_date']=='1') {
             $shipping['mallsoukobango2']=$data['day_from'].'/'.$data['day_to'];
           }else{
             $shipping['mallsoukobango2']=null;
           }
           if ($data['delivery_time']=='1') {
             
             $last_key=array_key_last($data['from']);
             $str='午前中';
             foreach($data['from'] as $key=>$val)
             {
              if ($val!=null OR $val!='') {
                $str.= '/'.$data['from'][$key].'時〜'.$data['to'][$key].'時';
              }
              
             }

             $shipping['yobi13']=$str;
           }else{
              $shipping['yobi13']=null;
           }

           $update=DB::table('kokyaku1')
                      ->where('bango', 5)
                      ->update($shipping);
  
           if (isset($data['normal_temp']) && $data['normal_temp']=='一律') {
              $normal=$data['normal_temp_price'];
           }else{$normal=null;}


           if ((isset($data['normal_temp']) && $data['normal_temp']='一律')) {
             Mallsouryou::updateOrCreate(
                  ['kenmei' => '一律'],
                  ['ken' => 48, 'souryou0' => $normal]
              );
           }else{
       
             Mallsouryou::where('kenmei','一律')->delete();
           }
              
           $i=0;

           foreach($data['normal'] as $key=> $value){

              $normal=$data['normal'][$key];
              $i++;

              Mallsouryou::updateOrCreate(
                  ['kenmei' => $key],
                  ['ken' => $i, 'souryou0' => $normal]
              );

           }
     

           DB::commit();
           return 'ok';
        } catch (\Exception $ex) {
            DB::rollback();

            return $errors;
        }

   }
}
