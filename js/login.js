$(function(){
    $(".name input").focus(function(){
        $(this).prev("i").css({"background-image":"url(../../imgs/user2.png)"});
    });
    $(".name input").blur(function(){
        $(this).prev("i").css({"background-image":"url(../../imgs/user1.png)"});
    });
    $(".password input").focus(function(){
        $(this).prev("i").css({"background-image":"url(../../imgs/password2.png)"});
    });
    $(".password input").blur(function(){
        $(this).prev("i").css({"background-image":"url(../../imgs/password1.png)"});
    });
});