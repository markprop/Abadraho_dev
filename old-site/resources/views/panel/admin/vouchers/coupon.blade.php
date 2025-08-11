<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css?v=1670420084">

    <style>
        body {
            font-family: Arial;
        }
        .coupon {
            border: 5px dotted #bbb;
            width: 80%;
            border-radius: 15px;
            margin: 0 auto;
            max-width: 600px;
        }
        .container {
            padding: 2px 16px;
            background-color: #f1f1f1;
        }
        .promo {
            background: #ccc;
            padding: 3px;
        }
        .expire {
            color: red;
        }
        .units-span{
            padding: 2px 6px;
            line-height: 24px;
            border-radius: 4px;
            background-color: #eb1f29;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            position: relative;
            white-space: pre;
        }
    </style>
</head>

<body>
    <div class="coupon">
        <div class="container">
            <img src="https://abadraho.com/assets/images/admin_logo.png" alt="Avatar"
                style="width:300px; margin-left:auto; margin-right:auto; display:block;">
        </div>
        <!-- <img src="/{{ $voucher->project->project_cover_img }}" alt="Avatar" style="width:100%;"> -->
        <div class="container" style="background-color:white">
       
            {{-- <h2><b> {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $voucher->discount_value) }} OFF on {{ $voucher->project->name }}</b></h2> --}}
            <?php
                if($voucher->discount_by == "amount"){
                    $voucher_value = "PKR.".$voucher->discount_value;
                }
                else{
                    $voucher_value = $voucher->discount_value."%";
                }
            ?>
            <h2><b>{{ $voucher_value }} OFF on {{ $voucher->project->name }}</b></h2>

            @foreach ($voucher->units_voucher as $voucher_unit)
                <span class="units-span">{{ $voucher_unit->unit->title }}</span>
            @endforeach

            <p>Username: {{ $user->first_name }} {{ $user->last_name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Phone: {{ $user->phone_number }}</p>
        </div>
        <div class="container">
            <p>Use Voucher Code: <span class="promo">{{ $code }}</span></p>
            <p class="expire">Expires: {{ date("d-M-Y", strtotime($voucher->expires_at)); }}</p>
        </div>
    </div>
    <br><br>
    <div class="coupon" style="border: none;">
        {{-- @if (!$isDownload) --}}
            {{-- <a href="/projects/generate-voucher/{{ $voucher->project_id }}?download=1" class="download-now"
                style="background-color: #ec1c24; border: 2px solid #ec1c24; border-radius: 5px; color: #fff; text-align: center; vertical-align: middle; font-size: 1rem; line-height: 1.5; padding: 10px 30px;"
                data-toggle="modal" data-target="#myModal">Download Now</a> --}}
        {{-- @endif --}}
    </div>
</body>

</html>
