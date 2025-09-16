<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invitation - USNEWS Portal</title>
</head>

<body
    style="margin:0; padding:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color:#f4f6f8;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0; background-color:#f4f6f8;">
        <tr>
            <td>
                <table align="center" width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:15px; overflow:hidden; box-shadow:0 8px 20px rgba(0,0,0,0.08); font-size:16px; line-height:1.5; color:#333;">

                    <!-- Header -->
                    <tr>
                        <td
                            style="background:linear-gradient(135deg,#004080,#1a75ff); text-align:center; padding:35px 20px;">
                            <h1 style="margin:0; font-size:30px; color:#fff;">Welcome to <span
                                    style="color:#ffcc00;">USNEWS</span></h1>
                            <p style="margin:8px 0 0; font-size:16px; color:#e0e7f1;">Your trusted digital news platform
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px 30px;">
                            <h2 style="margin-top:0; color:#004080; font-size:22px;">Hello {{ $maildata['name'] }},</h2>
                            <p style="margin:15px 0; font-size:16px;">
                                You’ve been invited to join <strong>USNEWS Portal</strong> as a
                                <span style="color:#004080;"><b>{{ $maildata['role'] }}</b></span>.
                            </p>
                            <p style="margin:15px 0; font-size:16px;">
                                To get started, please set your password and complete your registration.
                            </p>

                            <!-- Call to Action -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ url('/accept-invite/' . $maildata['token']) }}"
                                    style="background:linear-gradient(135deg,#004080,#1a75ff); color:#ffffff; text-decoration:none; padding:14px 28px; border-radius:50px; font-size:16px; font-weight:bold; display:inline-block; transition: all 0.3s;">
                                    Set Your Password & Join
                                </a>
                            </div>

                            <div class="my-2">
                                <!-- Expiration Notice -->
                                @if (isset($maildata['expires_at']))
                                    <p style="margin:15px 0; font-size:14px; color:#d9534f; font-weight:bold;">
                                        ⚠️ Please note: This invitation will expire on
                                        {{ \Carbon\Carbon::parse($maildata['expires_at'])->format('F j, Y, g:i A') }}.
                                    </p>
                                @endif
                            </div>

                            <p style="font-size:14px; color:#555; margin-top:30px;">
                                If you did not expect this invitation, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background:#f0f2f5; text-align:center; padding:25px 20px; font-size:12px; color:#777;">
                            <p style="margin:0;">&copy; {{ date('Y') }} USNEWS. All rights reserved.</p>
                            <p style="margin:5px 0 0;">
                                <a href="#" style="color:#004080; text-decoration:none;">Visit Website</a> |
                                <a href="#" style="color:#004080; text-decoration:none;">Contact Support</a>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
