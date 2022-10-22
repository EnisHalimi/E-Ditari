var myVar;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

if(window.location.href.indexOf("login") > -1) {
    function myFunction() {
        myVar = setTimeout(showPage, 2000);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }

    document.addEventListener('DOMContentLoaded', function() {
        myFunction();
    });


    document.querySelector('.img-btn').addEventListener('click', function () {
        document.querySelector('.cont').classList.toggle('s-signup')
    });



    $("#login-form").submit(function(event){
        event.preventDefault();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        $("#server-results").html("");
        $("#server-results").attr("hidden", true);
        $.ajax({
            url: '\login',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    window.location = '/home';
                } else {
                    $("#server-results").removeAttr("hidden");
                    $("#server-results").html("Login Failed. Please check your data");
                }
            },
            error: function(data){
                    $("#server-results").removeAttr("hidden");
                    $("#server-results").html("Login Failed. Please check your data");
            }
        });
    });

}
