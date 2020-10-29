<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Fonts -->
        
        <title>@yield('title','Laravel')</title>
        
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 

        <!-- Styles -->
        <style>
            html, body {
                /* background-color: #fff; */
                color: black;
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

            .error{
                color:red;
            }
            /* .dataTables_wrapper .dataTables_paginate {
                float: right;
                text-align: center;
                padding-top: 0.775em;
            } */
            .dataTables_wrapper .dataTables_paginate .paginate_button{
                padding: 0;
                margin: 1px;
                text-align: center !important;
            }

            table.dataTable tr.odd {
                background-color:lightgrey;
            }
            table.dataTable tr.odd td.sorting_1 {
                background-color: lightgrey;
            }
            table.dataTable tr.even td.sorting_1 {
                background-color: white;
            }
            .table-hover tbody tr:hover {
                background-color: lightblue;
            }
            /* .table.dataTable tr.odd td.sorting_1:hover {
                background-color: lightblue;
            } */
        </style>
    </head>
    <body>
        <div class="d-flex" id="wrapper" >
            <!-- Sidebar -->
            <div class="bg-black border-right" id="sidebar-wrapper">
                <br><br>
                <div class="list-group list-group-flush">
                    <div class="text-success" class="font-weight:300">
                        <h3>&nbsp;
                            {!!       
                                DB::table('users')
                                    ->where('student_id', Auth::user()->student_id)
                                    ->first()->name;
                            !!}
                        &nbsp;</h3>
                    </div>
                    <br>
                    <a href="/admin" class="list-group-item list-group-item-action bg-light">Book List</a>
                    <a href="/admin/createbook" class="list-group-item list-group-item-action bg-light">Add Book</a>
                    <a href="/admin/view-request" class="list-group-item list-group-item-action bg-light">View Request</a>
                    <a href="/" class="list-group-item list-group-item-action bg-light">Logout</a>
                    
                </div>
            </div>
        </div>

        <div class="container col-7" >
            <div class="flex-center" style="color:blue">
                <nav class="navbar navbar-light center ">
                    <h1 style=" font-weight: 500">Book Management</h1>
                </nav>
            </div>
            @yield('Content')
            {{-- @if(session('success'))
            <div class="alert alert-success">
                    {{session('success')}}
            </div>
            @endif  --}}
        </div>

        <footer class="page-footer font-small blue">
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="#"> HiveLabs</a>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery.Validate/1.6/jQuery.Validate.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
        @yield('script')
    </body>
</html>
