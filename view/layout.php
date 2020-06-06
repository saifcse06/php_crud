<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul ?></title>
    <link href="http://localhost/php_crud/asset/css/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <style>
          #buyer-form label.error {
              color: red;
              font-weight: bold;
          }
          .main {
              width: 600px;
              margin: 0 auto;
          }
          ..display-error{
              color: red;
          }

      </style>
  </head>
  <body>
    <div class="container">
        <div class="display-error"></div>
        <?= $isi ?>
    </div>
    <script src="http://localhost/php_crud/asset/js/jquery.min.js"></script>
    <script src="http://localhost/php_crud/asset/css/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <!-- Download the latest minified version of jQuery -->
<!--    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
-->    <!-- Download the latest jquery.validate minfied version -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
        $.datepicker.setDefaults({
            showOn: "button",
            buttonImage: "http://localhost/php_crud/asset/images/datepicker.png",
            buttonText: "Date Picker",
            buttonImageOnly: true,
            dateFormat: 'dd-mm-yy'
        });
        $(function() {
            $("#post_at").datepicker();
            $("#post_at_to_date").datepicker();
        });
    </script>
    <!-- Adding some custom styles -->
    <script type="application/javascript"> 
        $().ready(function() {
            
            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
            $('#phone').focus(function(){
                if($(this).val().substring(0,3) !== '880'){
                    $(this).val("880" + $(this).val());
                }
            });
            $.getJSON('https://httpbin.org/ip', function(data) {
                console.log(data['origin']);
                $("#buyer_id").val(data['origin']);

            }); 
            $("#buyer-form").validate({ 
                rules : { 
                    name : { 
                        required : true, 
                        maxlength : 20
                    },
                    email : {
                        required : true, 
                        email : true
                    },
                    phone : {
                        required : true,
                        digits : true,
                        minlength : 11,
                        maxlength : 20
                    },
                    city : {
                        required : true,
                        lettersonly : true
                    },
                    receipt_id : {
                        required : true,
                        lettersonly : true
                    },
                    items : {
                        required : true,
                        lettersonly : true
                    },
                    amount : {
                        required : true,
                        digits : true,
                        minlength : 1,
                    }, 
                    note : {
                        required : true,
                        maxlength : 30
                    },
                    entry_by : {
                        required : true,
                        digits : true
                    }
                },
                // Setting error messages for the fields
                messages: {
                    name: {
                        required: "Required full name",
                        maxlength: "Maximum Character Length 20"
                    },
                    email: "Enter valid email address",
                    phone: {
                        required: "Required phone number",
                        digits: "Only number allow",
                        minlength: "Minimum number length is 12",
                        maxlength: "Maximum number length is 20"
                    },
                    city : {
                        required : "Required city name"
                    },
                    receipt_id : {
                        required : "Required receipt number"
                    },
                    items : {
                        required : "Required Items", 
                    },
                    amount: {
                        required : "Required amount field",
                        digits : "Only number allow",
                        minlength : "Enter minimum amount"
                    },
                    note: {
                        required : "Required note",
                        maxlength : "Maximum Character Length 30"
                    },
                    entry_by : {
                        required : "Required Entry By ID",
                        digits : "Only number allow",
                    }
                },
                // Setting submit handler for the form
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            $("form").trigger("reset");
                            $('#answers').html(response.msg);
                        }
                    });
                }
            }); 
          
        });
    </script>
  </body>
</html>