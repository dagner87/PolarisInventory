<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <style type="text/css">

    ::selection { background-color: #E13300; color: white; }
    ::-moz-selection { background-color: #E13300; color: white; }

    body {
        background-color: #FFF;
        margin: 40px;
        font: 16px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
        word-wrap: break-word;
    }

    a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
    }

    h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 24px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 16px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
    }

    #body {
        margin: 0 15px 0 15px;
    }

    p.footer {
        text-align: right;
        font-size: 16px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
    }

    #container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
    }
    </style>
</head>
<body>

<div id="container">
    <h1>Welcome to CodeIgniter!</h1>

    <div id="body">

        <form id="add_penvio" action="<?= base_url() ?>" method="POST">
            
            <input type="text" name="nombre">
            <button type="submit">ENviar</button>
        </form>

        <ul id="message">
           
        </ul>

       

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '' ?></p>
</div>

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script type="text/javascript">
     $('#add_penvio').submit(function(e) {
            e.preventDefault();
            var url = '<?php echo base_url() ?>welcome/process'; 
            var data = $('#add_penvio').serialize();
            $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        $("#add_penvio")[0].reset();
                        console.log("enviando....");
                        
                      }
                 })
                  .done(function(data){
                    console.log(data);

                  })
                  .fail(function(){
                    
                  }) 
                  .always(function(){
                    
                  });
        });

       // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('65b03e0e93aaecc887ae', {
          cluster: 'us2',
          forceTLS: true
        });

        var channel = pusher.subscribe('rrhhv2');
        channel.bind('my-event', function(data) {
          //alert(JSON.stringify(data));
          $('#message').append(' <li>'+data.message+'</li>');
        });
    


</script>
 


</body>
</html>
