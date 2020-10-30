<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Fonts -->
        <title>@yield('title','Laravel')</title>
       
        
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color:black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                /* background-image: linear-gradient(-30deg, black, transparent); */
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #sidebar-wrapper{
                position: fixed;
                top: 0;
                bottom: 2.5em;
                height: 100%;
            }

        </style>
    </head>
    <body >
        <nav class="navbar navbar-expand-lg navbar-light  fixed-top">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              </ul>
                <a href="/logout">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="button">Logout</button>
                </a>
            </div>
          </nav>
          
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-black border border-left-0" id="sidebar-wrapper">
                <br><br>
                <div class="list-group list-group-flush">
                    <div class="text-success" class="font-weight:300">
                        <h3>&nbsp;
                            {!!       
                                    DB::table('students')
                                    ->where('user_id', Auth::user()->id)
                                    ->first()->name;
                            !!}
                        &nbsp;</h3>
                    </div>
                    <br>
                    <a href="/student" class="list-group-item list-group-item-action bg-light">Book List</a>
                    <a href="/student/record" class="list-group-item list-group-item-action bg-light">Borrowed Book</a>
                    {{-- <a href="/logout" class="list-group-item list-group-item-action bg-light">Logout</a> --}}
                </div>
            </div>
        </div>

        <div class="container col-6" >
            <div class="flex-center" style="color:blue">
                <nav class="navbar navbar-light center ">
                    <h1 style=" font-weight: 500">Book Management</h1>
                </nav>
            </div>
            @yield('Content')
        </div>

        @if(session('success'))
        <div class="alert alert-success">
                {{session('success')}}
        </div>
        @endif 

        <footer class="page-footer font-small blue">
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="#" > HiveLabs</a>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        @yield('script')
    </body>
</html>
