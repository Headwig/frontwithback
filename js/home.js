var receiver;
function showCountries(){
    $("#count_list").css({"display":"block"});
   
};
function hideCountries(){
    $("#count_list").css({"display":"none"});
}
function setUser(obj){
    $("#user_inf").css({"display":"none"});
    $("#selected").attr('name', obj.value);
    $("#selected").attr('value', obj.value);
    $("#selected").html(obj.value);
    $("#selected").css({"display":"block"})
    receiver = obj.value;
    alert(receiver);
    $.ajax({
        type: 'POST',
        data : {receive:receiver},
        url: 'home.php',
        success: function(data){
            alert("Data sent");
        }
    });
}
function getVal(){
    return receiver;
}
function sendMessage(){
    alert("fcgfc");
    var a=$("#sender").val();
    var b=$("#message").val();
    var c=$("#veb").val();
    var d=$("#rec").val();
    $.ajax({
        type: 'GET',
        data: {sender:a, message:b, veb:c, rec:d},
        url: 'chit_data.php',
        success: function(data){
            alert(a+" "+d+" "+b+" "+c);
        }
    });
};