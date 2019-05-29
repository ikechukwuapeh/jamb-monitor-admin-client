$(document).ready(function(){
    var form = document.getElementById('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "inc/processor.php", true);
        ajax.onload = function(e) {
            if (ajax.responseText == "Yes") {
                $("#error").html("User created successfully").delay(10000);
                location.href = 'users';
            }else{
                $("#error").html(ajax.responseText);
            }
        };
        ajax.send(new FormData(form));
    },false);
})