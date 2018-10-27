$(document).ready(function() {
   console.log("click");

    $("#inputEmail").click();
    $("#inputPassword").click();
    console.log($("#inputEmail").val());
   $("#inputEmail").change(function(){
       console.log($("#inputEmail").val());
       // $("#inputEmail").click()
   });

   if($("#inputEmail").val()!="") {
       $("#inputPassword").click();
       console.log($("#inputEmail").val());
       $(".container").click();
   }
});
