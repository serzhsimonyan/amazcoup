<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amazcoup</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
          rel="stylesheet">

</head>
<body style="margin: 0 ; padding: 0;">
<div style="
    min-width: 60vh;
    min-height: 60vh;
    background: #a5abb2;
    font: 16px Montserrat;
    color: #545454;">
    <table style="
        background-color: #fff;
        min-width: 1140px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        padding: 40px 50px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    ">
        <tr>
            <td href="#" style="
                        display: block;
                        text-align: center;
                    ">
                <img src="{{asset('images/logo.png')}}" alt="Amazvol" style="max-width: 200px">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p style="margin-bottom: 30px;">New Message</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-bottom: 5px">
                    First-name: {{$client['first_name']}}
                </p>
                <p style="margin-bottom: 5px">
                  Last-name: {{$client['last_name']}}
                </p>
                <p style="margin-bottom: 20px">
                  Email: {{$client['email']}}
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-bottom: 5px">
                    Message:
                </p>
                <p style="margin-bottom: 20px;">
                    {{$client['contact_message']}}
                </p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>