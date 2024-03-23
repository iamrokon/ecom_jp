function setOperate(){
	setView();
	var agent = navigator.userAgent;
	if(agent.search(/iPhone/) != -1){
		$("body").addClass("iphone"); //iPhoneには「body class="iphone"」追加
		window.onorientationchange = setView;
	}else if(agent.search(/iPad/) != -1){
		$("body").addClass("ipad"); //iPadには「body class="ipad"」追加
		window.onorientationchange = setView;
	}else if(agent.search(/Android/) != -1){
		$("body").addClass("android"); //Androidには「body class="android"」追加
		window.onresize = setView;
	}else{
		$("body").addClass("other"); //上記以外には「body class="other"」追加
		window.onorientationchange = setView;
	}
}
function setView(){
	var orientation = window.orientation;
	if(orientation === 0){
		$("body").addClass("portrait"); //画面が縦向きの場合は「body class="portrait"」追加
		$("body").removeClass("landscape"); //画面が縦向きの場合は「body class="landscape"」削除
	}else{
		$("body").addClass("landscape"); //画面が横向きの場合は「body class="landscape"」追加
		$("body").removeClass("portrait"); //画面が横向きの場合は「body class="portrait"」削除
	}
}

function changeWidth() {
	if ( $(window).width() > 1023 ) {
//		$('#main_column, #sub_column').tile(2);
		$('.item_list').each(function() {
			$(this).find('li').tile(4);
		});
		$('.item_category ul li').each(function() {
			if ( $(this).find('a').length == 0 ) {
				$(this).remove();
			}
		});
	} else if ( $(window).width() > 479 ) {
//		$('#main_column, #sub_column').tile(1);
		$('.item_list').each(function() {
			$(this).find('li').tile(2);
		});
		$('.item_category > ul').each(function() {
			var n = 3 - ($(this).children('li').length) % 3;
			if ( n < 3 ) {
				for ( i=0; i<n; i++ ) {
					$(this).append('<li><span>&nbsp;</span></li>');
				}
			}
		});
	} else {
//		$('#main_column, #sub_column').tile(1);
		$('.item_list').each(function() {
			$(this).find('li').tile(1);
		});
		$('.item_category > ul').each(function() {
			var n = 3 - ($(this).children('li').length) % 3;
			if ( n < 3 ) {
				for ( i=0; i<n; i++ ) {
					$(this).append('<li><span>&nbsp;</span></li>');
				}
			}
		});
	}
	$('#cart .cart_list').each(function() {
		$(this).find('.price, .qty, .delete').tile(4);
		$(this).find('.total th, .total td').tile(2);
	});
	$('#cart_confirm .cart_list, #history_detail .cart_list').each(function() {
		$(this).find('.price, .qty').tile(3);
		$(this).find('.total th, .total td').tile(2);
	});

}


$(function() {
	//jsとcssをキャッシュさせない　ここから
	var today = new Date();
	myYear = String(today.getFullYear());
	myMonth = String(today.getMonth() + 1);
	if ( today.getMonth() + 1 < 10 ) {
		myMonth = '0' + myMonth;
	}
	myDate = String(today.getDate());
	if ( today.getDate() < 10 ) {
		myDate = '0' + myDate;
	}
	myHours = String(today.getHours());
	if ( today.getHours() < 10 ) {
		myHours = '0' + myHours;
	}
	myMinutes = String(today.getMinutes());
	if ( today.getMinutes() < 10 ) {
		myMinutes = '0' + myMinutes;
	}
	mySeconds = String(today.getSeconds());
	if ( today.getSeconds() < 10 ) {
		mySeconds = '0' + mySeconds;
	}
	var myTime = myYear + myMonth + myDate + myHours + myMinutes + mySeconds;

/*
	$('link[rel="stylesheet"]').each(function() {
		var filePath = $(this).attr('href');
		$(this).attr('href', filePath + '?t=' + myTime );
	});

	$('script').each(function() {
		var filePath = $(this).attr('src');
		if ( filePath ) {
			$(this).attr('src', filePath + '?t=' + myTime );
		}
	});
*/
	//jsとcssをキャッシュさせない　ここまで

	setOperate();

	$('#top_main ul').each(function() {
		if ( $(this).find('li').length > 1 ) {
			$(this).bxSlider({
				auto: true
			});
		}
	});
	$(window).on('load', function() {
		changeWidth();

		$('#top_main ul').each(function() {
			if ( $(this).find('li').length > 1 ) {
				if ( !$(this).parents().hasClass('bx-wrapper') ) {
					$(this).bxSlider({
						auto: true
					});
				}
			}
		});
	});

	setTimeout(function() {
		changeWidth();
	}, 1000);

	if ( $('body').hasClass('android') || $('body').hasClass('other') ) {
		$(window).resize(function(){
			changeWidth();
		});
	} else {
		$(window).bind("orientationchange",function(){
			changeWidth();
		});
	}

/*
	$('#sp_menu_trigger a').each(function() {
		for ( i=0; i<3; i++ ) {
			$(this).append('<span></span>\n');
		}
	});
*/

	$('#sp_menu_trigger a').click(function() {
		$(this).toggleClass('active');
		$('#sp_nav').animate({width: 'toggle'});
	});

	$('.btn.login a').click(function() {
		$(this).parents('form').submit();
	});

	$('.item_list li').each(function() {
		if ( $(this).find('.usual_price').length > 0 ) {
			var usualPrice = Number($(this).find('.usual_price').text().replace(/\D/g, ''));
			var salePrice = Number($(this).find('.sale_price').text().replace(/\D/g, ''));
			if ( salePrice == 1 ) {
				$(this).find('.sale_price').text('時価');
				$(this).find('.icons').prepend('<div class="icon_current_price">時</div>\n');
			}
			if ( usualPrice <= salePrice ) 	{
				$(this).find('.usual_price').remove();
			} else {
				$(this).find('.item_name').addClass('sale');
				$(this).find('.icons').prepend('<div class="icon_sale">特</div>');
			}
		}
		if ( $(this).find('.item_name').text().match('【不定貫】') ) {
			$(this).find('.icons').append('\n<div class="icon_by_weight">不</div>');
		}
		if ( $(this).find('.point_rate span').text() == '0' ) {
			$(this).find('.point_rate').remove();
		}

	});


	$('.item_detail .item_info .price').each(function() {
		if ( $(this).find('.usual_price').length > 0 ) {
			var usualPrice = Number($(this).find('.usual_price').text().replace(/\D/g, ''));
			var salePrice = Number($(this).find('.sale_price em').text().replace(/\D/g, ''));
			if ( salePrice == 1 ) {
				$(this).find('.sale_price').text('時価');
				$(this).parent('.item_info').find('.icons').prepend('<div class="icon_current_price">時価</div>');
			}
			if ( usualPrice <= salePrice ) 	{
				$(this).find('.usual_price').remove();
			} else {
				$(this).parent('.item_info').find('.icons').prepend('<div class="icon_sale">特売</div>');
			}
		}
		if ( $(this).find('.point span').text() == '0' ) {
			$(this).find('.point').remove();
		}
	});



	if ( $('#subcategory_list li').length > 0 ) {
		for ( i=0; i<$('#subcategory_list li').length; i++ ) {
			var catURL = $('#subcategory_list li').eq(i).find('a').attr('href');
			var catName = $('#subcategory_list li').eq(i).find('a').text();
			$('.page_control .subcategory').append('<option value="' + catURL + '">' + catName + '</option>');
		}
	} else {
		$('.page_control .subcategory').remove();
	}

	$('.page_number').each(function() {
		var pageHTML = $(this).html();
		$(this).html(pageHTML.replace(/｜/g, '').replace(/<b>/g, '<li class="num">'));
	});

	$('.page_number .prev a, .page_number .next a').each(function() {
		$(this).text('.....');
	});

	$('.calendar .next_month iframe').each(function() {
		if ( myMonth == '12' ) {
			nextYear = String(Number(myYear) + 1);
			nextMonth = '01';
		} else {
			nextYear = myYear;
			nextMonth = String(Number(myMonth) + 1);
			if ( Number(myMonth) + 1 < 10 ) {
				nextMonth = '0' + nextMonth;
			}
		}
		var datesParam = nextYear + nextMonth + '01';
		$(this).attr('src', $(this).attr('src') + '&dates=' + datesParam + '/' + datesParam);
	});

	$('.whatsnew table th').each(function() {
		var wMonth = '';
		if ( $(this).text().split('-')[1] == '01' ) {
			wMonth = 'Jan';
		}else if ( $(this).text().split('-')[1] == '02' ) {
			wMonth = 'Feb';
		}else if ( $(this).text().split('-')[1] == '03' ) {
			wMonth = 'Mar';
		}else if ( $(this).text().split('-')[1] == '04' ) {
			wMonth = 'Apr';
		}else if ( $(this).text().split('-')[1] == '05' ) {
			wMonth = 'May';
		}else if ( $(this).text().split('-')[1] == '06' ) {
			wMonth = 'Jun';
		}else if ( $(this).text().split('-')[1] == '07' ) {
			wMonth = 'Jul';
		}else if ( $(this).text().split('-')[1] == '08' ) {
			wMonth = 'Aug';
		}else if ( $(this).text().split('-')[1] == '09' ) {
			wMonth = 'Sep';
		}else if ( $(this).text().split('-')[1] == '10' ) {
			wMonth = 'Oct';
		}else if ( $(this).text().split('-')[1] == '11' ) {
			wMonth = 'Nov';
		}else if ( $(this).text().split('-')[1] == '12' ) {
			wMonth = 'Dec';
		}
		var wDay = $(this).text().split('-')[2];
		$(this).text(wMonth + ' ' + wDay);
	});

	var domainURL = String(document.URL).split('/cgi-bin/')[0];
	var httpURL = String($('#header h1 a').attr('href')).split('/cgi-bin/')[0];
	$('body').append('<iframe id="ifm_category" src="' + domainURL + '/cgi-bin/db_category_list.cgi?q=a.html" style="display: none;"></iframe>');
	$('#ifm_category').on('load', function() {
		var idoc = $(this).contents().text();
		var data = JSON.parse(idoc);
		for ( i=0; i<data.categories.length; i++ ) {
			category1name = data.categories[i].category_name;
			if ( category1name == '商品別検索' ) {
				data.categories[i].category2.sort(function(a,b) {
					if ( Number(a.sort_index) < Number(b.sort_index) ) return -1;
					if ( Number(a.sort_index) > Number(b.sort_index) ) return 1;
				});
				for ( j=0; j<data.categories[i].category2.length; j++ ) {
					category2name = data.categories[i].category2[j].category_name;
					category2URL = data.categories[i].category2[j].url;
					if ( j == 0 ) {
						$('.item_category > ul').append('<li class="sale"><a href="' + httpURL + category2URL + '">' + category2name + '</a><ul></ul></li>');
					} else {
						$('.item_category > ul').append('<li><a href="' + httpURL + category2URL + '">' + category2name + '</a><ul></ul></li>');
					}
					if ( data.categories[i].category2[j].category3 ) {
						data.categories[i].category2[j].category3.sort(function(a,b) {
							if ( Number(a.sort_index) < Number(b.sort_index) ) return -1;
							if ( Number(a.sort_index) > Number(b.sort_index) ) return 1;
						});
						$('.item_category > ul > li').each(function() {
							if ( $(this).find('a').text() == category2name ) {
								for ( k=0; k<data.categories[i].category2[j].category3.length; k++ ) {
									category3name = data.categories[i].category2[j].category3[k].category_name;
									category3URL = data.categories[i].category2[j].category3[k].url;
									$(this).find('ul').append('<li><a href="' + httpURL + category3URL + '">' + category3name + '</a></li>');
								}
								$(this).hover(function() {
									$(this).find('ul').toggleClass('active');
								});
							}
						});
					}
				}
			}
		}
	});

	$('.modal_close a, .modal_contents .btn .back a, .modal_overlay').click(function() {
		$('.modal_window, .modal_overlay').fadeOut();
	});

});
