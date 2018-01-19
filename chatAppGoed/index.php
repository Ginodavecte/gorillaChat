<?php
// allow cross domain requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, X-Request');
?>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link type="text/css" rel="stylesheet" href="style.css" />
    <!--    <script src="http://malsup.github.com/jquery.form.js"></script>-->
</head>

<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome to a kind of chatroom <b></b></p>
        <p class="logout"><a id="exit" href="https://www.fcgroningen.nl">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>

    <div id="chatbox">

    </div>

    <form id="message" onsubmit="return false">
        <input type="text" id="message_value"  size="63" />
        <input type="hidden" id="mykey" value="Gino" >
        <button id="submitmsg" value="write">Write</button>
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">

    //jQuery
    $(document).ready(function() {
        $('#message').submit(function (e) {
            e.preventDefault();
            var mykey = $('#mykey').val();
            var message = $('#message_value').val();
            //var data = 'action=write&mykey='+ encodeURIComponent(mykey)+ '&name='+ encodeURIComponent(name); // 'id='+ encodeURIComponent(id) + '&name='+ encodeURIComponent(name)
            var data = "action=write&mykey="+ encodeURIComponent(mykey)+ "&value="+ encodeURIComponent(message);
            $.ajax({
                type:"GET",
                cache:false,
                url:"https:www.codegorilla.nl/read_write/api.php",
                data:data,    // multiple data sent using ajax
                success: function (html) {

                    // $('#message').val('data sent sent');
                    // $('#msg').html(html);
                }
            });
            return false;
        });
    });




    var mykey = document.getElementById('mykey').value;

    $.ajax({ type: "GET",
        url: "https://codegorilla.nl/read_write/api.php?action=list&mykey=" + mykey,
        async: false,
        success : function(text)
        {
            var msgList = text.split(',');


            msgList.forEach(function(element) {
                $.ajax({ type: "GET",
                    url: "https://codegorilla.nl/read_write/api.php?action=read&mykey=" + mykey + "&id="+element,
                    async: false,
                    success : function(text)
                    {
                        $("#chatbox").append("<div class=\"msg\" data-id=\"" + element + "\"><span class=\"myKey\">" + mykey + "</span><span class=\"msgValue\">------>" + text + "</span> </div>");

                    }
                });

            });
        }
    });
</script>


