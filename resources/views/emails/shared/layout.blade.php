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
                        <td style="padding: 40px 20px 30px 40px; border: 5px solid #333333;">
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

                                <!-- ------------------------------------------ 
                                    Email:: Footer
                                ------------------------------------------ -->
                                <tr>
                                    <td style="padding:30px;background:#ee4c50;">
                                        <table role="presentation"
                                            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                            <tr>
                                                <td style="padding:0;width:50%;" align="left">
                                                    <p
                                                        style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                                        &reg; Someone, Somewhere 2021<br /><a href="http://www.example.com"
                                                            style="color:#ffffff;text-decoration:underline;">Unsubscribe</a>
                                                    </p>
                                                </td>
                                                <td style="padding:0;width:50%;" align="right">
                                                    <table role="presentation"
                                                        style="border-collapse:collapse;border:0;border-spacing:0;">
                                                        <tr>
                                                            <td style="padding:0 0 0 10px;width:38px;">
                                                                <a href="http://www.twitter.com/" style="color:#ffffff;"><img
                                                                        src="https://assets.codepen.io/210284/tw_1.png"
                                                                        alt="Twitter" width="38"
                                                                        style="height:auto;display:block;border:0;" /></a>
                                                            </td>
                                                            <td style="padding:0 0 0 10px;width:38px;">
                                                                <a href="http://www.facebook.com/" style="color:#ffffff;"><img
                                                                        src="https://assets.codepen.io/210284/fb_1.png"
                                                                        alt="Facebook" width="38"
                                                                        style="height:auto;display:block;border:0;" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
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
