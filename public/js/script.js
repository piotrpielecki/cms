$(document).ready(function () {

    $( ".carAccepted, .carNotAccepted" ).each(function(index) {
        //$(this).stopPropagation()
        $(this).on("click", function(e){
            e.stopPropagation()
            e.preventDefault()

            let element = $(this);
            $.ajax('/car/ajax/toogleConfirm',
                {
                    method: 'POST',
                    dataType: 'json',
                    data:{
                        'carId': $(this).data("id")
                    },
                    success: function (data,status,xhr) {
                        if (data.setTo) {
                            element.removeClass("carNotAccepted").addClass("carAccepted")
                        } else {
                            element.removeClass("carAccepted").addClass("carNotAccepted")
                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        console.log(errorMessage)
                    }
                });
        });
    });
});