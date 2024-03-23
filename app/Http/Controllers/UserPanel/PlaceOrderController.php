<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Session;
use App\AllClass\Furigana;
use App\AllClass\SpecialCharValidation;
use App\Model\Category;
use App\Model\Kaiin;
use App\Model\Haisou;
use App\Model\Orderhenkan;
use App\Model\Tuhanorder;
use App\Model\Hikiatesyukko;
use App\Model\Misyukko;
use App\Model\Kokyaku1;
use App\Model\Kokyaku3;
use App\Model\Toiawasebango;
use App\Model\Product;
use App\Model\Product3;
use App\Model\Zaiko;
use DateTime;
use DB;
use Cart;
use Storage; 
use Mail;
use App\Mail\ContactMail;
date_default_timezone_set('Asia/Tokyo');

class PlaceOrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        session()->forget('transaction_err_msg');
        //stock check
        $stock = self::checkStock();
        if(count($stock) > 0){
            $result['status'] = "stock_out";
            return $result;
        }
            
        $input = $request->all();
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        if(Session::has('userlogin')){
            $kaiin_id = Session::get('userlogin')['login_bango'] ;
        }else{
            $kaiin_id = null;
        }
        $result = [];
        
        $rules=[];
        $rules['name'] = ['required',new SpecialCharValidation];
        $rules['furigana'] = ['bail','nullable','max:50','regex:/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ]+)$/u'];
        if(request('shipping_destination') != 'same'){
            $rules['email'] = ['bail','required','email'];
        }
        $rules['zipcode1'] = ['bail','required','regex:/^[0-9]+$/'];
        $rules['zipcode2'] = ['bail','required','regex:/^[0-9]+$/'];
        $rules['prefecture'] = ['required'];
        $rules['address1'] = ['bail','required','max:50',new SpecialCharValidation];
        $rules['address2'] = ['bail','required','max:50',new SpecialCharValidation];
        $rules['biladd'] = ['bail','nullable','max:50',new SpecialCharValidation];

        $rules['phone'] = ['bail','required','max:11','regex:/^[0-9]+$/'];
        if (isset($input['address_option']) && $input['address_option']=='2') {
            //$rules['receiver'] = ['required'];
            $rules['diff2_name'] = ['required',new SpecialCharValidation];
            $rules['diff2_furigana'] = ['bail','nullable','max:50','regex:/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ]+)$/u'];
            //$rules['diff2_email'] = ['bail','required','email'];
            $rules['diff2_zipcode1'] = ['bail','required','regex:/^[0-9]+$/'];
            $rules['diff2_zipcode2'] = ['bail','required','regex:/^[0-9]+$/'];
            $rules['diff2_prefecture'] = ['required'];
            $rules['diff2_address1'] = ['bail','required','max:50',new SpecialCharValidation];
            $rules['diff2_address2'] = ['bail','required','max:50',new SpecialCharValidation];
            $rules['diff2_biladd'] = ['bail','nullable','max:50',new SpecialCharValidation];
            $rules['diff2_phone'] = ['bail','required','max:11','regex:/^[0-9]+$/'];
        }

        $message=[];    
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['max']='【:attribute】:max桁以下で入力してください。';
        $message['regex']='【:attribute】半角数字以外は使用できません。';
        $message['furigana.regex']='【:attribute】カタカナ以外は使用できません。';
        $message['email']='【:attribute】有効なメールアドレスを入力してください。';

        $attributes = [
            'name' => '氏名',
            'furigana' => 'フリガナ',
            'email' => 'メールアドレス',
            'zipcode1' => '郵便番号1',
            'zipcode2' => '郵便番号2',
            'prefecture' => '都道府県',
            'address1' => '市区町村',
            'address2' => '町名番地',
            'biladd' => '建物名・部屋番号',
            'company_name' => '会社名',
            'phone' => '電話番号',
            'diff2_name' => '氏名',
            'diff2_furigana' => 'フリガナ',
            'diff2_email' => 'メールアドレス',
            'diff2_zipcode1' => '郵便番号1',
            'diff2_zipcode2' => '郵便番号2',
            'diff2_prefecture' => '都道府県',
            'diff2_address1' => '市区町村',
            'diff2_address2' => '町名番地',
            'diff2_biladd' => '建物名・部屋番号',
            //'diff2_company_name' => '会社名',
            'diff2_phone' => '電話番号',
        ];

        $validator = Validator::make($input,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }
        Session::put("shippingInformation",$input);
        $result['status'] = "ok";
        $result['user_id'] = $kaiin_id;
        return $result;
                                         
    }
    
    public function payment(Request $request)
    {

        if($request->method() == "POST"){
            //stock check
            $stock = self::checkStock();
            if(count($stock) > 0){
                return  redirect("cartItemList");
            }
        
            $input = $request->all();
          
            $order_address=$input['name'].' '.$input['zipcode1'].'-'.$input['zipcode2'].' '.$input['prefecture'].$input['address1'].$input['address2'].$input['biladd'].' '.$input['phone'];

            $send_address=(!empty($input['address_option']) && $input['address_option']=='2')?$input['diff2_name'].' '.$input['diff2_zipcode1'].'-'.$input['diff2_zipcode2'].' '.$input['diff2_prefecture'].$input['diff2_address1'].$input['diff2_address2'].$input['diff2_biladd'].' '.$input['diff2_phone']:$order_address;
   // dd($input['address_option'],$send_address);
            $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
            $brands = Category::where('groupbango','2')->where('osusume','1')->get();
            $prev_shipping_method = isset($input['shipping_method'])?$input['shipping_method']:"";
            $prev_delivery_date = isset($input['delivery_date'])?$input['delivery_date']:"";
            $prev_delivery_time = isset($input['delivery_time'])?$input['delivery_time']:"";

            $kokyaku1 = Kokyaku1::select('mallsoukobango2','yobi13','mallsoukobango1')->find(env('store'));
            $shipping_method = explode("/",$kokyaku1->mallsoukobango1);
            $start = (int) date("d") + (int) explode("/",$kokyaku1->mallsoukobango2)[0];
            $end =$kokyaku1->mallsoukobango2!=null?(int) explode("/",$kokyaku1->mallsoukobango2)[1]:null;
            $year = date("Y");
            $month = date("m");
            $lastday = date("t");
            $day = $start;
            $delivery_date=[];
            for($i = 1; $i <= $end; $i++){
                if(($day) > $lastday){
                    if($month == 12){
                        $year = $year + 1;
                        $month = 1;
                    }else{
                        $month = (int) $month + 1;
                    }
                    $delivery_date[] =  $year."-".str_pad(($month),2,0,STR_PAD_LEFT)."-"."01";
                    $day = 2;
                }else{
                    $delivery_date[] =  $year."-".str_pad(($month),2,0,STR_PAD_LEFT)."-".str_pad(($day),2,0,STR_PAD_LEFT);
                    $day++;
                }
            }
            $delivery_time = $kokyaku1->yobi13!=null?explode("/",$kokyaku1->yobi13):[];
            //Session::put("shippingInformation",$input);
            return view('UserPanel.payment',compact('categories','brands','input','shipping_method','delivery_date','delivery_time','prev_shipping_method','prev_delivery_date','prev_delivery_time','order_address','send_address')); 
        }else{
            return  redirect("checkout");
        }
    }
    
    public function orderCreate(Request $request)
    {
        
        if($request->method() == "POST"){
            $input = $request->all();
            $input['shipping_option']=DB::table('kokyaku1')->where('bango',env('store'))->first()->mallsoukobango1;
            $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
            $brands = Category::where('groupbango','2')->where('osusume','1')->get();
            $user_id = $input['user_id'];
            $haisou_bango = "";
            $order_no = "";

            if($request->ajax()){
                //stock check
                $stock = self::checkStock();
                if(count($stock) > 0){
                    $result['status'] = "stock_out";
                    return $result;
                }
        
                $rules=[];
                //$rules['shipping_option'] = ['required'];
                $rules['delivery_date'] = ['required'];
                $rules['delivery_time'] = ['required'];

                $message=[];    
                $message['required']='【:attribute】必須項目に入力がありません。';

                $attributes = [
                    'shipping_option' => '配送方法',
                    'delivery_date' => 'お届け日指定',
                    'delivery_time' => 'お届け時間帯指定',
                ];

                $validator = Validator::make($input,$rules,$message,$attributes); 
                $errors = $validator->errors();
                if($errors->any()){ 
                    $error_msgs = $errors->all();
                    return ['err_field' => $errors, 'err_msg' => $error_msgs];
                }else{

                   
                    $result['status'] = "ok";
                    $result['user_id'] = $user_id;
                    return $result;

                }
                
            }
            
            
        }else{
            return  redirect("checkout");
        }
    }
    
    public function paymentMethod(Request $request)
    {
        if($request->method() == "POST" && Cart::content()->count() != 0){
            //stock check
            $stock = self::checkStock();
            if(count($stock) > 0){
                return  redirect("cartItemList");
            }
            
            $percentage = Kokyaku3::where('bango',1)->first()->syouhizeiritu;
            $input = $request->all();
            if(!isset($input['is_transaction'])){
                //session()->forget('transaction_err_msg');
            }
            $input['shipping_option']=DB::table('kokyaku1')->where('bango',env('store'))->pluck('mallsoukobango1');
            $delivery_charge = self::calculateDeliveryCharge($input['shipping_option'],!empty($input['diff2_prefecture'])?$input['diff2_prefecture']:$input['prefecture']);
            $prev_payment_method = isset($input['payment_method'])?$input['payment_method']:"";
            $prev_price_display = isset($input['price_display'])?$input['price_display']:"";
            $prev_inquiry = isset($input['inquiry'])?$input['inquiry']:"";
            $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
            $brands = Category::where('groupbango','2')->where('osusume','1')->get();

            return view('UserPanel.paymentMethod',compact('categories','brands','input','prev_payment_method','prev_inquiry','prev_price_display','percentage','delivery_charge'));
        }else{
            return  redirect("checkout");
        }
    }
    protected function order_detail()
    {
        $str=
    "配送内容<br>
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
    ご購入日:　　　　{{today}}<br>
    決済方法:　　　　{{paymentmethod}} <br>
    お届け希望日:　　{{toiawasedate}}<br>
    お届け指定時間:　{{toiawasetime}}<br>
    納品書の価格表示: {{present_flag}}<br>
    その他お問い合わせ内容: {{message}}<br><br>
    
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br><br>
    
    ご購入内容<br>
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
    注文番号  : {{orderbangoset}} <br><br>
    ";
    foreach(Cart::content() as $row){
    $str.='
        商 品 名 :'.$row->name.'<br>'.'
        品    番 :'.$row->id.'<br>'.'
        数　　量 :'.$row->qty.'<br>'.'
        購入価格 :'.number_format($row->qty*$row->price) .' 円<br><br>';
    }
    $str.="
    ----------<br>
    商品代金合計 [購入価格の合計] 円<br>
    送料 [TuhanOrder.Money2] 円<br>
    決済手数料 [TuhanOrder.Money1] 円<br>
    ----------<br>
    金額合計 :[TuhanOrder.MoneyMax] 円<br><br>
    
    
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
    ご購入者様情報<br><br>
    
     [お　名　前］　　　{{username}}<br>
     [メールアドレス］　{{mail_address}}<br>
    -------------------------------------------------------------------------------<br>
    お届け先情報<br>
    -------------------------------------------------------------------------------<br>
     [お　名　前］　　　{{deliveryname}} <br>
     [郵便番号］　　　　{{deliverypostcode}} <br>
     [住　　所］　　　　{{deliveryiaddress}} <br>
     [電話番号］　　　  {{deliveryphone}}<br>";

     return $str;
    }
    public function paymentHistory(Request $request)
    {
        $stock = self::checkStock();
        if(count($stock) > 0){
            return  'stock_out';
        }

        if (request('payment_method')=='クレジットカード' && empty(request('webcollectToken'))) {
            $transaction_err_msg = 'クレジットカードの情報に誤りがあります。';
            session()->put('transaction_err_msg', $transaction_err_msg);
            return 'ng';
        }

        if (!empty(request('webcollectToken'))) {
            $webcollectToken=request('webcollectToken');
        }else{
            $webcollectToken=null;
        }

        return  response()->json(['settlement_charge' => request('settlement_charge'),'delivery_charge' => request('delivery_charge'),'payment_method'=>request('payment_method'),'price_display' => request('price_display'),'inquiry' => request('inquiry'),'total_amount'=>request('total_amount'),'webcollectToken'=>$webcollectToken]);
        
    }
    public function orderComplete(Request $request)
    {

        if (Storage::disk('mail')->exists('1.json')) {
            $contents = Storage::disk('mail')->get('1.json');
        }else{
            $contents = Storage::disk('mail')->get('default/1.json');
        }

        $mail_data = json_decode($contents);
        

        if($request->method() == "POST"){
            //stock check
           $stock = self::checkStock();

           if(count($stock) > 0){
               return  'stock_out';
           }
    
         $zaiko_hikiate=self::zaiko_hikiate();
         if ($zaiko_hikiate=='ng') {
             return  'stock_out';
         }else{
             $result = DB::table('zaiko_maintain_temp_table')->get();
             $zaiko = collect($result)->map(function($x){ return (array) $x; })->toArray();

         }
 
            $input = $request->all();

            if (session()->get('userlogin') && $input['email']=='') {
                $mail=DB::table('kaiin')->where('bango',session()->get('userlogin')['login_bango'])->first()->mail;
                $input['email']=$mail;
            }

            $status = 'default';
            $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
            $brands = Category::where('groupbango','2')->where('osusume','1')->get();
            $percentage = Kokyaku3::where('bango',1)->first()->syouhizeiritu;
            
            $user_id = (session()->get('userlogin'))?session()->get('userlogin')['login_bango']:null;
            //$user_id = request('user_id');
            $ordererInfo = Kaiin::select('name','kaka','mail','yubinbango','kenadd','cyouadd','biladd','model','tel')->find($user_id);
           
            $kokyaku1 = Kokyaku1::select('souryougenkai','kakakutaibango1','daibikigenkai','domain','domain2')->find(env('store'));
            $total_price = (int) str_replace(",","",Cart::total(0));
            
            //delivery charge
            if($kokyaku1->souryougenkai <= $total_price){
                $delivery_charge = 0;
            }else{
                $shipping_method = $input['shipping_method'];
                $mallsouryou = DB::table('mallsouryou')->select('souryou0')->where('kenmei','一律')->get();
                if(count($mallsouryou) > 0){
                    $delivery_charge = $mallsouryou[0]->souryou0;
                }else{
                    $prefecture = $input['prefecture'];
                    $mallsouryou2 = DB::table('mallsouryou')->select('souryou0')->where('kenmei',$prefecture)->get();
                    $delivery_charge = $mallsouryou2[0]->souryou0;
                }
            }
            
            //settlement charge
            $settlement_charge = 0;
            $payment_method = $input['payment_method'];
            if($payment_method == 'クロネコ後払い'){
                if($kokyaku1->kakakutaibango1 <= $total_price && $kokyaku1->kakakutaibango1!=null && $kokyaku1->kakakutaibango1!=''){
                    $settlement_charge = 0;
                }else{
                    $domain = $kokyaku1->domain2;
                    $domain = explode("/",$domain)[0];
                    $settlement_charge = explode("=",$domain)[1];
                }
            }elseif($payment_method == '代金引換'){
                if($kokyaku1->daibikigenkai !=null && $kokyaku1->daibikigenkai <= $total_price ){
                    $settlement_charge = 0;
                }else{
                    $domain = $kokyaku1->domain;
                    $domain = explode("=",$domain);
                    $start = 1;
                    for($key=0;$key<count($domain);$key++){
                        if($key == (count($domain) - 1)){
                            $value = explode("/",$domain[$key])[0];
                            $end = (int) explode("/",$domain[$key])[1];
                        }else{
                           $value = explode("/",$domain[$key+1])[0];
                           $end = (int) explode("/",$domain[$key+1])[1]; 
                        }
                        if($start <= $total_price && $total_price < $end){
                           $settlement_charge =  $value;
                           $start = $end;
                        }
                    }
                }
            }

            ///DB transection start//

            DB::beginTransaction();
            try {
                $orderhenkan = new Orderhenkan;
                $orderhenkan->kokyakubango = env('store');
                $orderhenkan->kokyakuorderbango = $user_id;
                $orderhenkan->orderuserbango = 'netmagician';
                $orderhenkan->date = static::getCurrentTimeWithFormat();
                $orderhenkan->ordertypebango = 111;
                $orderhenkan->save();
               
                if($user_id != "" ){
                    $kaiin_update_data = [
                        'address' =>str_replace(" ",'', $input['prefecture'])." ".str_replace(" ",'', $input['address1'])." ".str_replace(" ",'', $input['address2'])." ".str_replace(" ",'', $input['biladd']),    
                        'name' => $input['name'],
                        'kaka' => $input['furigana'],
                        'yubinbango' => $input['zipcode1'].$input['zipcode2'],
                        'kenadd' => $input['prefecture'],
                        'ciadd' => $input['address1'],
                        'cyouadd' => $input['address2'],
                        'biladd' => $input['biladd'],
                        'tel' => $input['phone'],
                    ];
                    Kaiin::where('bango',$user_id)->update($kaiin_update_data);

                }
                   
                $address = str_replace(" ",'', $input['prefecture'])." ".str_replace(" ",'', $input['address1'])." ".str_replace(" ",'', $input['address2'])." ".str_replace(" ",'', $input['biladd']);
                $yubinbango = $input['zipcode1'].$input['zipcode2'];
                $haisouData = Haisou::select('*')
                              ->where('kokyakubango',5)
                              ->where('name',$input['name'])
                              ->where('yubinbango',$yubinbango)
                              ->where('tel',$input['phone'])
                              ->where('mail',$input['email'])
                              ->where('address',$address)
                              ->get();
                
                if(count($haisouData) > 0){
                    $haisou_bango = $haisouData[0]->bango;
                    
                    $chumonsyabango = $haisou_bango;
                    $syukkomotobango = null;
      
                    $haisou1=$haisouData[0];
                }else{
                    $haisou = new Haisou;
                    $haisou->kokyakubango = env('store');
                    $haisou->address = $address;
                    $haisou->name = $input['name'];
                    $haisou->haisoumoji1 = $input['furigana'];
                    $haisou->mail = $input['email'];
                    $haisou->yubinbango = $input['zipcode1'].$input['zipcode2'];
  
                    $haisou->tel = $input['phone'];
                    $haisou->haisousuchi1 = $user_id;
                    $haisou->save();
                    //DB::commit();
                    $haisou_bango = $haisou->bango;

                    $chumonsyabango = $haisou_bango;
                    $syukkomotobango = null;
                    $haisou1=DB::table('haisou')->where('bango',$haisou_bango)->first();
                }
                if (request('address_option')=='2') {

                    $haisouData = Haisou::select('*')
                              ->where('kokyakubango',5)
                              ->where('name',$input['diff2_name'])
                              ->where('yubinbango',$input['diff2_zipcode1'].$input['diff2_zipcode2'])
                              ->where('tel',$input['diff2_phone'])
                              ->where('address',str_replace(" ",'', $input['diff2_prefecture'])." ".str_replace(" ",'', $input['diff2_address1'])." ".str_replace(" ",'', $input['diff2_address2'])." ".str_replace(" ",'', $input['diff2_biladd']))
                              ->where('haisousuchi1',$user_id)
                              ->get();
                    if (count($haisouData) > 0) {
                        $haisou_bango = $haisouData[0]->bango;
                    }else{
                        $haisou = new Haisou;
                        $haisou->kokyakubango = env('store');
                        $haisou->address = str_replace(" ",'',$input['diff2_prefecture'])." ".str_replace(" ",'', $input['diff2_address1'])." ".str_replace(" ",'', $input['diff2_address2'])." ".str_replace(" ",'', $input['diff2_biladd']);
                        $haisou->name = $input['diff2_name'];
                        //$haisou->mail = $input['diff2_email'];
                        $haisou->haisoumoji1 = $input['diff2_furigana'];
                        $haisou->yubinbango = $input['diff2_zipcode1'].$input['diff2_zipcode2'];
                       // $haisou->netuserpasswd = $input['diff2_company_name'];
                        $haisou->tel = $input['diff2_phone'];
                        $haisou->haisousuchi1 = $user_id;
                        $haisou->save(); 

                        $haisou_bango = $haisou->bango;
                    }
                      
                    $syukkomotobango = $haisou_bango;
                    
                    if ($syukkomotobango==$chumonsyabango) {
                        $syukkomotobango=null;
                    }
                  
                }

                $haisou2=$syukkomotobango==null?$haisou1:DB::table('haisou')->where('bango',$syukkomotobango)->first();

                $kokyaku1_name = Kokyaku1::where('bango',env('store'))->first()->mallsoukobango1??null;
                $toiawasebango = new Toiawasebango;
                $toiawasebango->orderbango = $orderhenkan->bango;
                if (request('address_option')=='2') {
                    $toiawasebango->syukkosakibango = $syukkomotobango!=null?$syukkomotobango:null;
                }else{
                    $toiawasebango->syukkosakibango = $chumonsyabango!=$syukkomotobango?$chumonsyabango:$syukkomotobango;
                }
                
                $toiawasebango->unsoumei = $kokyaku1_name?$kokyaku1_name:null;
                $toiawasebango->touchakudate = request('delivery_date')=='null'?NULL:request('delivery_date');
                $toiawasebango->touchakutime = request('delivery_time')=='null'?NULL:request('delivery_time');
                $toiawasebango->save();

                
                $tuhanorder = new Tuhanorder;
                $tuhanorder->orderbango = $orderhenkan->bango;
                $tuhanorder->juchubango = $orderhenkan->kokyakuorderbango;
                $tuhanorder->juchukubun1 = request('name');
                $tuhanorder->juchukubun2 = $kokyaku1_name?$kokyaku1_name:null;
                $tuhanorder->chumondate = Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s');
                $tuhanorder->otodokedate = request('delivery_date')=='null'?NULL:request('delivery_date');
                $tuhanorder->otodoketime = request('delivery_time')=='null'?NULL:request('delivery_time');
                if (request('address_option')=='2') {
                    $tuhanorder->chumonsyabango = $chumonsyabango!=$syukkomotobango?$chumonsyabango:$syukkomotobango;
                    $tuhanorder->soufusakibango = $syukkomotobango!=null?$syukkomotobango:null;
                }else{
                    $tuhanorder->chumonsyabango = $syukkomotobango!=null?$syukkomotobango:null;
                    $tuhanorder->soufusakibango = $chumonsyabango!=$syukkomotobango?$chumonsyabango:$syukkomotobango;
                }
                
                $tuhanorder-> information5 = !empty($input['diff2_name'])?$input['diff2_name']:$input['name'];
                //$tuhanorder->numeric1 = Cart::content()->count();
                $tuhanorder->unsousplittesuryou = $user_id;
                $tuhanorder->chumonsyajouhou = request('inquiry');
                $tuhanorder->save();
                

                $order_no = $orderhenkan->bango;
                $kaiin_id = $user_id;
                $haisou_bango = $haisou_bango;
                $order_no = $order_no;
                
                //zaiko transection start//
          
                
                $request = $request->all();
                
        
            $soukobango = Kokyaku1::where('bango',env('store'))->first()->soukobango;
            
            foreach(Cart::content() as $row){
              
                $product3 = Product3::select('keisangenka','syouhizeiritu')->find($row->id);
                if ($product3->syouhizeiritu == null OR $product3->syouhizeiritu == '' OR $product3->syouhizeiritu == 0) 
                {
                    $tax=Kokyaku3::where('bango',1)->first()->syouhizeiritu;
                    
                }else{
                    $tax=$product3->syouhizeiritu;
                }
                
                $zaikou=[];
                foreach($zaiko as $k=>$val){

                   if ($val['syouhin_id']==$row->id) {
                       array_push($zaikou, $val);
                   }
                }

               
                foreach($zaikou as $key=>$val){
         
                        $misyukko = new Misyukko;
                        $misyukko->orderbango = $order_no;
                        $misyukko->syouhinbango = $row->id;
                        $misyukko->yoteisu = $val['quantity'];
                        $misyukko->yoteibi = static::getCurrentTimeWithFormat();
                        $misyukko->syukkasu = $val['quantity'];
                        $misyukko->kanryoubi = "1111-11-11 11:11:11";
                        $misyukko->kingaku = $row->price*$val['quantity'];
                        $misyukko->genka = $product3->keisangenka;
                        $misyukko->syouhizeiritu = $tax;
                        if (request('address_option')=='2') {
                            $misyukko->syukkosakibango = $syukkomotobango!=null?$syukkomotobango:null;
                            $misyukko->syukkomotobango = $chumonsyabango==$syukkomotobango?$syukkomotobango:$chumonsyabango;
                        }else{
                            $misyukko->syukkosakibango = $chumonsyabango==$syukkomotobango?$syukkomotobango:$chumonsyabango;
                            $misyukko->syukkomotobango = $syukkomotobango!=null?$syukkomotobango:null;
                        }
                        
                        $misyukko->syukkosoukobango = $soukobango;
                        $misyukko->tanabango = $val['tanabango'];
                        $misyukko->tantousyabango = 'netmagician';
                        $misyukko->tanka = $row->price;
                        //$misyukko->kawasename = $row->id;
                        //$misyukko->denpyoshimebi = static::getCurrentTimeWithFormat();
                        $misyukko->syouhinname = $row->name;
                        $misyukko->kaiinid = $kaiin_id;
                        //$misyukko->dataint04 = $row->price;
                        $misyukko->syouhinsyu = 1;
                        $misyukko->hantei = 1;
                        //$misyukko->datachar01 = request('payment_method');
                      
                        $misyukko->save();
 
                       
                    }
                }
                
                if($kaiin_id != ""){
                    $kaiin_update_data['lastbuy'] = Carbon::now()->setTimezone("Asia/Tokyo")->format('Ymd');
                    DB::table('kaiin')->where('bango',$kaiin_id)->update($kaiin_update_data);
                }
                
            
            //update tuhanorder
            $tuhanorder_update_data['information4'] = request('price_display');
            $tuhanorder_update_data['kessaihouhou'] = request('payment_method');
            $total_amount = request('total_amount'); 
            $delivery_charge = request('delivery_charge'); 
            $settlement_charge = request('settlement_charge');
            if(request('payment_method') != '代金引換'){
                $tuhanorder_update_data['moneymax'] = (int) str_replace(",", "", $total_amount);;
                $tuhanorder_update_data['money2']=(int) str_replace(",", "", $delivery_charge);
                $tuhanorder_update_data['money1']=(int) str_replace(",", "", $settlement_charge);
                $tuhanorder_update_data['soufusakijouhou'] = static::getCurrentTime().str_pad($order_no,9,0,STR_PAD_LEFT);
                $tuhanorder_update_data['numericmax'] = (int) str_replace(",", "", $total_amount);
            }
            if(request('payment_method') == '代金引換'){
               $tuhanorder_update_data['money1'] = $settlement_charge;
               $tuhanorder_update_data['money2']= $delivery_charge;
               $tuhanorder_update_data['moneymax'] = (int) str_replace(",", "", $total_amount);
               
            }
            
 
            DB::table('tuhanorder')->where('orderbango',$order_no)->update($tuhanorder_update_data);
            $tuhanorder=DB::table('tuhanorder')->where('orderbango',$order_no)->first();
            //update toiawasebango
            $toiawasebango_update_data['bikou2'] = request('inquiry');
            DB::table('toiawasebango')->where('orderbango',$order_no)->update($toiawasebango_update_data);
            $toiawasebango=DB::table('toiawasebango')->where('orderbango',$order_no)->first();
            //insert data
            $percentage = Kokyaku3::where('bango',1)->first()->syouhizeiritu;
            $syouhinbango = Product::where('name','送料')->first()->bango;
            $syouhinjouhou = Product::where('name','送料')->first()->jouhou;
            $misyukkoInfo = DB::table('misyukko')->where('orderbango',$order_no)->first();
            $misyukko = new Misyukko;
            $misyukko->orderbango = $misyukkoInfo->orderbango;
            $misyukko->syouhinbango = $syouhinbango;
            $misyukko->yoteisu = 1;
            $misyukko->yoteibi = $misyukkoInfo->yoteibi;
            $misyukko->syukkasu = 1;
            $misyukko->kanryoubi = $misyukkoInfo->kanryoubi;
            $misyukko->kingaku = $delivery_charge;
            $misyukko->genka = $delivery_charge;
            $misyukko->syouhizeiritu = $percentage;
            $misyukko->syukkosakibango = $misyukkoInfo->syukkosakibango;
            $misyukko->syukkomotobango = $misyukkoInfo->syukkomotobango;
            $misyukko->syukkosoukobango = $misyukkoInfo->syukkosoukobango;
            $misyukko->tantousyabango = $misyukkoInfo->tantousyabango;
            $misyukko->tanka = $delivery_charge;
            //$misyukko->kawasename = $misyukkoInfo->kawasename;
            //$misyukko->denpyoshimebi = $misyukkoInfo->denpyoshimebi;
            $misyukko->syouhinname = $syouhinjouhou;
            $misyukko->kaiinid = $kaiin_id;
            //$misyukko->dataint04 = $misyukkoInfo->dataint04;
            $misyukko->syouhinsyu = 0;
            $misyukko->hantei = 1;
            $misyukko->save();
            
            if(request('payment_method') == '代金引換'){
                $syouhinbango2 = Product::where('name','決済手数料')->first()->bango;
                $syouhinjouhou2 = Product::where('name','決済手数料')->first()->jouhou;
            }elseif(request('payment_method') == 'クロネコ後払い'){
                $syouhinbango2 = Product::where('name','決済手数料')->first()->bango;
                $syouhinjouhou2 = Product::where('name','決済手数料')->first()->jouhou;
            }else{
                $syouhinbango2 = null;
                $syouhinjouhou2 = null;
            }
            
            if($syouhinbango2 != null){
                $misyukko = new Misyukko;
                $misyukko->orderbango = $misyukkoInfo->orderbango;
                $misyukko->syouhinbango = $syouhinbango2;
                $misyukko->yoteisu = 1;
                $misyukko->yoteibi = $misyukkoInfo->yoteibi;
                $misyukko->syukkasu = 1;
                $misyukko->kanryoubi = $misyukkoInfo->kanryoubi;
                $misyukko->kingaku = $settlement_charge;
                $misyukko->genka = $settlement_charge;
                $misyukko->syouhizeiritu = $percentage;
                $misyukko->syukkosakibango = $misyukkoInfo->syukkosakibango;
                $misyukko->syukkomotobango = $misyukkoInfo->syukkomotobango;
                $misyukko->syukkosoukobango = $misyukkoInfo->syukkosoukobango;
                $misyukko->tantousyabango = $misyukkoInfo->tantousyabango;
                $misyukko->tanka = $settlement_charge;
                //$misyukko->kawasename = $misyukkoInfo->kawasename;
                //$misyukko->denpyoshimebi = $misyukkoInfo->denpyoshimebi;
                $misyukko->syouhinname = $syouhinjouhou2;
                $misyukko->kaiinid = $kaiin_id;
                //$misyukko->dataint04 = $misyukkoInfo->dataint04;
                $misyukko->syouhinsyu = 0;
                $misyukko->hantei = 1;
                $misyukko->save();
            }
            
            //update misyukko
            $misyukko_update_data['datachar01'] = request('payment_method');
            DB::table('misyukko')->where('orderbango',$order_no)->update($misyukko_update_data);
            
            //zaiko transection end//

            //call payment function 
            $input['order_no']=$order_no; 
            $input['haisou_bango']=$haisou_bango;
            if ($input['payment_method']=='クレジットカード' OR $input['payment_method']=='クロネコ後払い')
            {
                $result=self::payment_complete($input);
            }else{
                $result=['ok','daikin'];
            }
            
            $status=$result[0];
            $error_code=$result[1];

       
            if ($status == 'ok') {
                
                session()->forget('shippingInformation');
                DB::commit();
                self::send_success_mail($mail_data,$orderhenkan,$tuhanorder,$toiawasebango,$haisou1,$haisou2);
                Cart::destroy();
                return  response()->json(['order_no' => $order_no, 'haisou_bango' => $haisou_bango,'settlement_charge' => $settlement_charge,'delivery_charge' => $delivery_charge,'payment_method'=>request('payment_method'),'price_display' => request('price_display'),'inquiry' => request('inquiry'),'total_amount'=>request('total_amount')]);
            }
            elseif($status == 'ng' AND $error_code !=''){
                DB::rollback();
                self::zaiko_fix($zaiko);
                $transaction_err_msg = $error_code;
                if ($transaction_err_msg=='kaara103E') {
                    session()->put('transaction_err_msg', '番地が入力されていないため注文の確定ができません。配送先の番地を追加入力してください。');
                }else if ($transaction_err_msg=='kaara040E') {
                    session()->put('transaction_err_msg', '電話番号の入力が間違っています。');
                }else if ($transaction_err_msg=='A081010871') {
                    session()->put('transaction_err_msg', '有効なメールアドレスを入力してください。');
                }else if ($transaction_err_msg=='kaara029E') {
                    session()->put('transaction_err_msg', '実在する郵便番号であること。');
                }else if ($transaction_err_msg=='A082000010') {
                    session()->put('transaction_err_msg', 'クレジットカードの情報に誤りがあります。');
                }else if ($transaction_err_msg=='A081010572') {
                    session()->put('transaction_err_msg', 'ご利用限度額を超えています。他の決済方法をご利用ください。');
                }else if ($transaction_err_msg=='kaara009E') {
                    session()->put('transaction_err_msg', '加盟店様の全決済において一意(ユニーク)であること。');
                }else{
                    session()->put('transaction_err_msg', $transaction_err_msg);
                }
                
                return "ng"; 
            }else {
               DB::rollback();
               self::zaiko_fix($zaiko);

               $transaction_err_msg = '通信エラー。通信状況を確認して下さい。';
               session()->put('transaction_err_msg', $transaction_err_msg);
               return "ng"; 
            }
        
            
                
            } catch (\Exception $ex) {
                DB::rollback();
                self::zaiko_fix($zaiko);
               
                $transaction_err_msg = '通信エラー。通信状況を確認して下さい。';
                session()->put('transaction_err_msg', $transaction_err_msg);
                return "ng"; 
            }
  
            
        }else{
            return "ng"; 
        }
    }
    public function checkout_final_page(Request $request)
    {
        $bango=request('order_id');
        return view('UserPanel.orderCompleted',compact('bango'));
    }
    protected function send_success_mail($mail_data,$orderhenkan,$tuhanorder,$toiawasebango,$haisou1,$haisou2){

        $middle_part=self::order_detail();
        $subject=$mail_data[0];
        $first_part=$mail_data[1];
        $last_part=$mail_data[3];
        $display=$tuhanorder->information4=='0'?'表示':'非表示';

        $middle_part=str_replace("{{today}}",date('Y-m-d'),$middle_part);
        $middle_part=str_replace("{{paymentmethod}}",$tuhanorder->kessaihouhou,$middle_part);
        $middle_part=str_replace("{{toiawasedate}}",substr($tuhanorder->otodokedate, 0,10),$middle_part);
        $middle_part=str_replace("{{toiawasetime}}",$tuhanorder->otodoketime,$middle_part);
        $middle_part=str_replace("{{present_flag}}",$display,$middle_part);
        $middle_part=str_replace("{{message}}",$toiawasebango->bikou2,$middle_part);
        $middle_part=str_replace("{{orderbangoset}}",$tuhanorder->orderbango,$middle_part);
        $middle_part=str_replace("[TuhanOrder.Money2]",number_format($tuhanorder->money2),$middle_part);
        if (!empty($tuhanorder->money1)) {
           $middle_part=str_replace("[TuhanOrder.Money1]",number_format($tuhanorder->money1),$middle_part);
        }else{
           $middle_part=str_replace("[TuhanOrder.Money1]",number_format($tuhanorder->money6),$middle_part);
           $middle_part=str_replace("代引き手数料",'決済手数料',$middle_part);
        }
        
        $middle_part=str_replace("[TuhanOrder.Money5]",number_format($tuhanorder->money5),$middle_part);
        $middle_part=str_replace("[TuhanOrder.MoneyMax]",number_format($tuhanorder->moneymax),$middle_part);
        $middle_part=str_replace("[購入価格の合計]",number_format(($tuhanorder->moneymax-$tuhanorder->money1-$tuhanorder->money2-$tuhanorder->money6)),$middle_part);
        $middle_part=str_replace("{{mail_address}}",$haisou1->mail,$middle_part);
        $middle_part=str_replace("{{deliveryname}}",$haisou2->name,$middle_part);
        $middle_part=str_replace("{{deliverypostcode}}",$haisou2->yubinbango,$middle_part);
        $middle_part=str_replace("{{deliveryiaddress}}",$haisou2->address,$middle_part);
        $middle_part=str_replace("{{deliveryphone}}",$haisou2->tel,$middle_part);

        $total_part=$first_part.'<br><br>'.$middle_part.'<br><br>'.$last_part;

        $total_part=str_replace("{{username}}",$haisou1->name,$total_part);
        $total_part=str_replace("{{shop_title}}",DB::table('kokyaku1')->where('bango',env('store'))->first()->name,$total_part);
        $total_part=str_replace("{{shop_phone}}",DB::table('kokyaku1')->where('bango',env('store'))->first()->tel,$total_part);
        $total_part=str_replace("{{site_url}}",$_SERVER['HTTP_HOST'],$total_part);
        
        $to=$haisou1->mail;
        $from=DB::table('kokyaku1')->where('bango',env('store'))->first()->mail_soushin;
        $bcc=DB::table('kokyaku1')->where('bango',env('store'))->first()->mail_soushin_mb;
        $sender_name=DB::table('kokyaku1')->where('bango',env('store'))->first()->name;
        $phone=DB::table('kokyaku1')->where('bango',env('store'))->first()->tel;
        
        
        Mail::to($to)
        ->bcc($bcc)
        ->send(new ContactMail($sender_name,$phone,$to,$from,$subject,$total_part));

        /*Mail::send(new ContactMail($sender_name,$phone,$to,$from,$subject,$total_part));
        if (count(Mail::failures()) > 0) {
            return "ng";
        }*/
 
    }
    protected function zaiko_fix($zaiko){

        foreach($zaiko as $k=>$zaiko_temp){

            $product3 = Product3::select('keisangenka','syouhizeiritu')->find($zaiko_temp['syouhin_id']);

               
               $zaiko_upadte = DB::table('zaiko')->where('syouhinbango', $zaiko_temp['syouhin_id'])->where('tanabango', $zaiko_temp['tanabango']);
               $zaiko_quantity = $zaiko_upadte->first()->zaikosu;
               $zaiko_temp_quantity = $zaiko_temp['quantity'];
               $kingaku=$product3->keisangenka*($zaiko_quantity + $zaiko_temp_quantity);
               if ($zaiko_temp_quantity > 0) {
                   $merge_quantity = $zaiko_quantity + $zaiko_temp_quantity;
                   $zaiko_upadte->update([
                       'zaikosu' => $merge_quantity,
                       'kingaku' =>$kingaku,
                       'yobi3'=>date('YmdHis'),
                       'endtime'=>date('Ymd')
                   ]);
                }
                
            }
          
    }
    public function orderkakunin_fun(Request $request)
    {
        $input = $request->all();
  
        $status = 'default';
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        $percentage = Kokyaku3::where('bango',1)->first()->syouhizeiritu;
        $input['shipping_method']=DB::table('kokyaku1')->where('bango',env('store'))->first()->mallsoukobango1; 
        $input['shipping_method']=DB::table('kokyaku1')->where('bango',env('store'))->first()->mallsoukobango1;    
        $user_id = request('user_id');
        //$ordererInfo = Kaiin::select('name','kaka','mail','yubinbango','kenadd','cyouadd','biladd','model','tel')->find($user_id);
        $ordererInfo = null;   
        $kokyaku1 = Kokyaku1::select('souryougenkai','kakakutaibango1','daibikigenkai','domain','domain2')->find(env('store'));
        $total_price = $input['total_amount'];
        $delivery_charge=$input['delivery_charge'];
        $settlement_charge=$input['settlement_charge'];
        $tax=0;
        foreach(Cart::content() as $row){
            if(Product::where('bango',$row->id)->first()->isphoto == 0){
              if (product3::where('bango',$row->id)->first()->syouhizeiritu) {
                    $t1=(int)product3::where('bango',$row->id)->first()->syouhizeiritu;
                }else{
                    $t1=(int)DB::table('kokyaku3')->where('bango',1)->first()->syouhizeiritu;
                }
                
               
            }else{
                $t1=(int)DB::table('kokyaku3')->where('bango',1)->first()->syouhizeiritu;
                
            }

            $tax+=floor(($t1/100)*$row->price /(($t1+100)/100))*$row->qty;
        }
        if($input['settlement_charge']!='' OR $input['settlement_charge']!=null){
            $t1=(int)DB::table('kokyaku3')->where('bango',1)->first()->syouhizeiritu;
            $tax+=floor(($t1/100)*(int)$input['settlement_charge'] /(($t1+100)/100));
        }
        if($input['delivery_charge']!='' OR $input['delivery_charge']!=null){
            $t1=(int)DB::table('kokyaku3')->where('bango',1)->first()->syouhizeiritu;
            $tax+=floor(($t1/100)*(int)$input['delivery_charge'] /(($t1+100)/100));
 
        }
       
        
    //  dd($input,$total_price,$delivery_charge,$settlement_charge);
        return response()->view('UserPanel.paymentHistory',compact('categories','brands','input','ordererInfo','delivery_charge','settlement_charge','percentage','total_price','tax'));
    }
    protected function payment_complete($input)
    {
        if ($input['payment_method']=='クレジットカード') {
               $apiUrl = "https://service.dev.colgis.com/cgi-bin/kwc_api_new/kwc_api_new_test_02.cgi";

               $params['_set_kwc_cmd'] = "credit_exec";
               $params['_set_user_name'] = "php_sample";
               $params['_set_kwc_url'] = "test";                  //テスト時は「test」、本番時は指定なし

               $params['trader_code'] = DB::table('kokyaku1')->where('bango',env('store'))->first()->kcode1;
               $params['order_no'] = $input['order_no']; //Random every time

               //フォームからの入力値
               $params['buyer_email'] = $input['email'];
               $params['buyer_name_kanji'] = $input['name'];
               $params['buyer_tel'] = $input['phone'];
               $params['device_div'] = "2";
               $params['goods_name'] = "product";
               $params['settle_price'] =(int) str_replace(",", "", $input['total_amount']);
               $params['card_code_api'] = "1";                                             //カード会社コード UC
               $params['pay_way'] = "1";                                                   //支払い回数１回

               //hiden param
               $params['token'] = $input['webcollectToken'];

               //送信データを用意する
               //POST送信する
               $status = self::SendRequest("POST",$apiUrl,$params);
               
               
            }

            if ($input['payment_method']=='クロネコ後払い') { 
                //後払い決済登録(テスト)
                $apiUrl = "https://service.dev.colgis.com/cgi-bin/kwc_api_new/kwc_api_new_test_02.cgi";
                

                $send_address=!empty($input['diff2_address1'])?$input['diff2_prefecture'].$input['diff2_address1'].$input['diff2_address2'].$input['diff2_biladd']:$input['prefecture'].$input['address1'].$input['address2'].$input['biladd'];
                $zip_code=!empty($input['diff2_zipcode1'])?$input['diff2_zipcode1']."-".$input['diff2_zipcode2']:$input['zipcode1']."-".$input['zipcode2'];

                $params['HTTP_ACCEPT'] = $_SERVER['HTTP_ACCEPT'];
                //$params['HTTP_ACCEPT_CHARSET'] = $_SERVER['HTTP_ACCEPT_CHARSET'];
                $params['HTTP_ACCEPT_ENCODING'] = $_SERVER['HTTP_ACCEPT_ENCODING'];
                $params['HTTP_ACCEPT_LANGUAGE'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                $params['HTTP_CONNECTION'] = $_SERVER['HTTP_CONNECTION'];
                $params['HTTP_HOST'] = $_SERVER['HTTP_HOST'];
                $params['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
                $params['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
               // $params['HTTP_KEEP_ALIVE'] = $_SERVER['HTTP_KEEP_ALIVE'];
                if($_SERVER['HTTP_HOST'] != 'localhost'){
                $params['HTTP_X_FORWARDED_FOR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }

                //関数パラメータ ここで用意する
                $params['_set_kwc_cmd'] = "atobarai_exec";  // 後払い　与信依頼実行

                $params['_set_user_name'] = "php_sample";
                $params['_set_kwc_url'] = "test";                   //テスト時は「test」、本番時は指定なし

                $params['ycfStrCode'] = DB::table('kokyaku1')->where('bango',env('store'))->first()->kcode4;  //テスト環境
                $params['password'] = DB::table('kokyaku1')->where('bango',env('store'))->first()->kcode5;

                //
                $set_date_str = date("YmdHis");
                $params['requestDate'] = $set_date_str;
                //
                $params['orderNo'] = $input['order_no']; //Random every time

                $params['sendDiv'] = '0';   //請求書　送り先区分　サンプルなので、本人送り(=0)　固定とした。
                $t=new DateTime('+1day');

                //フォームからの入力値
                $params['orderYmd'] = date('Ymd');
                $params['shipYmd']  = $input['delivery_date']=='null'?$t->format('Ymd'):str_replace("-","",$input['delivery_date']);

                $params['name']  = mb_convert_kana($input['name'], "KVCARNSH");
                $params['postCode']  = $zip_code;
                $params['address1']  =substr(mb_convert_kana($send_address, "KVCARNSH"),0,75 );
 
               // dd($params['address1']);
                $params['telNum']  = $input['phone'];
                $params['email']   = $input['email'];
          
                //product list
                $i = 1;
                $grand_total = 0;
                foreach(Cart::content() as $row){
                    $set_item_name  = "itemName" . $i;
                    $set_item_count = "itemCount" . $i;
                    $set_item_price = "unitPrice" . $i;
                    $set_item_total = "subTotal" . $i;

                    $params[ $set_item_name ]  = substr(mb_convert_kana($row->name, "KVCARNSH"), 0,30) ;
                    $params[ $set_item_count ] = $row->qty;
                    $params[ $set_item_price ] = $row->price;
                    $params[ $set_item_total ] = $row->price;

                    $grand_total += $params[ $set_item_total ];
                    $i++;
                }
                if($input['delivery_charge']!=null OR $input['delivery_charge']!=''){
                    $set_item_name  = "itemName" . $i;
                    $set_item_count = "itemCount" . $i;
                    $set_item_price = "unitPrice" . $i;
                    $set_item_total = "subTotal" . $i;

                    $params[ $set_item_name ]  = mb_convert_kana('送料', "KVCARNSH");
                    $params[ $set_item_count ] = 1;
                    $params[ $set_item_price ] = $input['delivery_charge'];
                    $params[ $set_item_total ] = $input['delivery_charge'];

                    $grand_total += $params[ $set_item_total ];
                    $i++;
                }
                if($input['settlement_charge']!=null OR $input['settlement_charge']!=''){
                    $set_item_name  = "itemName" . $i;
                    $set_item_count = "itemCount" . $i;
                    $set_item_price = "unitPrice" . $i;
                    $set_item_total = "subTotal" . $i;

                    $params[ $set_item_name ]  = mb_convert_kana('代引き手数料', "KVCARNSH");
                    $params[ $set_item_count ] = 1;
                    $params[ $set_item_price ] = $input['settlement_charge'];
                    $params[ $set_item_total ] = $input['settlement_charge'];

                    $grand_total += $params[ $set_item_total ];
                    $i++;
                }

                $params['totalAmount']   = $grand_total;
               // $params['totalAmount']   = (int) str_replace(",", "", $input['total_amount']);    
                //総合計

                //POST送信する
                $status = self::SendRequest("POST",$apiUrl,$params);
      
            }
            $error_code='';
            if($status!='ng'){


            $split=explode('<returnCode>', $status);
            $first_char = mb_substr($split[1], 0, 1);
             

            if ($first_char == '1') {
                $status='ng';
                $error_code=explode('</errorCode>',explode('<errorCode>',$split[1])[1])[0] ;
            }else{
                $status='ok';
            }
            }else{
               $transaction_err_msg = '通信エラー。通信状況を確認して下さい。';
               session()->put('transaction_err_msg', $transaction_err_msg);
               return "ng"; 
            }
            return [$status,$error_code];
    }
    protected function SendRequest($method,$url,$sendData)
    {
    
    //引数が正しいか判定する
    // if (!($method==="GET" || $method=="POST") || !preg_match("/^https?:¥/¥/[a-zA-Z0-9-_.!~*¥'();¥/?:@&=+$,%#]+$/",$url) || (!empty($send) && count($sendData) < 1)
    // ){
    //     return false;
    // }

    if (!($method==="GET" || $method=="POST") || (!empty($sendData) && count($sendData) < 1)
    ){
        return false;
    }
    // if (!preg_match("/^https?:¥/¥/[a-zA-Z0-9-_.!~*¥'();¥/?:@&=+$,%#]+$/",$url)
    // ){
    //     return false;
    // }

    //クエリストリングの生成
    $query_string=http_build_query($sendData);

    //送信用ヘッダオプションの定義
    $options=array(
        "http"=>array(
        "method"=>$method,
        "header"=>"Content-type: application/x-www-form-urlencoded",
        )
    );

    //GET送信の場合はURLの末尾にクエリストリングを結合する
    if($method==="GET")
        $url=$url."?".$query_string;
    //POST送信の場合は送信用ヘッダオプションのcontextに送信データを入れる
    else if($method==="POST")
        $options["http"]["content"]=$query_string;

    //ストリームコンテキストの生成
    $httpStreamContext = stream_context_create($options);
 
    //リクエスト送信&レスポンスを戻り値として返す
    $response = file_get_contents($url, false, $httpStreamContext);

    foreach ($http_response_header as $http_response_headers) {
        //print_r($http_response_headers ."\n");
    }

    preg_match('/HTTP\/1\.[0|1|x] ([0-9]{3})/', $http_response_header[0], $matches);

    $statusCode = $matches[1];

    switch ($statusCode) {
        case '200':
        // 200の場合
            //print_r ($response);
            return $response;
            break;
        case '404':
            // 404の場合
            print_r("status 404 :".$http_response_header[0]);
            print_r ('通信エラー。通信状況を確認して下さい。');
            return 'ng';
            break;
        default:
            print_r("status".$statusCode." :".$http_response_header[0]);
            break;
    }
 

   }
   public function zaiko_hikiate()
   {

    DB::statement("DROP TABLE IF EXISTS zaiko_maintain_temp_table");
    DB::statement("CREATE TEMPORARY TABLE  IF NOT EXISTS zaiko_maintain_temp_table (
    position_id serial,
    syouhin_id VARCHAR(50),
    tanabango VARCHAR (50),
    quantity DOUBLE PRECISION)");

      $shoyhinItems=[];
      foreach(Cart::content() as $row){
        $shoyhinItems[$row->id]=$row->qty;
      }

      $orderByZaikosuQuery = "Zaiko.SyouhinBango ASC,replace(coalesce(Zaiko.dataChar02, ''),'|',' ') ASC,coalesce(Zaiko.dataInt01, 0)
            ASC,regexp_replace(Zaiko.TanaBango, '^MIKAKUTEI', '~') ASC,Zaiko.ZaikoSu ASC";
        DB::beginTransaction();     
        try {
            foreach ($shoyhinItems as $shoyhinId => $order_quantity) {
            $zaikos = DB::table('zaiko')->where('syouhinbango', $shoyhinId)->orderByRaw($orderByZaikosuQuery)->get();
            $zaiko_status = [];
            $temp_quantity = 0;
            foreach ($zaikos as $key =>  $zaiko) {
                $zaiko =  DB::table('zaiko')
                    ->where('syouhinbango', $zaiko->syouhinbango)
                    ->where('tanabango', $zaiko->tanabango)
                    ->orderByRaw($orderByZaikosuQuery)->first();

                $available_quantity = $zaiko->zaikosu;
                $order_quantity = $key == 0 ? $order_quantity : $temp_quantity;

                if ($order_quantity >= $available_quantity) {
                    $used_quantity = $available_quantity;
                    $update_quantity = 0;
                    $temp_quantity = $order_quantity - $available_quantity;
                } else {
                    $used_quantity = $order_quantity;
                    $update_quantity = $available_quantity - $order_quantity;
                    $temp_quantity = 0;
                }
                $temp_status['shoyhin_id'] = $zaiko->syouhinbango;
                $temp_status['tana_bango'] = $zaiko->tanabango;
                $temp_status['used_quantity'] = $used_quantity;
                $temp_status['update_quantity'] = $update_quantity;
                $temp_status['temp_quantity'] = $temp_quantity;

                array_push($zaiko_status, $temp_status);

                if ($temp_quantity <= 0) {
                    break;
                }
            }

            foreach ($zaiko_status as $zaiko) {
                $product3 = Product3::select('keisangenka','syouhizeiritu')->find($zaiko['shoyhin_id']);
                $kingaku=$product3->keisangenka*$zaiko['update_quantity'];
                DB::table('zaiko')
                    ->where('syouhinbango',  $zaiko['shoyhin_id'])
                    ->where('tanabango', $zaiko['tana_bango'])->update([
                        'zaikosu' => $zaiko['update_quantity'],
                        'kingaku' => $kingaku,
                        'yobi3'=>date('YmdHis'),
                        'endtime'=>date('Ymd')
                    ]);
                if ($zaiko['used_quantity'] != 0) {
                        DB::table('zaiko_maintain_temp_table')->insert([
                        'syouhin_id' => $zaiko['shoyhin_id'],
                        'tanabango' => $zaiko['tana_bango'],
                        'quantity' => $zaiko['used_quantity']
                  ]);   
                }    
                 
            }
        }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return 'ng';
        }      

      return 'ok';
   }
    public function orderkakunin(Request $request)
    {
        //stock check
        $stock = self::checkStock();
        if(count($stock) > 0){
            $result = "stock_out";
            return $result;
        }
        
        $request = $request->all();
        $kaiin_id = $request['user_id'];
        $haisou_bango = $request['haisou_bango'];
        $order_no = $request['order_no'];
        
        DB::beginTransaction();
        try {
            $soukobango = Kokyaku1::where('bango',env('store'))->first()->soukobango;
            $syukkomotobango = request('shipping_destination') == 'different'?$user_id:null;
            foreach(Cart::content() as $row){
                $product3 = Product3::select('keisangenka','syouhizeiritu')->find($row->id);
                $zaikou = Zaiko::select('syouhinbango','zaikosu','tanabango')->where('syouhinbango',$row->id)->orderBy('tanabango','ASC')->get();
                $status = 'go';
                $remaining_qty = "";
                foreach($zaikou as $key=>$val){
                    if($status == 'go'){
                        $temp_qty = $zaikou[$key]->zaikosu;
                        if($remaining_qty != ""){
                            $qty = $remaining_qty;
                        }else{
                            $qty = $row->qty;
                        }
                        if($qty > $temp_qty){
                            if($temp_qty != 0){
                                $misyukko = new Misyukko;
                                $misyukko->orderbango = $order_no;
                                $misyukko->syouhinbango = $row->id;
                                $misyukko->yoteisu = $temp_qty;
                                $misyukko->yoteibi = static::getCurrentTimeWithFormat();
                                $misyukko->syukkasu = $temp_qty;
                                $misyukko->kanryoubi = "1111-11-11 00:00:00";
                                $misyukko->kingaku = $row->price*$temp_qty;
                                $misyukko->genka = $product3->keisangenka;
                                $misyukko->syouhizeiritu = $product3->syouhizeiritu;
                                $misyukko->syukkosakibango = $haisou_bango;
                                $misyukko->syukkomotobango = $syukkomotobango;
                                $misyukko->syukkosoukobango = $soukobango;
                                $misyukko->tanabango = $zaikou[$key]->tanabango;
                                $misyukko->tantousyabango = 'netmagician';
                                $misyukko->tanka = $row->price;
                                $misyukko->kawasename = $row->id;
                                //$misyukko->denpyoshimebi = static::getCurrentTimeWithFormat();
                                $misyukko->syouhinname = $row->name;
                                $misyukko->kaiinid = $kaiin_id;
                                $misyukko->dataint04 = $row->price;
                                $misyukko->syouhinsyu = 0;
                                $misyukko->hantei = 1;
                                //$misyukko->datachar01 = request('payment_method');
                                $misyukko->save();

                                //update zaiko
                                $remaining_qty = $qty - $temp_qty;
                                $zaiko_update_qty['zaikosu'] = 0;
                                $zaiko_update_qty['yobi3'] = static::getCurrentTime();
                                $zaiko_update_qty['kingaku'] = 0;
                                $zaiko_update_qty['endtime'] = Carbon::now()->setTimezone("Asia/Tokyo")->format('Ymd');
                                DB::table('zaiko')->where('syouhinbango',$zaikou[$key]->syouhinbango)->where('tanabango',$zaikou[$key]->tanabango)->update($zaiko_update_qty);
                            }
                          
                        }elseif($qty <= $temp_qty){
                            $misyukko = new Misyukko;
                            $misyukko->orderbango = $order_no;
                            $misyukko->syouhinbango = $row->id;
                            $misyukko->yoteisu = $qty;
                            $misyukko->yoteibi = static::getCurrentTimeWithFormat();
                            $misyukko->syukkasu = $qty;
                            $misyukko->kanryoubi = "1111-11-11 00:00:00";
                            $misyukko->kingaku = $row->price*$qty;
                            $misyukko->genka = $product3->keisangenka;
                            $misyukko->syouhizeiritu = $product3->syouhizeiritu;
                            $misyukko->syukkosakibango = $haisou_bango;
                            $misyukko->syukkomotobango = $syukkomotobango;
                            $misyukko->syukkosoukobango = $soukobango;
                            $misyukko->tanabango = $zaikou[$key]->tanabango;
                            $misyukko->tantousyabango = 'netmagician';
                            $misyukko->tanka = $row->price;
                            $misyukko->kawasename = $row->id;
                            //$misyukko->denpyoshimebi = static::getCurrentTimeWithFormat();
                            $misyukko->syouhinname = $row->name;
                            $misyukko->kaiinid = $kaiin_id;
                            $misyukko->dataint04 = $row->price;
                            $misyukko->syouhinsyu = 0;
                            $misyukko->hantei = 1;
                            $misyukko->save();
                            
                            //update zaiko
                            $zaiko_update_qty['zaikosu'] = $temp_qty - $qty;
                            $zaiko_update_qty['kingaku'] = ($temp_qty - $qty)*$product3->keisangenka;
                            $zaiko_update_qty['yobi3'] = static::getCurrentTime();
                            $zaiko_update_qty['endtime'] = Carbon::now()->setTimezone("Asia/Tokyo")->format('Ymd');
                            DB::table('zaiko')->where('syouhinbango',$zaikou[$key]->syouhinbango)->where('tanabango',$zaikou[$key]->tanabango)->update($zaiko_update_qty);
                            $status = "stop";
                        }
                    }
                }
                
                if($kaiin_id != ""){
                    $kaiin_update_data['lastbuy'] = Carbon::now()->setTimezone("Asia/Tokyo")->format('Ymd');
                    DB::table('kaiin')->where('bango',$kaiin_id)->update($kaiin_update_data);
                }
                
            }
            
            //update tuhanorder
            $tuhanorder_update_data['information4'] = request('price_display');
            $tuhanorder_update_data['kessaihouhou'] = request('payment_method');
            $total_amount = request('total_amount'); 
            $delivery_charge = request('delivery_charge'); 
            $settlement_charge = request('settlement_charge');
            if(request('payment_method') != '代金引換'){
                $tuhanorder_update_data['moneymax'] = $total_amount;
                $tuhanorder_update_data['money2']= $delivery_charge;
                $tuhanorder_update_data['money1']= $settlement_charge;
                $tuhanorder_update_data['soufusakijouhou'] = static::getCurrentTime().str_pad(request('order_no'),9,0,STR_PAD_LEFT);
            }
            if(request('payment_method') == '代金引換'){
               $tuhanorder_update_data['money1'] = $settlement_charge;
               $tuhanorder_update_data['money2']= $delivery_charge;
               $tuhanorder_update_data['moneymax'] = $total_amount;
               $tuhanorder_update_data['numericmax'] = $total_amount;
            }
            
            if(request('payment_method') == 'クロネコ後払い'){
               $money6 = request('settlement_charge'); 
               $tuhanorder_update_data['money1'] = $money6;
            }
            DB::table('tuhanorder')->where('orderbango',$order_no)->update($tuhanorder_update_data);
            
            //update toiawasebango
            $toiawasebango_update_data['bikou2'] = request('inquiry');
            DB::table('toiawasebango')->where('orderbango',$order_no)->update($toiawasebango_update_data);
            
            //insert data
            $percentage = Kokyaku3::where('bango',1)->first()->syouhizeiritu;
            $syouhinbango = Product::where('name','送料')->first()->bango;
            $syouhinjouhou = Product::where('name','送料')->first()->jouhou;
            $misyukkoInfo = DB::table('misyukko')->where('orderbango',$order_no)->first();
            $misyukko = new Misyukko;
            $misyukko->orderbango = $misyukkoInfo->orderbango;
            $misyukko->syouhinbango = $syouhinbango;
            $misyukko->yoteisu = 1;
            $misyukko->yoteibi = $misyukkoInfo->yoteibi;
            $misyukko->syukkasu = 1;
            $misyukko->kanryoubi = $misyukkoInfo->kanryoubi;
            $misyukko->kingaku = $delivery_charge;
            $misyukko->genka = $delivery_charge;
            $misyukko->syouhizeiritu = $percentage;
            $misyukko->syukkosakibango = $misyukkoInfo->syukkosakibango;
            $misyukko->syukkomotobango = $misyukkoInfo->syukkomotobango;
            $misyukko->syukkosoukobango = $misyukkoInfo->syukkosoukobango;
            $misyukko->tantousyabango = $misyukkoInfo->tantousyabango;
            $misyukko->tanka = $misyukkoInfo->tanka;
            $misyukko->kawasename = $misyukkoInfo->kawasename;
            //$misyukko->denpyoshimebi = $misyukkoInfo->denpyoshimebi;
            $misyukko->syouhinname = $syouhinjouhou;
            $misyukko->kaiinid = $kaiin_id;
            $misyukko->dataint04 = $misyukkoInfo->dataint04;
            $misyukko->syouhinsyu = 1;
            $misyukko->hantei = 1;
            $misyukko->save();
            
            if(request('payment_method') == '代金引換'){
                $syouhinbango2 = Product::where('name','決済手数料')->first()->bango;
                $syouhinjouhou2 = Product::where('name','決済手数料')->first()->jouhou;
            }elseif(request('payment_method') == 'クロネコ後払い'){
                $syouhinbango2 = Product::where('name','決済手数料')->first()->bango;
                $syouhinjouhou2 = Product::where('name','決済手数料')->first()->jouhou;
            }else{
                $syouhinbango2 = null;
                $syouhinjouhou2 = null;
            }
            
            if($syouhinbango2 != null){
                $misyukko = new Misyukko;
                $misyukko->orderbango = $misyukkoInfo->orderbango;
                $misyukko->syouhinbango = $syouhinbango2;
                $misyukko->yoteisu = 1;
                $misyukko->yoteibi = $misyukkoInfo->yoteibi;
                $misyukko->syukkasu = 1;
                $misyukko->kanryoubi = $misyukkoInfo->kanryoubi;
                $misyukko->kingaku = $settlement_charge;
                $misyukko->genka = $settlement_charge;
                $misyukko->syouhizeiritu = $percentage;
                $misyukko->syukkosakibango = $misyukkoInfo->syukkosakibango;
                $misyukko->syukkomotobango = $misyukkoInfo->syukkomotobango;
                $misyukko->syukkosoukobango = $misyukkoInfo->syukkosoukobango;
                $misyukko->tantousyabango = $misyukkoInfo->tantousyabango;
                $misyukko->tanka = $misyukkoInfo->tanka;
                $misyukko->kawasename = $misyukkoInfo->kawasename;
                //$misyukko->denpyoshimebi = $misyukkoInfo->denpyoshimebi;
                $misyukko->syouhinname = $syouhinjouhou2;
                $misyukko->kaiinid = $kaiin_id;
                $misyukko->dataint04 = $misyukkoInfo->dataint04;
                $misyukko->syouhinsyu = 1;
                $misyukko->hantei = 1;
                $misyukko->save();
            }
            
            //update misyukko
            $misyukko_update_data['datachar01'] = request('payment_method');
            DB::table('misyukko')->where('orderbango',$order_no)->update($misyukko_update_data);
            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            $result = "ng";
            return $result;
        }
        
        Cart::destroy();
        return "ok";
        
    }
    
    //calculate delivery charge
    public static function calculateDeliveryCharge($shipping_method = null,$prefecture = null){
        $kokyaku1 = Kokyaku1::select('souryougenkai','kakakutaibango1','daibikigenkai','domain','domain2')->find(env('store'));
        $total_price = (int) str_replace(",","",Cart::total(0));
        if($kokyaku1->souryougenkai <= $total_price){
            $delivery_charge = 0;
        }else{
            $mallsouryou = DB::table('mallsouryou')->select('souryou0')->where('kenmei','一律')->get();
            if($mallsouryou[0]->souryou0 != null){
                $delivery_charge = $mallsouryou[0]->souryou0;
            }else{
                $mallsouryou2 = DB::table('mallsouryou')->select('souryou0')->where('kenmei',$prefecture)->get();
               
                $delivery_charge = $mallsouryou2[0]->souryou0;
            }
        }
        return $delivery_charge;
    }
    
    public function calculateDeliveryAndSettlementCharge(Request $request){
        $input = $request->all();
        
        $kokyaku1 = Kokyaku1::select('souryougenkai','kakakutaibango1','daibikigenkai','domain','domain2')->find(env('store'));
        $total_price = (int) str_replace(",","",Cart::total(0));

        //delivery charge
        if($kokyaku1->souryougenkai <= $total_price){
            $delivery_charge = 0;
        }else{
            $shipping_method = $input['shipping_method'];
            $mallsouryou = DB::table('mallsouryou')->select('souryou0')->where('kenmei','一律')->get();
            if($mallsouryou[0]->souryou0 != null){
                $delivery_charge = $mallsouryou[0]->souryou0;
            }else{
                $prefecture = $input['prefecture'];

                $mallsouryou2 = DB::table('mallsouryou')->select('souryou0')->where('kenmei',$prefecture)->get();
                $delivery_charge = $mallsouryou2[0]->souryou0;
            }
        }

        //settlement charge
        $settlement_charge = 0;
        //if($kokyaku1->kakakutaibango1 <= $total_price){
        //    $settlement_charge = 0;
        //}else{
            $payment_method = $input['payment_method'];
            if($payment_method == 'クロネコ後払い'  ){
                if($kokyaku1->kakakutaibango1 <= $total_price && $kokyaku1->kakakutaibango1!=null && $kokyaku1->kakakutaibango1!=''){
                    $settlement_charge = 0;
                }else{
                    $domain = $kokyaku1->domain2;
                    $domain = explode("/",$domain)[0];
                    $settlement_charge = explode("=",$domain)[1];
                }
            }elseif($payment_method == '代金引換'){
                if($kokyaku1->daibikigenkai !=null && $kokyaku1->daibikigenkai <= $total_price ){
                    $settlement_charge = 0;
                }else{

                    $domain = $kokyaku1->domain;
                    $domain = explode("=",$domain);

                    $start = 1;
                    for($key=0;$key<count($domain);$key++){
                        if($key == (count($domain) - 1)){
                            $value = explode("/",$domain[$key])[0];
                            $end = (int) explode("/",$domain[$key])[1];
                        }else{
                           $value = explode("/",$domain[$key+1])[0];
                           $end = (int) explode("/",$domain[$key+1])[1]; 
                        }
                      
                        if($start <= $total_price && $total_price < $end){
                           $settlement_charge =  $value;
                           $start = $end;
                        }
                    }
                }
            }
        //}
            
        //check payment exceed
        $product_total = (int)str_replace(",","",$input['product_total']);
        $cash_on_delivery_status = "";
        $kuroneko_status = "";
        $temp_domain = $kokyaku1->domain;
        $temp_domain = explode("=",$temp_domain)[0];
        $temp_domain2 = $kokyaku1->domain2;
        $temp_domain2 = explode("=",$temp_domain2)[0];
        if($payment_method == '代金引換' && $product_total > $temp_domain){
            $cash_on_delivery_status = 'exceed';
        }
        if($payment_method == 'クロネコ後払い' && $product_total > $temp_domain2){
            $kuroneko_status = 'exceed';
        }
   
        $total_amount = (int) str_replace(",","",Cart::total(0)) + $delivery_charge + $settlement_charge;
        $total_amount = number_format($total_amount);
        $result['delivery_charge'] = $delivery_charge;
        $result['settlement_charge'] = $settlement_charge;
        $result['total_amount'] = $total_amount;
        $result['cash_on_delivery_status'] = $cash_on_delivery_status;
        $result['kuroneko_status'] = $kuroneko_status;
        return $result;
    }
    
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
    
    public static function getCurrentTimeWithFormat()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        return $mytime;
    }
    
    public static function checkStock()
    {
        $stock_out_msg = array();
        foreach(Cart::content() as $row){
            $product_id  = $row->id;
            $qty  = $row->qty;
            $productDetails = DB::select("
            select
            syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            --(select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) as stock
            CASE
                WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > COALESCE(syouhin1.synchrosyouhinbango,0)
                    THEN  COALESCE(syouhin1.synchrosyouhinbango,0)
                ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) END as stock
            from syouhin1
            where syouhin1.bango = $product_id and syouhin1.isdaihyou = 1 and syouhin1.endtime = 1
            ");
            if(count($productDetails) > 0 && $qty > $productDetails[0]->stock){
                $stock_out_msg[] = "【".$productDetails[0]->product_name."】の在庫が不足しており、商品を購入することはできませんでした。";
            }
        }
        if(count($stock_out_msg) > 0){
            session()->put('stock_out_msg', $stock_out_msg);
        }else{
            session()->forget('stock_out_msg');
        }
        return $stock_out_msg;
    }
    
}
