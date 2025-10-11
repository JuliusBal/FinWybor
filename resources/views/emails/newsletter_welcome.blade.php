<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>FinWybor – Dziękujemy za zapis</title>
</head>
<body style="margin:0;padding:0;background:#eef3f8;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef3f8;">
    <tr>
        <td align="center" style="padding:28px 12px;">

            <!-- Header -->
            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;">
                <tr>
                    <td align="center" style="padding:10px 20px;border-radius:12px;background:linear-gradient(135deg,#383d42 0%,#1f2327 100%);box-shadow:0 10px 30px rgba(24,24,24,.25);">
                        <a href="{{ url('/') }}" target="_blank"
                           style="display:inline-block;text-decoration:none;font-weight:700;font-size:18px;color:#ffffff;font-family:Arial,Helvetica,sans-serif;">
                            FinWybor<span style="color:#f24f09">.pl</span>
                        </a>
                    </td>
                </tr>
            </table>

            <!-- Card -->
            <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                   style="max-width:600px;width:100%;margin-top:16px;background:#ffffff;border-radius:16px;box-shadow:0 8px 28px rgba(2,6,23,.10);">
                <tr>
                    <td style="padding:26px;">
                        <h1 style="margin:0 0 10px 0;font-size:22px;line-height:1.35;color:#0f172a;">
                            Dziękujemy za zapis!
                        </h1>
                        <p style="margin:0 0 12px 0;font-size:14px;">Dodaliśmy Twój adres do naszego newslettera. Od czasu do czasu wyślemy Ci krótkie, konkretne treści o finansach i przydatnych ofertach.</p>

                        <p style="margin:0 0 12px 0;font-size:14px;">Jeśli to nie Ty zapisałeś się na newsletter, możesz w każdej chwili zrezygnować jednym kliknięciem:</p>

                        <!-- Unsubscribe button -->
                        <table role="presentation" cellpadding="0" cellspacing="0" style="margin:14px 0 8px 0;">
                            <tr>
                                <td align="left" style="border-radius:10px;background:#f24f09;">
                                    <a href="{{ route('newsletter.unsubscribe', $sub->token) }}"
                                       style="display:inline-block;padding:10px 16px;font-size:14px;color:#ffffff;text-decoration:none;font-weight:700;">
                                        Wypisz się
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:16px 0 0 0;font-size:12px;color:#64748b;">
                            Ten e-mail został wysłany na adres: <strong>{{ $sub->email }}</strong>.
                        </p>
                    </td>
                </tr>
            </table>

            <!-- Footer -->
            <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                   style="max-width:600px;width:100%;margin:18px auto 10px auto;">
                <tr>
                    <td align="center" style="font-size:12px;color:#64748b;padding:6px 10px;">
                        © {{ date('Y') }} FinWybor.pl ·
                        <a href="{{ route('newsletter.unsubscribe', $sub->token) }}" style="color:#475569;text-decoration:underline;">Wypisz się</a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
