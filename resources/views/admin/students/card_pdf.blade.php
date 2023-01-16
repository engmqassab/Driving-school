<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>ID Card</title>
    <!--
        So lets start -->

    <style>


        body {
            text-align: center;
        }

        html {
            font-family: 'dejavu sans', sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        * {
            font-family: 'dejavu sans', sans-serif;
            margin: 00px;
            padding: 00px;
            box-sizing: content-box;
        }

        .container {
            height: 100%;
            width: 100%;
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
            background-color: #e6ebe0;
            flex-direction: row;
            flex-flow: wrap;
            text-align: center;

        }

        .font {
            height: 375px;
            width: 250px;
            position: relative;
            border-radius: 10px;
        }

        .top {
            height: 30%;
            width: 100%;
            background-color: #4a6772;
            position: relative;
            z-index: 5;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .bottom {
            height: 70%;
            width: 100%;
            background-color: white;
            position: absolute;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .top img {
            height: 100px;
            width: 100px;
            background-color: #e6ebe0;
            border-radius: 10px;
            position: absolute;
            top: 60px;
            left: 75px;
        }

        .bottom p {
            position: relative;
            top: 60px;
            text-align: center;
            text-transform: capitalize;
            font-weight: bold;
            font-size: 20px;
            text-emphasis: spacing;
        }

        .bottom .desi {
            font-size: 12px;
            color: grey;
            font-weight: normal;
        }

        .bottom .no {
            font-size: 15px;
            font-weight: normal;
        }

        .barcode img {
            height: 65px;
            width: 65px;
            text-align: center;
            margin: 5px;
        }

        .barcode {
            text-align: center;
            position: relative;
            top: 70px;
        }

        .back {
            height: 400px;
            width: 450px;
            border-radius: 10px;
            background-color: #4a6772;

        }

        .qr img {
            height: 80px;
            width: 100%;
            margin: 20px;
            background-color: white;
        }

        .Details {
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 25px;
        }


        .details-info {
            color: white;
            text-align: left;
            padding: 5px;
            line-height: 20px;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            line-height: 22px;
        }

        .logo {
            height: 40px;
            width: 150px;
            padding: 40px;
        }

        .logo p {
            height: 100%;
            width: 100%;
            color: white;

        }

        .padding {
            padding-right: 20px;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
</head>
<body>
<div class="page-break container">

    <div class="back">
        <h6 class="Details">{{$student->getFullname()}}</h6>
        <hr class="hr">
        <div class="details-info">
            <p><b>: رقم البطاقة</b></p>
            <p>{{$student->card_id}}</p>
            <p><b>: رقم الموبايل</b></p>
            <p>{{$student->mobile}}</p>
            <p><b>: العنوان</b></p>
            <p>{{$student->getFullAddress()}}</p>
            <p><b>: تاريخ الميلاد</b></p>
            <p>{{$student->birth_date}}</p>
            <p><b>: النوع</b></p>
            <p>{{$student->gender}}</p>
        </div>
        <hr class="hr">
        <h1 class="Details">مدرسة تعلم سواقه</h1>


        <hr>
    </div>
</div>
</body>
</html>
