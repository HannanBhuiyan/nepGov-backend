@extends('layouts.backend.backend-app')


@section('content')

<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Template</li>  
            </ol>
        </nav>

        <div class="card p-3 mt-4"> 
            <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                    <h3>Template</h3>
                </div>
                
            </div>
        </div>

    </div>
</div>

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
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/images/brand/favicon.ico" />

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
    <div class="row">
        <div class="col-6">

            <!-- top gap table -->
            <table style="height: 40px; ">
                <tr>
                    <td>
                        <h1 class="ml-5 text-info" style="margin-left:50px">Verify Registration</h1>
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
                                <td>
                                    
                                </td>
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
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="text-align: center;"><img src="https://i.postimg.cc/YqNN1nRR/lock.png" alt=""></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- lock -->

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

            <!-- title -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="width: 40px;"></td>
                                <td style="text-align: center; font-size: 28px; font-weight: 600;">Enter this verification code to create your NepGov account :</td>
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

            <!-- verification code -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="text-align: center; font-size: 34px; font-weight: bold;">Token</td>
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
                                <td style="text-align: center; font-size: 16px; font-weight: 500;">You're receiving this code because your email was entered on the NepGov website 
                                    at <a href="https://nepgov.vercel.app/loginPage">account.nepgov.com</a> If this was not you, please ignore this email - no account will created. </td>
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
                                <td style="font-size: 16px; color: gray"><a style="color: gray;" href="https://nepgov.vercel.app/privacyPolicyPage" class="pb-5">Privacy</a> </td>
                                <td style="width: 40px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- footer main -->

            <!-- top gap table -->
            <table style="height: 40px; ">
                <tr>
                    <td>

                    </td>
                </tr>
            </table>
            <!-- top gap table -->
        </div>
        <div class="col-6">
        
            <!-- top gap table -->
            <table style="height: 40px; ">
                <tr>
                    <td>
                        <h1 class="ml-5 text-info" style="margin-left:50px">Forget Password</h1>
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

            <!-- title -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="width: 40px;"></td>
                                <td style="text-align: center; font-size: 20px; font-weight: 700;">You can reset password from bellow link:-</td>
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

            <!-- verification code -->
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width: 100%; max-width: 650px; margin: auto; background: #fff;">
                            <tr>
                                <td style="text-align: center; font-size: 30px; font-weight: bold;"><a href="">Reset Password</a></td>
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

            <!-- footer-->

            <!-- top gap table -->
            <table style="height: 40px; ">
                <tr>
                    <td>

                    </td>
                </tr>
            </table>
            <!-- top gap table -->

        </div>
    </div>

    </body>
    </html>


@endsection

@section('scripts')


    
@endsection
