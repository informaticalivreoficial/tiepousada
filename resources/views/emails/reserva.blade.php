<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pré-reserva - {{ $nome }}</title>
</head>

<body style="margin:0; padding:0; background:#f3f3f3; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f3f3f3; padding:20px 0;">
<tr>
<td>

<!-- Container -->
<table width="600" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 0 6px rgba(0,0,0,0.1);">

    <!-- Header Verde -->
    <tr>
        <td style="background:#1FAE66; color:#fff; padding:20px;">
            <table width="100%">
                <tr>
                    <td style="font-size:22px; font-weight:bold;">
                        Pré-reserva - {{ $nome }}
                    </td>
                    <td style="text-align:right; font-size:16px;">
                        Enviada {{ date('d/m/Y') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Código da Reserva (Amarelo) -->
    <tr>
        <td style="padding:20px;">
            <div style="background:#FFF8D1; border-left:5px solid #F2C200; padding:15px; font-size:18px; font-weight:bold; margin-bottom:20px; border-radius:4px;">
                Código da reserva: <span style="color:#B28900;">{{ $codigo }}</span>
            </div>

            <!-- Título -->
            <h2 style="font-size:20px; background:#eee; padding:10px; margin:0 0 10px;">Detalhes da Reserva</h2>

            <!-- Tabela -->
            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:15px;">
                <tr style="background:#1FAE66; color:#fff;">
                    <th style="text-align:center;">Check-in</th>
                    <th style="text-align:center;">Check-out</th>
                    <th style="text-align:center;">Tipo</th>
                    <th style="text-align:center;">Qtd.</th>
                </tr>

                <tr style="background:#f9f9f9;">
                    <td style="text-align:center;">{{ $checkin }}</td>
                    <td style="text-align:center;">{{ $checkout }}</td>
                    <td style="text-align:center;">Adultos</td>
                    <td style="text-align:center;">{{ $adultos }}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align:center;">Crianças 0 a 5 anos</td>
                    <td style="text-align:center;">{{ $criancas }}</td>
                </tr>

                <tr style="background:#FFE3E3; color:#A30000; font-weight:bold;">
                    <td></td>
                    <td></td>
                    <td style="text-align:center;">Total</td>
                    <td style="text-align:center;">{{ $criancas + $adultos }}</td>
                </tr>
            </table>

            <!-- Dados do Cliente -->
            <h2 style="font-size:20px; background:#eee; padding:10px; margin-top:20px;">Dados do Cliente</h2>

            <p style="font-size:15px; line-height:1.6;">
                <strong>Responsável:</strong> <span style="color:#1FAE66;">{{ $nome }}</span><br>
                <strong>E-mail:</strong> <span style="color:#1FAE66;">{{ $email }}</span><br>
                <strong>Telefone:</strong> <span style="color:#1FAE66;">{{ $telefone }}</span><br>
                <strong>Observações:</strong><br>
                <div style="background:#f9f9f9; padding:10px; border-left:4px solid #ccc; margin-top:8px;">
                    {{ $mensagem }}
                </div>
            </p>

            <!-- Botão Ação -->
            <p style="text-align:center; margin-top:25px;">
                <a href="{{ route('login') }}" 
                   style="background:#1FAE66; color:white; padding:12px 25px; border-radius:4px; text-decoration:none; font-weight:bold;">
                    Gerenciar Reservas
                </a>
            </p>

        </td>
    </tr>

    <!-- Rodapé -->
    <tr>
        <td style="background:#333; color:#fff; text-align:center; padding:15px; font-size:12px;">
            Sistema desenvolvido por {{ env('DESENVOLVEDOR') }}<br>
            <a href="mailto:{{ env('DESENVOLVEDOR_EMAIL') }}" style="color:#F2C200;">{{ env('DESENVOLVEDOR_EMAIL') }}</a>
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>