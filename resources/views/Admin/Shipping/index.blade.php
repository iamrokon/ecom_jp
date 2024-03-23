@include('Admin.layouts.header')
<!-- page-wrapper start -->
<div class="page-wrapper default-version">
  @include('Admin.layouts.left_sidebar')
  <!-- sidebar end -->
  <!-- navbar-wrapper start -->
  @include('Admin.layouts.navber')
  <!-- navbar-wrapper end -->
<style>

.modalOverflow .modal {
    overflow: auto;
}
</style>
  <div class="body-wrapper">
    <div class="bodywrapper__inner">

      <div class="row align-items-center mb-30 justify-content-between">
        <div class="col-lg-6 col-sm-6">
          <h6 class="page-title">配送設定</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right">
          <!-- <button style="padding: 2px 12px;" class="icon-btn" onclick="openModel('insert')">新規登録</button> -->
        </div> 
      </div>
     
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-body">
              <div class="table-responsive--md table-responsive" id="category-table">
                <table class="table table--light style--two">
                  <thead>
                    <tr>
                      <!-- <th>配送会社名</th> -->
                      <th>設定送料<br>一律/都道府県別</th>
                      <th>送料一律金額</th>
                      <th>送料無料基準値</th>
                      <th>着日指定</th>
                      <th>時間帯指定使用有無</th>
                      <th>時間帯指定</th>
                      <th>アクション</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                   
                    <tr>
                      <!-- <td>{{$detail['name']}}</td> -->
                      @if($detail['normal_price']!=NULL)
                      <td>一律</td>
                      <td>{{$detail['normal_price']}} 円</td>
                      @else
                      <td>都道府県別</td>
                      <td>一</td>
                      @endif
                      <td>{{$detail['cash_on_delivery']}} 円</td>
                      @if($detail['delivery_duration']!=NULL)
                      <td>{{explode('/',$detail['delivery_duration'])[0]}}日後～{{explode('/',$detail['delivery_duration'])[1]}}日後</td>
                      @else
                      <td>一</td>
                      @endif
                      @if($detail['delivery_time']!=NULL)
                      <td>する</td>
                      <td>{{$detail['delivery_time']}}</td>
                      @else
                      <td>しない</td>
                      <td>一</td>
                      @endif
                      <td>
                        <button class="icon-btn" onclick="open_detail('5')" data-toggle="tooltip" title="編集"> <i class="la la-pencil"></i></button>
                        
                      </td>
                    </tr>
      
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     <form action="#" enctype="multipart/form-data" id="reg_form">
      @csrf
      @include('Admin.Shipping.insert_edit_modal')
      @include('Admin.Shipping.ken_modal')
     </form> 

      </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
  </div>
  
  @include('Admin.layouts.commonjs')

  <script type="text/javascript">

    // Active Inactive input and bitton........
    $(document).on("click", '.input-radio', function () {
      if ($(this).is(":checked")) {
        $('.check-active-input').addClass('d-block');
        $(".check-active-button").removeClass("d-block");
      }
    });

    $(document).on("click", '.button-radio', function () {
      if ($(this).is(":checked")) {
        $(".check-active-button").addClass("d-block");
        $('.check-active-input').removeClass('d-block');
      }
    });

    $(document).on("click", '.input-radio1', function () {
      if ($(this).is(":checked")) {
        $('.check-active-input1').addClass('d-block');
        $(".check-active-button1").removeClass("d-block");
      }
    });

    $(document).on("click", '.button-radio1', function () {
      if ($(this).is(":checked")) {
        $(".check-active-button1").addClass("d-block");
        $('.check-active-input1').removeClass('d-block');
      }
    });

    $(document).on("click", '.input-radio2', function () {
      if ($(this).is(":checked")) {
        $('.check-active-input2').addClass('d-block');
        $(".check-active-button2").removeClass("d-block");
      }
    });

    $(document).on("click", '.button-radio2', function () {
      if ($(this).is(":checked")) {
        $(".check-active-button2").addClass("d-block");
        $('.check-active-input2').removeClass('d-block');
      }
    });

    // Active Input & button section......
    $('.option-use').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode").removeClass("d-none");
        $(".active-radio").removeClass("d-none");
      }if($(this).val() == '0') {
        $(".active-mode").addClass("d-none");
        $(".active-radio").addClass("d-none");
      }
    });

    $('.option-use1').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode1").removeClass("d-none");
        $(".active-radio1").removeClass("d-none");
      }if($(this).val() == '0') {
        $(".active-mode1").addClass("d-none");
        $(".active-radio1").addClass("d-none");
      }
    });
    $('.option-use2').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode2").removeClass("d-none");
      
      }if($(this).val() == '0') {
        $(".active-mode2").addClass("d-none");
       
      }
    });
    $('.option-use3').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode3").removeClass("d-none");
      
      }if($(this).val() == '0') {
        $(".active-mode3").addClass("d-none");
       
      }
    });
  </script>


  <script>
    $('.radio-m-close').click(function() {
      $('.radio-modal').modal('hide');
    });
  </script>

<script type="text/javascript">
  function  openModel(argument) {
    if (argument=='insert') {
     // var originalModal = $('#editModal input').val('');
      
    }
    var fun="form_submit('"+argument+"')";
    
    $('#submit_btn').attr('onclick',fun)
    $('#editModal').modal('show');

  }

  function open_kenModel(type){
    $('.kingaku').each(function(i, obj) {
        $(this).attr('readonly','readonly')
    });
    
    $('.'+type).each(function(i, obj) {
        $(this).removeAttr('readonly')
    });

    var fun="validate_ken('"+type+"')"; 
    $('#ken_submit').attr('onclick',fun)
    $("body").addClass("modalOverflow");
    $('#radioModal').modal('show');
      

  }

  function open_detail(company)
  {

     var url="shipping/"+company;
       $.ajax({
            type: "GET",
            url: url,
            data: {company:company}, // serializes the form's elements.
            success: function(response)
            {
              var data=JSON.parse(response)
              
              $("select[name='name'] option[value='"+data[0].name+"'").attr('selected', 'selected');
              $("[name='name']").attr('disabled','true')

              console.log(data[0].name)
              $("#heading").text('配送設定')
              $("#submit_btn").text('変更')
              $("[name='alt_name']").val(data[0].name)
              
              if (data[0].normal_price) {
                $("#radio11").click()
                $("[name='normal_temp_price']").val(data[0].normal_price)
              }else{
                $("#radio12").click()
              }


              
              $("[name='cash_on_delivery_fee']").val(data[0].cash_on_delivery)

              if (data[0].delivery_duration) {
                var days=data[0].delivery_duration.split('/')
                $("[name='day_from']").val(days[0])
                $("[name='day_to']").val(days[1])
              }else{
                $("[name='duration_date']").val(0)
                $(".active-mode3").addClass("d-none");
              }

              if (data[0].delivery_time) {
                var times=data[0].delivery_time.split('/')
                console.log(times.length)
                for(var i=1; i< times.length;i++)
                {
                  var time=times[i].split('〜')
                  console.log(time)
                  $("#from_"+i).val(time[0].replace('時',''))
                  $("#to_"+i).val(time[1].replace('時',''))
                }
              
              }else{
                $("[name='delivery_time']").val(0)
                $(".active-mode2").addClass("d-none");
              }
              
              for (var i = 0; i < data[1].length; i++) {
                $("[name='normal["+data[1][i].kenmei+"]']").val(data[1][i].souryou0)
                $("[name='frozen["+data[1][i].kenmei+"]']").val(data[1][i].souryou1)
                $("[name='cold["+data[1][i].kenmei+"]']").val(data[1][i].souryou2)
              }
              openModel('edit')

              
            }
          });
       
  }

  function form_submit(argument) {
    var err_num= validation()
    var data = $( "#reg_form" ).serialize();
    var url="shipping/insert"
    if (err_num==0) {
      $.ajax({
           type: "POST",
           url: url,
           data: data, // serializes the form's elements.
           success: function(response)
           {
              if (response.trim()=='ok') {
                location.reload();
              }
              //console.log(response)
           }
         });
    }  
  }

  function validation()
  {
    var err_num=0;

       
       if($("#radio11").is(":checked") || $("#radio12").is(":checked")){
          $('#normal_err').text('')
          $('#check_msg_1').text('')
          if ($("#radio11").is(":checked")) {
            if(!$("[name='normal_temp_price']").val()){
              $("[name='normal_temp_price']").addClass('border-danger')
              $('#normal_err').text('対象が選択されていません。')
              err_num++
      
      
            }else{
              $("[name='normal_temp_price']").removeClass('border-danger')
            }
          }

          if ($("#radio12").is(":checked")) {
             var k=0;
             $('.normal').each(function(i, obj) {
                if(!$(this).val()){
                  k++;
                  $(this).addClass('border-danger')
                  err_num++
          
                }else{
                  $(this).removeClass('border-danger')
                }
            });
             if (k>0) {
              open_kenModel('normal')
            }
          }
       }else{
          $('#check_msg_1').text('必須項目に入力がありません。')
          err_num++
  
       }

       
       if(!$("[name='cash_on_delivery_fee']").val()){
           $("[name='cash_on_delivery_fee']").addClass('border-danger')
           err_num++
           $('#cash_on_msg').text('必須項目に入力がありません。')
       }else{
           $('#cash_on_msg').text('')
           $("[name='cash_on_delivery_fee']").removeClass('border-danger')
       }


       if ($('select[name="duration_date"]').val() == '1') {
          if(!$("[name='day_from']").val()){
           $("[name='day_from']").addClass('border-danger')
           err_num++
           $('#from_day_msg').text('必須項目に入力がありません。')
          }else{
              $('#from_day_msg').text('')
              $("[name='day_from']").removeClass('border-danger')
          }

          if(!$("[name='day_to']").val()){
            $("[name='day_to']").val(10)
           //$("[name='day_to']").addClass('border-danger')
           //err_num++
           //$('#to_day_msg').text('必須項目に入力がありません。')
          }else{
              $('#to_day_msg').text('')
              $("[name='day_to']").removeClass('border-danger')
          }
       }

       if ($('select[name="delivery_time"]').val() == '1') {
          if(!$("[id='from_1']").val()){
           $("[id='from_1']").addClass('border-danger')
           err_num++
           $('#time_msg_1').text('必須項目に入力がありません。')
          }else{
              $('#time_msg_1').text('')
              $("[id='from_1']").removeClass('border-danger')
          }

          if(!$("[id='to_1']").val()){
           $("[id='to_1']").addClass('border-danger')
           err_num++
    
          }else{
              $("[id='to_1']").removeClass('border-danger')
          }
       }

       for(var j=1; j<7; j++)
       {

          if (parseInt($("#from_"+j).val()) && !parseInt($("#to_"+j).val()))
          {
             $("#to_"+j).addClass('border-danger')
             $("#from_"+j).removeClass('border-danger')
             err_num++
             $('#time_msg_'+j).text('正しいデータを入力してください。')
          }else if(!parseInt($("#from_"+j).val()) && parseInt($("#to_"+j).val())){
             $("#from_"+j).addClass('border-danger')
             $("#to_"+j).removeClass('border-danger')
             err_num++
             $('#time_msg_'+j).text('正しいデータを入力してください。')
          }else if(parseInt($("#from_"+j).val()) && parseInt($("#to_"+j).val())){
             if (parseInt($("#from_"+j).val()) > 24) {
                $("#from_"+j).addClass('border-danger')
                err_num++
                $('#time_msg_'+j).text('正しいデータを入力してください。')
             }else{
                $('#time_msg_'+j).text('')
                $("#from_"+j).removeClass('border-danger')
             }

             if (parseInt($("#to_"+j).val()) > 24) {
                $("#to_"+j).addClass('border-danger')
                err_num++
                $('#time_msg_'+j).text('正しいデータを入力してください。')
             }else{
                $('#time_msg_'+j).text('')
                $("#to_"+j).removeClass('border-danger')
             }
             
             if(parseInt($("#to_"+j).val()) <= 24 && parseInt($("#from_"+j).val()) <= 24){
                if (parseInt($("#from_"+j).val())>=parseInt($("#to_"+j).val())) {
                $("#to_"+j).addClass('border-danger')
                $("#from_"+j).addClass('border-danger')
                err_num++
                $('#time_msg_'+j).text('正しいデータを入力してください。')
                }else{
                   $('#time_msg_'+j).text('')
                   $("#to_"+j).removeClass('border-danger')
                   $("#from_"+j).removeClass('border-danger')
                }
             }

             
          }
        
       }
       //cash_on_delivery_fee
       return err_num
  }

  function refresh()
  {
    location.reload();
  }
</script>
</body>
</html>
