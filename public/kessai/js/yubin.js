function check_post_code(check_yubin01, check_yubin02, form_name){

	var data_yubin01 = '';
	var data_yubin02 = '';
	var send_yubin_bango = '';
	
	var address_str = '';
	var prefecture_str = '';
	var city_str = '';

	data_yubin01 = get_yubin_sub(check_yubin01);
	data_yubin02 = get_yubin_sub(check_yubin02);
	
	if(data_yubin01.length > 0 ){
		send_yubin_bango = data_yubin01;
	}
	if( data_yubin02.length > 0 ){
		send_yubin_bango = send_yubin_bango + data_yubin02;
	}
	
	if( send_yubin_bango != '' ){
		
		var xmlhttp;
		
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			if (window.ActiveXObject){
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}else{
				xmlhttp = null;
			}
		}

		if (xmlhttp){
			var domain_tmp = document.URL
			var domain_url = domain_tmp.match(/^(http.+)(cgi-bin|spd)/)[0];
			domain_url = domain_url.replace(/cgi-bin/, "spd");
			var get_addr_url = domain_url + '/http_yubin_get.cgi';

			var pass = 'colgis.co.jp';
			var post_code = send_yubin_bango;

			var send_url = get_addr_url + '?' + 'PASSWORD=' + pass + '&' + 'YUBINBANGO=' + post_code;

		    xmlhttp.open('GET', send_url, true);
		    xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					var LF = String.fromCharCode(10);

					var row_str = xmlhttp.responseText;
					var row_ary = row_str.split(LF);
					
					for (var i=0; i<row_ary.length; i++){
						
						var ary = row_ary[i].split('==');

						if( ary[0] == 'get_addr' ){
							address_str = ary[1];
							prefecture_str = address_str.split(' ')[0];
							for(i=1;i<address_str.split(' ').length;i++) {
								city_str = city_str + address_str.split(' ')[i]
							}
						}
						
					}
					if ( address_str != '' ) {
						document.delivery_form.submit();
						return false;
					} else {
						alert('郵便番号を正しく入力してください。');
					}
					
				}
			}
			
			xmlhttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
			xmlhttp.send(null);
			
		}
	} else {
		alert('郵便番号を正しく入力してください。');
	}
}



function html_get_address(check_yubin01, check_yubin02, set_prefecture, set_city){

	var data_yubin01 = '';
	var data_yubin02 = '';
	var send_yubin_bango = '';
	
	var address_str = '';
	var prefecture_str = '';
	var city_str = '';

	data_yubin01 = get_yubin_sub(check_yubin01);
	data_yubin02 = get_yubin_sub(check_yubin02);
	
	if(data_yubin01.length > 0 ){
		send_yubin_bango = data_yubin01;
	}
	if( data_yubin02.length > 0 ){
		send_yubin_bango = send_yubin_bango + data_yubin02;
	}
	
	if( send_yubin_bango != '' ){
		
		var xmlhttp;
		
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			if (window.ActiveXObject){
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}else{
				xmlhttp = null;
			}
		}

		if (xmlhttp){
			var domain_tmp = document.URL
			var domain_url = domain_tmp.match(/^(http.+)(cgi-bin|spd)/)[0];
			domain_url = domain_url.replace(/cgi-bin/, "spd");
			var get_addr_url = domain_url + '/http_yubin_get.cgi';

			var pass = 'colgis.co.jp';
			var post_code = send_yubin_bango;

			var send_url = get_addr_url + '?' + 'PASSWORD=' + pass + '&' + 'YUBINBANGO=' + post_code;

		    xmlhttp.open('GET', send_url, true);
		    xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					var LF = String.fromCharCode(10);

					var row_str = xmlhttp.responseText;
					var row_ary = row_str.split(LF);
					
					for (var i=0; i<row_ary.length; i++){
						
						var ary = row_ary[i].split('==');

						if( ary[0] == 'get_addr' ){
							address_str = ary[1];
							prefecture_str = address_str.split(' ')[0];
							for(i=1;i<address_str.split(' ').length;i++) {
								city_str = city_str + address_str.split(' ')[i]
							}
						}
						
					}
					
					if( (set_prefecture != '') && (prefecture_str != '') ){
						set_text_data(set_prefecture, prefecture_str);
					}
					if( (set_city != '') && (city_str != '') ){
						set_text_data(set_city, city_str);
					}
					
				}
			}
			
			xmlhttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
			xmlhttp.send(null);

			
			
		}
	}

}




function set_text_data(text_id, text_value){
	
	var check_id = document.getElementById(text_id);
	if( check_id ){
		check_id.value = text_value;
	}
}

function get_yubin_sub(check_yubin){

	var yubin_data = '';

	var check_id_y01 = document.getElementById(check_yubin);
	if( check_id_y01 ){
		
		var check_str = check_id_y01.value;
		check_str = check_str.replace(/[^0-9]/g, "");
		
		if( check_str.length > 0 ){
			yubin_data = check_str;
		}
	}

	return yubin_data;
}

function form_submit() {
	if ( $('#alt_delivery_1').attr('checked') ) {
		check_post_code( 'post_c1_alt', 'post_c2_alt', 'delivery_form');
	} else {
		check_post_code( 'post_c1', 'post_c2', 'delivery_form');
	}
}

