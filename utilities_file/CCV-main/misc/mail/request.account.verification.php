<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }

        .text-right {
            text-align: center;
            margin-top: 10%;
            margin-bottom: 10%;
        }

        #resetPassword {
            background-color: #FFC0CB;
            color: #EC1D87;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-family: Arial;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center"
                            style="padding:60px 0 60px 0;background-image: url('https://i.ibb.co/6FCPSS4/background.jpg')">
                            <img src="https://i.ibb.co/gTT566Z/Elevate-Her-Logo-Bold-Shadow.png" alt="ElevateHer"
                                width="300" style="height:auto;display:block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 10px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#111111;">
                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Hello
                                            <?php echo $username ?>,
                                        </h1>
                                        <p
                                            style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-indent:50px;">
                                            Thank you for creating an account with ElevateHer! To ensure
                                            the security of your account and activate its full functionality, please
                                            verify your account by clicking on the button below.</p>
                                        <div class="text-right"><a
                                                href="http://<?php echo $host ?>/ElevateHer/logic/account-verification.php?accountId=<?php echo $accountId ?>&token=<?php echo $token ?>"
                                                id="resetPassword" target="_blank">VERIFY YOUR ACCOUNT</a></div>
                                        <p
                                            style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            If you have any concerns or need assistance, please contact us at
                                            frenchcries12@gmail.com.</p>
                                        <p style="font-size:16px;margin:40px 0 20px 0;font-family:Arial,sans-serif;">
                                            Best Regards,</p>
                                        <p style="font-size:16px;margin:20px 0 20px 0;font-family:Arial,sans-serif;">
                                            ElevateHer Team</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:40px;background-image: url('https://i.ibb.co/6FCPSS4/background.jpg')">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p
                                            style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#EC1D87;">
                                            &copy; ElevateHer
                                            <?php echo date("Y") ?><br />
                                        </p>
                                    </td>
                                    <td style="padding:0;width:50%;" align="right">
                                        <table role="presentation"
                                            style="border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="mailto:frenchcries12@gmail.com"><img
                                                            src="https://i.ibb.co/gTT566Z/Elevate-Her-Logo-Bold-Shadow.png"
                                                            alt="ElevateHer" width="100"
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
</body>

</html>