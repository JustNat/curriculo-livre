<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Candidatura</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Olá, {{ $name }}!</h2>

    <p>Recebemos sua candidatura com sucesso. Aqui estão os detalhes que você enviou:</p>

    <table style="border-collapse: collapse; width: 100%; max-width: 600px;">
        <tr>
            <td style="padding: 8px; font-weight: bold;">Cargo desejado:</td>
            <td style="padding: 8px;">{{ $desiredRole }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 8px; font-weight: bold;">Nível de escolaridade:</td>
            <td style="padding: 8px;">{{ $educationLevel }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; font-weight: bold;">Observações:</td>
            <td style="padding: 8px;">{{ $observations ?: 'Nenhuma' }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 8px; font-weight: bold;">Endereço IP:</td>
            <td style="padding: 8px;">{{ $ip }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">
        Obrigado por se candidatar!<br>
        Atenciosamente,<br>
        {{ config('app.name') }}
    </p>
</body>
</html>
