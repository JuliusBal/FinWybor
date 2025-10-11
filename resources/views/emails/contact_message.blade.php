<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>FinWybor – New message</title>
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
                    <td style="padding:26px 26px 10px 26px;">
                        <h1 style="margin:0 0 10px 0;font-size:22px;line-height:1.35;color:#0f172a;">
                            New contact message
                        </h1>

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate;border-spacing:0 8px;margin-top:8px;">
                            <tr>
                                <td style="width:160px;font-size:13px;color:#64748b;">Name</td>
                                <td style="font-size:14px;color:#0f172a;font-weight:700;">{{ $data['name'] ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td style="width:160px;font-size:13px;color:#64748b;">Email</td>
                                <td style="font-size:14px;color:#0f172a;">
                                    @php $addr = $data['email'] ?? null; @endphp
                                    @if($addr)
                                        <a href="mailto:{{ $addr }}" style="color:#0ea5e9;text-decoration:underline;">{{ $addr }}</a>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:160px;font-size:13px;color:#64748b;">Received</td>
                                <td style="font-size:14px;color:#0f172a;">{{ now()->format('Y-m-d H:i') }}</td>
                            </tr>
                        </table>

                        @if(!empty($data['email']))
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin-top:14px;">
                                <tr>
                                    <td align="left" style="border-radius:10px;background:#f24f09;">
                                        <a href="mailto:{{ $data['email'] }}?subject=Re:%20FinWybor%20contact"
                                           style="display:inline-block;padding:10px 16px;font-size:14px;color:#ffffff;text-decoration:none;font-weight:700;">
                                            Reply
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 26px 4px 26px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                               style="border:1px solid #e5e7eb;border-radius:12px;background:#f8fafc;">
                            <tr>
                                <td style="padding:14px 16px;">
                                    <p style="margin:0 0 6px 0;font-weight:700;font-size:14px;color:#0f172a;">Message:</p>
                                    <p style="margin:0;font-size:14px;white-space:pre-line;color:#0f172a;">
                                        {{ $data['message'] ?? '' }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding:14px 26px 20px 26px;">
                        <p style="margin:0;font-size:12px;color:#64748b;">
                            Note: reply directly to the sender. This email was sent from the FinWybor.pl contact form.
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
                        <a href="{{ url('/') }}" style="color:#475569;text-decoration:underline;">Home</a> ·
                        <a href="{{ route('privacy') }}" style="color:#475569;text-decoration:underline;">Privacy</a> ·
                        <a href="{{ route('terms') }}" style="color:#475569;text-decoration:underline;">Terms</a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
