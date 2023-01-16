<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Student</title>
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">--}}


    <style>


        /*body {*/
        /*    text-align: center;*/
        /*}*/

        html {
            font-family: 'Cairo', sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        * {
            font-family: 'Cairo', sans-serif;
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
        .card{
            width: 80%;
            margin: 0 auto;
            border: 1px solid #33313136;
            direction: rtl;
            margin-top: 50px;
        }
        .card h4{
            font-size: 25px;
            color: black;
            font-family: 'Cairo', sans-serif;
            padding-top: 40px;
            padding-bottom: 40px;
            text-align: center;
        }
        .data_of_user{
            padding: 30px;
        }
        .card .form-group h3{
            display: inline-block;
            font-size: 27px;
            padding-left: 17px;
            font-family: 'Cairo', sans-serif;


        }

        .card .form-group{
            padding-bottom: 30px;
            display: inline-block;
        }
        .card .form-group span{
            display: inline-block;
            border-bottom: 1px solid;
            padding-bottom: 11px;
            font-family: 'Cairo', sans-serif;

        }
        .self_data{
            padding-bottom: 30px;
            padding-top: 20px;
        }
        .col-md-6{
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 46%;
            display: inline-block;
        }
        .col-md-12{
            padding-right: 15px;
            padding-left: 15px;
        }

        @media screen and (max-width:400px)
        {
            .container{
                height: 130vh;
            }
            .container .front{
                margin-top: 50px;
            }

            .card .form-group h3 {
                display: inline-block;
                font-size: 17px;
                padding-left: 10px;
                font-family: 'Cairo', sans-serif;
            }
        }

        @media screen and (max-width:600px)
        {
            .container{
                height: 130vh;
            }
            .container .front{
                margin-top: 50px;
            }

        }

    </style>
</head>
<body>

<div class="content-wrapper container-md mt-5">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="app-user-list">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-1">
                        <div class="col-12 align-content-center">
                            <h4 class="mb-1">
                                <img src="{{ public_path('app-assets\images\logo\logo.png') }}" alt="">
                                <br>
                                <span class="align-middle">مدرسة تعليم سياقة</span>
                            </h4>
                        </div>

                    <div class="data_of_user">
                        <h2 class="self_data">المعلومات الشخصية</h2>
                        <div class="col-lg-3 col-md-12">
                            <div class="form-group">
                                <h3> الاسم كامل</h3>
                                <span>{{$student->getFullname()}}</span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <h3>رقم البطاقة</h3>
                                <span>{{$student->card_id}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <h3>رقم الجوال</h3>
                                <span>{{$student->mobile}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <h3>تاريخ الميلاد</h3>
                                <span>{{$student->birth_date}}</span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <h3>الجنس</h3>
                                <span>{{$student->gender}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <h3>المدينة</h3>
                                <span>{{$student->cities->name}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <h3>المحافظة</h3>
                                <span>{{$student->town}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="form-group">
                                <h3>العنوان</h3>
                                <span>{{$student->address}}</span>
                            </div>
                        </div>

                    </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

</body>
</html>
