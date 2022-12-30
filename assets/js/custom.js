//Change bg of radio buttons if checked
$('input:radio[name="unit"]').change(
    function(){
    $('input:radio[name="unit"]').parent().css("background-color","#e5e5e5");
    $('input:radio[name="unit"]').parent().css("color","var(--dark)");
    if ($(this).is(':checked')) {
        $(this).parent().css("background-color","var(--primary)");
        $(this).parent().css("color","var(--white)");
    }
});

//Change border & color if image input field got changed
$('input:file[name="image"]').change(
    function(){
        $(this).parent().css("border","2px dotted var(--primary)");
        $(this).parent().css("color","var(--primary)");
});


//Ajax
$(".add").click(function() {
    event.preventDefault();
    let serialize = new FormData($("form")[0]);
    serialize.append('FormType', "Add_Product");
    $.ajax({
    type: "POST",
    url: "./root/",
    data: serialize,
    cache: false,
    contentType: false,
    processData: false,
    success: function(message){
            popup(message);
            setTimeout(function(){$('body').load(window.location.href + '#body')}, 5000);
        }
    });
});


//Search
$(".search").click(function() {
    let search_value = $('input:text[name="search"]').val();
    if (search_value != ""){
        $.ajax({
        type: "POST",
        url: "./root/",
        data: "FormType=search&search_value="+search_value,
        success: function(message){
                message.match(/failure:/g) ? popup(message) : $(".cards").fadeOut(10).html(message).fadeIn(500);
            }
        });
    }
});



//Popup messages
function popup(message){
    var popup = document.createElement("div");
    popup.setAttribute("id","popup");
    popup.setAttribute("class","show");
    if (message.match(/success:/g)){ 
        popup.innerHTML = message.replace(/success:/g,"<i class='fa fa-check-circle-o'></i>");
        popup.classList.add("success");
    } else {
        popup.innerHTML = message.replace(/failure:/g,"<i class='fa fa-times-circle-o'></i>");
        popup.classList.add("failure");
    }
    document.body.appendChild(popup);
    setTimeout(function(){
            popup.className = popup.className.replace("show", "");
            popup.remove();
            }, 5000);
    return 1;
}



//Detect ESC keys
document.addEventListener("keydown", ({key}) => {
    if (key === "Escape"){
        window.location.href="#";
    }
});
