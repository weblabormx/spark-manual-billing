<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #fff;
            background-image: none;
            font-size: 12px;
            font-family: Arial;
        }
        address{
            margin-top:15px;
        }
        h2 {
            font-size:28px;
            color:#cccccc;
        }
        .container {
            padding-top:30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .logo {
            padding-bottom: 10px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
        .well {
            margin-top: 15px;
        }
    </style>
</head>

<body>
<div class="container">
    <table style="margin-left: auto; margin-right: auto" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="right">
                <strong>{{ $details['vendor'] }}</strong>
            </td>
        </tr>
        <tr valign="top">
            <td style="font-size:28px;color:#cccccc;">
                    Receipt
            </td>

            <!-- Organization Name / Date -->
            <td>
                <br><br>
                <strong>To:</strong> {{ $invoice->user->email ?: $invoice->user->name }}
                <br>
                <strong>Date:</strong> {{ $invoice->created_at->format('F jS, Y') }}
            </td>
        </tr>
        <tr valign="top">
            <!-- Organization Details -->
            <td style="font-size:9px;">
                {{ $details['vendor'] }}<br>
                @if (isset($details['street']))
                    {{ $details['street'] }}<br>
                @endif
                @if (isset($details['location']))
                    {{ $details['location'] }}<br>
                @endif
                @if (isset($details['phone']))
                    <strong>T</strong> {{ $details['phone'] }}<br>
                @endif
                @if (isset($url))
                    <a href="{{ $url }}">{{ $url }}</a>
                @endif
            </td>
            <td>
                <!-- Invoice Info -->
                <p>
                    <strong>Product:</strong> {{ $details['product'] }}<br>
                    <strong>Invoice Number:</strong> {{ $invoice->id }}<br>
                </p>
                <br><br>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0">
                    <tr>
                        <th align="left">Description</th>
                        <th align="right">Date</th>
                        <th align="right">Amount</th>
                    </tr>

                    <!-- Existing Balance -->
                    <tr>
                        <td>Subscription</td>
                        <td>{{ $invoice->created_at->format('F jS, Y') }} to {{ $suscription->ends_at->format('F jS, Y') }}</td>
                        <td>{{ $invoice->total }}</td>
                    </tr>

                    <!-- Display The Final Total -->
                    <tr style="border-top:2px solid #000;">
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>Total</strong></td>
                        <td><strong>{{ $invoice->total }}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
