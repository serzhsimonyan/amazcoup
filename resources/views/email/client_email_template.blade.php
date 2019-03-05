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
    min-width: 100vh;
    min-height: 100vh;
    background: #a5abb2;
    font: 16px Montserrat;
    color: #545454;">
    <table style="
        background-color: #fff;
        max-width: 1140px;
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
                <p style="margin-bottom: 30px;">Lorem Ipsum</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-bottom: 20px">
                Рespected {{$client['first_name'].'  '.$client['last_name']}}
                </p>
                <p style="margin-bottom: 20px">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores atque, cupiditate explicabo
                    impedit inventore nemo nisi nulla odit perferendis placeat, quae, qui ratione unde. At blanditiis et
                    ipsam odio repellat?
                </p>
            </td>
        </tr>

        <tr>
            <td>
                <p style="line-height: 1.5; margin-top: 50px">
                    Regards, <br/>
                    AmazCoup Team <br/>
                    https:/www.amazcoup.com
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="line-height: 1.5;">
                    <a href="#" style="text-decoration: none" title="Facebook">
                        <img src="{{asset('images/fb-icon.png')}}" alt="Amazcoup Facebook">
                    </a>
                    <a href="#" style="text-decoration: none" title="Twitter">
                        <img src="{{asset('images/tweet-icon.png')}}" alt="Amazcoup twitter">
                    </a>
                    <a href="#" style="text-decoration: none" title="Instagram">
                        <img src="{{asset('images/insta-icon.png')}}" alt="Amazcoup Instagram">
                    </a>
                </p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>