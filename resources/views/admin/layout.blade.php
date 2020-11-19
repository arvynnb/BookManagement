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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            .sidenav a, .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
            }
            .sidenav a:hover, .dropdown-btn:hover {
            color: blue;
            }
            .active {
            /* background-color: green; */
            /* color: white; */
            }
            .dropdown-container {
            display: none;
            background-color: lightgray;
            padding-left: 8px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light  fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              </ul>
                <a href="/logout">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="button">Logout</button>
                </a>
            </div>
          </nav>

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
                    <div class="sidenav">
                        <button class="dropdown-btn">Book Management 
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container">
                            <a href="/admin" class="list-group-item list-group-item-action bg-light">Book List</a>
                            <a href="/admin/createbook" class="list-group-item list-group-item-action bg-light">Add Book</a>
                            <a href="/admin/view-request" class="list-group-item list-group-item-action bg-light">View Request</a>
                        </div>
                        <a href="/admin/student-list" class="list-group-item list-group-item-action bg-light">Student List</a>
                        <a href="/admin/course" class="list-group-item list-group-item-action bg-light">Course Management</a>
                      </div>
                    {{-- <label for="Book Management" class="list-group-item text-primary" style="background-color:lightgray">Book Management</label>
                    <a href="/admin" class="list-group-item list-group-item-action bg-light">Book List</a>
                    <a href="/admin/createbook" class="list-group-item list-group-item-action bg-light">Add Book</a>
                    <a href="/admin/view-request" class="list-group-item list-group-item-action bg-light">View Request</a>
                    <a href="/logout" class="list-group-item list-group-item-action bg-light">Logout</a>
                    <label for="student" class="list-group-item text-primary" style="background-color:lightgray">Student</label>
                    <a href="#" class="list-group-item list-group-item-action bg-light">Student List</a>
                    <label for="courses" class="list-group-item text-primary" style="background-color:lightgray">Site</label>
                    <a href="#" class="list-group-item list-group-item-action bg-light">Courses</a> --}}
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

        <footer class="page-footer font-small blue">
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="#"> HiveLabs</a>
            </div>
        </footer>
        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;
            
            for (i = 0; i < dropdown.length; i++) {
              dropdown[i].addEventListener("click", function() {
              this.classList.toggle("active");
              var dropdownContent = this.nextElementSibling;
              if (dropdownContent.style.display === "block") {
              dropdownContent.style.display = "none";
              } else {
              dropdownContent.style.display = "block";
              }
              });
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
        <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery.Validate/1.6/jQuery.Validate.min.js"></script> --}}
        @yield('script')
    </body>
</html>
