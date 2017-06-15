<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MUUCH Iluméxico</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 48px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            p {
                font-size: 21px;
                padding: 1em;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="http://muuch.dev/img/logo_h.png" alt="">
                    Te registraste a {{ config('app.name') }}
                    <img src="data:image/svg+xml;utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20d%3D%22M0%2011c2.76.575%206.312%201.688%209%203.438C12.157%2010.208%2017.828%206.25%2024%203c-5.86%205.775-10.71%2012.328-14%2018.917C7.35%2018.15%204.453%2014.647%200%2011z%22%2F%3E%3C%2Fsvg%3E" alt="swish  ">
                </div>

                <div class="box">
                   <div class="box-body">
                       <p>Por favor <strong>espera a que tu cuenta sea aprovada</strong>, te lo notificaremos al correo electrónico que registraste.</p>
                   </div>
                </div>
            </div>
        </div>
    </body>
</html>
