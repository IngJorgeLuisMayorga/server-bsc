<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="background-color:white; width:602px;border-spacing:0;text-align:left;">

                    @include('emails.shared.header')

                    <tr>
                        <td style="padding: 40px 20px 30px 20px; border: 5px solid #333333;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">

                                <!-- ------------------------------------------ 
                                    Email::Header
                                ------------------------------------------ -->
                                <tr>
                                    <td>
                                        <table role="presentation"
                                            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td colspan="1" align="center" style="padding:0 0 36px 0;color:#153643;">
                                                    @yield('user_name')
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- ------------------------------------------ 
                                    Email::Order Date
                                ------------------------------------------ -->
                                <tr>
                                    <td style="padding:0;">
                                        @yield('order_date')
                                        <br>
                                        <br>
                                    </td>
                                </tr>

                                <!-- ------------------------------------------ 
                                    Email:: Products List
                                ------------------------------------------ -->
                                <tr style="padding-top:1em">
                                    <td>
                                        <table>
                                            @yield('order_products')
                                        </table>
                                    </td>
                                </tr>

                                <!-- ------------------------------------------ 
                                    Email:: Order Summary
                                ------------------------------------------ -->
                                <tr style="padding-top:1em">
                                    <td>
                                        <table style="width: 100%">
                                            @yield('order_total')
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    
                </table>
            </td>
        </tr>

        <!-- ------------------------------------------ 
            Email:: Footer
        ------------------------------------------ -->
        <tr>
            <td align="center" style="padding:0;">
                <table
                    style="
                    width:100%; border-collapse:collapse;
                    border:0; border-spacing:0;
                    font-size:9px; font-family:Arial,sans-serif; 
                    background:#535353; width:602px;
                    border-spacing:0;text-align:left;">
                    <tr>
                        <td style="padding: 20px;width:50%;padding-rigth:0px;" align="left">
                            <img src="{{ $HOST.'/images/emails/LOGOBLANCO.png' }}" alt="">
                        </td>
                        <td style="padding: 20px; width:50%;padding-left:0px;" align="right">
                            <h1 style="color: white">© 2022 BSC | <strong>Bubbles Skin Care</strong>
                                Todos los derechos reservados.</h1>
                            <table>
                                <tr>
                                    <td style="padding-right: 10px; border-right: 1px dotted white; padding-left: 10px">
                                        <a href="">
                                            <img style="width: 35px;" width="35px" src="{{ $HOST.'/images/emails/FACEBOOK1CORREO.png' }}" alt="">
                                        </a>
                                    </td>
                                    <td style="padding-right: 10px; border-right: 1px dotted white; padding-left: 10px">
                                        <a href="">
                                            <img style="width: 35px;" width="35px" src="{{ $HOST.'/images/emails/INSTAGRAM1CORREO.png' }}" alt="">
                                        </a>
                                    </td>
                                    <td style="padding-right: 10px; border-right: 0px dotted white; padding-left: 10px">
                                        <a href="">
                                            <img style="width: 35px;" width="35px" src="{{ $HOST.'/images/emails/TIKTOK1CORREO.png' }}" alt="">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
                                
    </table>
</body>

</html>
