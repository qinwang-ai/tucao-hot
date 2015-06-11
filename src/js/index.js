$(function(){
    var w = $(window).width();
    $('.sider_').css('right',(w-1000)/2+15);
    var h_nav = $(".navbar").height();
    $(".logoheader").css("margin-top",h_nav);
});


//=========================================up  down==================
url = "/index.php/item/Updown/";

function ding( id){
    //event.cancelBubble = true;
    var st2 = "#item" + id + "  .label";        //.button

    if($(st2).hasClass('disabled'))return false;
    var st1 = "#item" + id + "  .up";        //.button
    $.get(url+id+"/1",function(data){
        var tmp = '<i class="thumbs up outline icon"></i>'+data;
        $( st1).html(tmp);

    });

    $( st2).addClass("disabled");

}

function cai( id){
    //event.cancelBubble = true;
    var st2 = "#item" + id + "  .label";        //.button
    if($( st2).hasClass('disabled'))return false;
    var st1 = "#item" + id + "  .down";        //.button
    $.get(url+id+"/0",function(data){         //type == 0  repesent cai
        var tmp = '<i class="thumbs down outline icon"></i>'+data;
        $( st1).html(tmp);
    });

    $( st2).addClass("disabled");
}

//=========================================up  down==================

// top right conner
var paras = {};
		QC.api("get_user_info", paras)
		.success(function(s){//成功回调
			$(".qqname span").text(s.data.nickname);
            $(".qqname img").attr('src',s.data.figureurl);
		})
		.error(function(f){//失败回调
			alert("获取用户信息失败！");
		})
		.complete(function(c){//完成请求回调
		});

$('.tucaoimg').click(function(){
    //event.cancelBubble = true;
    window.open($(this).attr("src"));
})

$('.logoheader').click(function(){
    location.href = "http://tucao-hot.com/index.php/site/index";
})
