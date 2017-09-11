
$(function () {
  var teg,
      str;
  $("a[class='clvis']").bind('click', function(){
      $("#content_events").css("display","none");
      $("#concreat_events").css("display","block");
      $("#back").css("display","block");
          /*teg = this.href.indexOf('#');
          str = this.href;
      $("a[name='"+str+"']").removeClass();
      console.log($("a[name='"+str+"']"));*/

  });


  $("#back").bind('click', function(){
    /*$("#content_events").css("display","block");
    $("a[class='clvisible']").css("display","none");
    $("#back").css("display","none");*/
    $("#content_events").css("display","block");
    $("#concreat_events").css("display","none");
    $("#back").css("display","none");
  });
    

});
