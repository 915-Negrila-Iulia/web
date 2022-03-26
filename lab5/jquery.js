$(document).ready(function (){
        $("#form-2").hide();
        $("#grey-div").hide();
});

$(function(){
   $("#button-1").click(function (event){
       event.preventDefault();
       $("#form-2").show();
       $("#form-2").css({
           position: "absolute",
           top: "50%",
           left: "50%",
           transform: "translate(-50%, -50%)",
           background: "white"});
       $("#grey-div").show();
       $("#grey-div").blur();
       $("#grey-div").css({
           position: "absolute",
           top:"0",
           height: "100%",
           width: "100%",
           background: "lightgrey", opacity: "0.1"});
       $("#form-1 input").attr("disabled", "disabled");
   });
});

$(function(){
   $("#button-2").click(function(event){
       event.preventDefault();
       $("#form-2 input").each(function (){
           $("#text-area").append($(this).val());
           $(this).val('');
       });
       $("#form-2").hide();
       $("#grey-div").hide();
       $("#form-1 input").removeAttr("disabled");
   });
});
