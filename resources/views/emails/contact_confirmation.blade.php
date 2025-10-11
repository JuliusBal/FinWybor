<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>FinWybor</title>
</head>
<body style="margin:0;padding:0;background:#eef3f8;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef3f8;">
    <tr>
        <td align="center" style="padding:28px 12px;">

            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto; width:100%">
                <tr>
                    <td align="center" style="padding:10px 20px;border-radius:12px;background:linear-gradient(135deg,#383d42 0%,#1f2327 100%);box-shadow:0 10px 30px rgba(24,24,24,.25);">
                        <a href="{{ url('/') }}" target="_blank"
                           style="display:inline-block;text-decoration:none;font-weight:700;font-size:18px;color:#ffffff;font-family:Arial,Helvetica,sans-serif;">
                            FinWybor<span style="color:#f24f09">.pl</span>
                        </a>
                    </td>
                </tr>
            </table>

            <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                   style="max-width:600px;width:100%;margin-top:16px;background:#ffffff;border-radius:16px;box-shadow:0 8px 28px rgba(2,6,23,.10);">
                <tr>
                    <td style="padding:26px 26px 8px 26px;">
                        <h1 style="margin:0 0 10px 0;font-size:26px;line-height:1.3;color:#0f172a;">
                            Dziękujemy za kontakt
                        </h1>

                        <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 0 10px 0;">
                            <tr>
                                <td style="font-size:12px;color:#0f172a;background:#f4f6fb;border:1px solid #e6eaf2;border-radius:999px;padding:6px 10px;">Potwierdzenie</td>
                                <td style="width:8px;"></td>
                                <td style="font-size:12px;color:#0f172a;background:#f4f6fb;border:1px solid #e6eaf2;border-radius:999px;padding:6px 10px;">Odpowiadamy zwykle w 24h</td>
                            </tr>
                        </table>

                        <p style="margin:0 0 12px 0;font-size:14px;color:#0f172a;">
                            Cześć {{ $data['name'] ?? '' }},
                        </p>
                        <p style="margin:0 0 14px 0;font-size:14px;color:#0f172a;">
                            Otrzymaliśmy Twoją wiadomość i skontaktujemy się z Tobą tak szybko, jak to możliwe
                            (zwykle w ciągu 24 godzin).
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 26px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                               style="border:1px solid #e5e7eb;border-radius:12px;background:#f8fafc;">
                            <tr>
                                <td style="padding:14px 16px;">
                                    <p style="margin:0 0 6px 0;font-weight:700;font-size:14px;color:#0f172a;">Twoja wiadomość:</p>
                                    <p style="margin:0;font-size:14px;white-space:pre-line;color:#0f172a;">
                                        {{ $data['message'] }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding:12px 26px 0 26px;">
                        <p style="margin:12px 0 0 0;font-size:14px;color:#0f172a;">
                            Jeśli to nie Ty wysłałeś tę wiadomość, możesz ją zignorować.
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:16px 26px 22px 26px;">
                        <p style="margin:0;font-size:14px;color:#0f172a;">
                            Pozdrawiamy,<br>
                            <strong>Zespół FinWybor</strong>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 26px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="height:1px;background:linear-gradient(90deg,#e6eaf2, #f2f4f8, #e6eaf2);opacity:.9;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px 26px 18px 26px;">
                        <p style="margin:0;font-size:12px;color:#64748b;">
                            Ta wiadomość została wygenerowana automatycznie — prosimy na nią nie odpowiadać.
                        </p>
                    </td>
                </tr>
            </table>

            <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                   style="max-width:600px;width:100%;margin:18px auto 10px auto;">
                <tr>
                    <td align="center" style="font-size:12px;color:#64748b;padding:6px 10px;">
                        © {{ date('Y') }} FinWybor.pl
                    </td>
                </tr>
                <tr>
                    <td align="center" style="font-size:12px;color:#64748b;padding:0 10px 20px 10px;">
                        <a href="{{ url('/') }}" style="color:#475569;text-decoration:underline;">Strona główna</a> ·
                        <a href="{{ route('privacy') }}" style="color:#475569;text-decoration:underline;">Prywatność</a> ·
                        <a href="{{ route('terms') }}" style="color:#475569;text-decoration:underline;">Regulamin</a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
