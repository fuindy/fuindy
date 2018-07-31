<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

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

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
            .btn {
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                letter-spacing: 0.01em;
                -webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-font-feature-settings: "kern" 1;
                -moz-font-feature-settings: "kern" 1;
                margin-bottom: 0;
                border: 1px solid #f2f4f5;
                text-align: center;
                vertical-align: middle;
                cursor: pointer;
                border-radius: 3px;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                background-image: none !important;
                color: #7a8994;
                background-color: #fff;
                text-shadow: none;
                box-shadow: none;
                line-height: 21px;
                position: relative;
                transition: color 0.1s linear 0s, background-color 0.1s linear 0s, opacity 0.2s linear 0s !important;
                padding: 6px 17px;
            }
            .btn:hover {
                background-color: #fafafa;
                border: 1px solid rgba(122, 137, 148, 0.27);
                color: #333;
            }
            .btn.active {
                border-color: #eaecee;
                background: #fff;
                color: #333;
            }
            .btn:focus,
            .btn:active:focus,
            .btn.active:focus {
                outline: none !important;
                outline-style: none;
                color: #333;
            }
            .btn-primary,
            .btn-primary:focus {
                color: #fff;
                background-color: #007be8;
                border-color: #007be8;
            }
            .btn-primary.active,
            .btn-primary:active,
            .btn-primary.active:focus,
            .btn-primary:active:focus,
            .btn-primary:active:hover,
            .show .dropdown-toggle.btn-primary {
                background-color: #0064bc;
                border-color: #0064bc;
                color: #fff;
            }
            .btn-primary.hover,
            .btn-primary:hover,
            .show .dropdown-toggle.btn-primary {
                background-color: #3395ed;
                border-color: #3395ed;
                color: #fff;
            }
            .btn-primary.active:hover {
                background: #006ac8;
                border-color: #006ac8;
            }
            .btn-info,
            .btn-info:focus {
                color: #fff;
                background-color: #47525e;
                border-color: #47525e;
            }
            .btn-info.active,
            .btn-info:active,
            .btn-info.active:focus,
            .btn-info:active:focus,
            .btn-info:active:hover,
            .show .dropdown-toggle.btn-info {
                background-color: #3a424c;
                border-color: #3a424c;
                color: #fff;
            }
            .btn-info.hover,
            .btn-info:hover,
            .show .dropdown-toggle.btn-info {
                background-color: #6c757e;
                border-color: #6c757e;
                color: #fff;
            }
            .btn-info.active:hover {
                background: #3d4751;
                border-color: #3d4751;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('message')
                </div>
                <button class="btn" id="btn-home" onclick=" window.location.href='/'">Home</button>
            </div>
        </div>
    </body>
</html>
