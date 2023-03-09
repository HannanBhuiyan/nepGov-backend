<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NevGov</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'DM Sans', sans-serif;
        }

        body{
            background: #ccc;
        }

        table{
        border-collapse: collapse;
        }

        td{
            padding: 0;
        }
        /* a{
            text-decoration: none;
            color: #666;
        } */



    </style>
</head>
<body>

    <!-- top gap table -->
    <table style="height: 40px; ">
        <tr>
            <td>

            </td>
        </tr>
    </table>
    <!-- top gap table -->


    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 30px; margin: auto; background: #fff;">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->

    
    <!-- template header -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                    <tr>
                        <td style="width: 200px;"></td>
                        <td style="text-align: center;"><a style=" color:tomato; font-size: 30px; font-weight: 600;" href="#!"><img src="https://i.postimg.cc/9fQBXdGp/Logo.png" alt=""></a></td>
                        <td style="width: 200px;"></td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
    <!-- template header -->


    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 40px; margin: auto; background: #fff;">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->


    <!-- lock -->
    {{-- <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                    <tr>
                        <td style="text-align: center;"><img src="https://i.postimg.cc/YqNN1nRR/lock.png" alt=""></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> --}}
    <!-- lock -->


    <!-- padding -->
    {{-- <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 40px; margin: auto; background: #fff;">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> --}}
    <!-- padding -->


    <!-- title -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                    <tr>
                        <td style="width: 40px;"></td>
                        <td style="text-align: center; font-size: 20px; font-weight: 700;">Are you interested to share your opinion on this Topics:</td>
                        <td style="width: 40px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- title -->


    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 30px; margin: auto; background: #fff;">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->

    @php
        $poll_cat = App\Models\PollingCategory::where('slug',$slug)->first();
        $category_name = $poll_cat->category_name;
    @endphp
    <!-- verification code -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                    <tr>
                        <td style="text-align: center; font-size: 30px; font-weight: bold;">Category/Topic : {{ $category_name }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- verification code -->


    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 30px; margin: auto; background: #fff;">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->


    <!-- content -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                    <tr>
                        <td style="width: 40px"></td>
                        <td style="text-align: center; font-size: 20px; font-weight: 500;">
                            Please visit this site to share your opinion <br>
                            <a href="https://nepgov.vercel.app/normal-vote/{{ $slug }}">Click Here to Vote</a> <br><br>
                            {{-- <a href="{{route('normal_voting', $slug)}}">Click Here to Vote</a> <br><br> --}}
                            <span style="text-align: center; font-size: 15px; font-weight: 300;"> If you are not interested, please ignore this email. </span>
                        </td>
                        <td style="width: 40px"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- content -->


    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 50px; margin: auto; background: #fff;">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->


    <!-- footer-->

    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 40px; margin: auto; background:#F8F7FC">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->


    <!-- footer main -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #F8F7FC;">
                    <tr>
                        <td style="width: 40px;"></td>
                        <td style="font-size: 14px; font-weight: 400; color: gray;">NepGov Service LTD </td>
                        <td style="width: 40px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 40px;"></td>
                        <td style="font-size: 14px; font-weight: 400; color: gray;">50 Block, NewYork City, NewYork, United State </td>
                        <td style="width: 40px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #F8F7FC;">
                    <tr>
                        <td style="height: 25px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; margin: auto; background: #F8F7FC;">
                    <tr>
                        <td style="width: 40px;"></td>
                        <td style="font-size: 16px; color: gray;"><a style="color: gray;" href="https://nepgov.vercel.app/privacyPolicyPage">Privacy</a> </td>
                        <td style="width: 40px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- footer main -->

    <!-- padding -->
    <table style="width: 100%;">
        <tr>
            <td>
                <table style="width: 100%; max-width: 650px; height: 40px; margin: auto; background:#F8F7FC">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- padding -->
    <!-- footer-->

    <!-- top gap table -->
    <table style="height: 40px; ">
        <tr>
            <td>

            </td>
        </tr>
    </table>
    <!-- top gap table -->



</body>
</html>
