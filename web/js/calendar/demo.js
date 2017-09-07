addEventListener('DOMContentLoaded', function () {
	pickmeup('.single', {
		flat : true
	});
	pickmeup('.multiple', {
		flat : true,
		mode : 'multiple'
	});
	pickmeup('.range', {
		flat : true,
		mode : 'range'
	});
	var plus_5_days = new Date;
	plus_5_days.setDate(plus_5_days.getDate() + 5);
	pickmeup('.three-calendars', {
		flat      : true,
		date      : [
			new Date,
			plus_5_days
		],
		mode      : 'range',
		calendars : 3
	});

	pickmeup('.date', {
		format	: 'Y-m-d'
	});

	
	var element = document.getElementById('my_date');
	var oldDate='';
	element.addEventListener('pickmeup-change', function (e) {
		//console.log(e.detail.formatted_date); // New date according to current format
		//console.log(e.detail.date);           // New date as Date object
		var date = e.detail.formatted_date;
		if(oldDate!=date) {
			oldDate = date;
			$.ajax({
				url: '/events',
				data: {date: date},
				type: 'POST',
				datatype: 'json',
				success: function (res) {
					//console.log('++++')
					//console.log(JSON.parse(res));
					//addTables(JSON.parse(res));
					goWriteEvents(JSON.parse(res));
				},
				error: function () {
					alert('Error!');
				}
			});
		}
	});


	function goWriteEvents(events) {

		console.log(events)
		$('.event').remove();
		
		for(var i =0; i< events.length; i++){
			$('.container_event').append("<div class=\"item_event event\">" +
					"<img  src=\" "+events[i].midimg + "\" >"+
					"<p class=\"header_txt_ev\"><a href=\"#id="+events[i].id+"\" class=\"clvis\" >"+
					events[i].title+"</a></p>"+
					"<p class=\"date_txt_ev\">"+formatDate(events[i].date)+"</p>"+
				"</div>");
		}
		 goCheck(events) ;

	}
	function formatDate(date) {
		var days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var mounts = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		day = days[new Date(date).getDay()]+', '+new Date(date).getDate()+' '+mounts[new Date(date).getMonth()];
		return day;
	}

	function goCheck(events) {

		$('.event a').bind('click',function () {
			var href = $(this).attr('href');

			for(var i =0; i< events.length; i++){
				if(href==('#id='+events[i].id)){
					$.ajax({
						url: '/get-img',
						data: {id: events[i].id},
						type: 'POST',
						datatype: 'json',
						success: function (res) {
							goWriteEvent(JSON.parse(res), events[i]);
						},
						error: function () {
							alert('Error!');
						}
					});
					break;
				}
			}

		});

	}
	function goWriteEvent(imgs, event) {
		console.log(imgs)
		console.log(event)

		$('.text_event p').remove();
		$('.con_event div').remove();

		$("#content_events").css("display","none");
		$("#concreat_event").css("display","block");
		$("#back").css("display","block");
		$("#back").bind('click',function () {
			$("#content_events").css("display","block");
			$("#concreat_event").css("display","none");
		});

		$(".text_event").append("<p class=\"header_txt_concr\">" +
			event.title+"</p>"+
			"<p class=\"date_txt_concr\">"+
				formatDate(event.date)+"</p>"+
			"<p class=\"inf_txt_concr\">"+
				event.descript+"</p>"
		);

		for(var i =0; i< imgs.length; i++) {
			$('.con_event').append("<div class=\"item_event\">"+
					" <img  src=\""+imgs[i].path+"\" ></div>"
			);
		}



	}



});




