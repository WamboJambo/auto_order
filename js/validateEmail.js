$(document).ready(function() {
    $('#subscribe').submit(function() {
        if (!valid_email_address($("#email").val()))
        {
           $(".message").html('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>The email address you entered was invalid. Please make sure you enter a valid email address to subscribe.</div>');  
        }
        else
        {
            
            $(".message").html('<div class="alert alert-info fade in" role="alert">Adding your email address...</div>');
            $.ajax({
                url: '/includes/subscribe.php', 
                data: $('#subscribe').serialize(),
                type: 'POST',
                success: function(msg) {
                    if(msg=="success")
                    {
                        $("#email").val("");
                        $(".message").html('<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>You have successfully subscribed to our mailing list.</div>');
                        
                    }
                    else
                    {
                      $(".message").html('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>The email address you entered was invalid. Please make sure you enter a valid email address to subscribe.</div>');  
                    }
                }
            });
        }

        return false;
    });
});
function valid_email_address(email)
{
    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    return pattern.test(email);
}
