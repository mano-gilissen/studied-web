<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ $subject }}</title>
    <style type="text/css">
        table {
            border-spacing: 0;
        }
        td {
            padding: 0;
        }
        img {
            border: 0;
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            .mobPadding { padding: 28px !important; }
            .wrapper { padding: 14px !important; }
        }
    </style>
</head>
<body style="margin: 0; background-color: #F2F5F3;">

<center class="wrapper" style="width: 100%;  table-layout: fixed; padding: 36px 0 32px; box-sizing: border-box;">
    <table class="main" width="100%" style="margin: 0 auto; max-width: 530px; width: 100%; border-spacing: 0; font-family: sans-serif; font-size: 13px; line-height: 22.8px; color: #1F1F1F;">
        <!--HEAD-->
        <tr>
            <td style="border-radius: 10px 10px 0px 0px; border: 1px solid white; background: #1F1F1F; padding: 35px; border-radius: 10px 10px 0 0" class="mobPadding">
                <table width="100%">
                    <tr>
                        <td align="center"><img width="154" style="width: 154px; height: auto; max-width: 100%;" width="502" src="{{ $message->embed(public_path() . '/images_app/logo-email.png') }}"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--BODY-->
        <tr>
            <td style="background-color: white; padding: 35px;" class="mobPadding">
                <table width="100%">

                    @yield('content')

                </table>
            </td>
        </tr>
        <!--FOOTER-->
        <tr>
            <td style="background-color: #F2F5F3; padding: 35px; border-radius: 0px 0px 10px 10px; border: 1px solid white;" class="mobPadding">
                <table width="100%">
                    <tr>
                        <td align="center"><p style="font-weight: bold; margin: 0 ; font-size: 13px; line-height: 21px;">Studied.</p></td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom: 14px;">
                            <a href="https://www.studied.nl" style="color: inherit;">
                                <p style="margin: 0 ; font-size: 13px; line-height: 21px;">www.studied.nl</p>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom: 14px;">
                            <p style="margin: 0 ; font-size: 13px; line-height: 21px;">Stationstraat 19 B02, 6221BN Maastricht</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="mailto:info@studied.nl" style="color: inherit;">
                                <p style="margin: 0 ; font-size: 13px; line-height: 21px;">info@studied.nl</p>
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
</body>
</html>
