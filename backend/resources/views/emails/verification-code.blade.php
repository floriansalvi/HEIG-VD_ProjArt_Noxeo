<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>B League - Verification Code</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 40px; text-align: center;">
                    
                    {{-- Logo ou titre --}}
                    <tr>
                        <td style="font-size: 28px; font-weight: bold; color: #09091a; padding-bottom: 20px;">
                            B League
                        </td>
                    </tr>

                    {{-- Titre --}}
                    <tr>
                        <td style="font-size: 20px; color: #09091a; padding-bottom: 10px;">
                            Welcome to B League!
                        </td>
                    </tr>

                    {{-- Message --}}
                    <tr>
                        <td style="font-size: 16px; color: #072c54; padding-bottom: 20px;">
                            You recently registered on our platform. Here is your verification code:
                        </td>
                    </tr>

                    {{-- Code --}}
                    <tr>
                        <td style="font-size: 32px; font-weight: bold; color: #09091a; background-color: #ffda44; padding: 20px;">
                            {{ $code }}
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="font-size: 14px; color: #072c54; padding-top: 30px;">
                            — The B League Team
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
