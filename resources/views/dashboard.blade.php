<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>World</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <style>
        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .edit-button {
            grid-column: span 4;
            justify-self: center;
        }

        .edit-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            transition-duration: 0.4s;
        }

        .edit-button:hover {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        canvas {
            max-width: 500px;
            max-height: 500px;
        }

        .tab {
            display: none;
        }

        .tab.active {
            display: block;
        }

        .tab-buttons {
            margin-bottom: 10px;
        }

        .tab-buttons button {
            padding: 10px;
            background-color: #ddd;
            border: none;
            cursor: pointer;
        }

        .tab-buttons button.active {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary"></button>
            </div>
            <div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);"></div>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="#" onclick="openTab(event, 'home-tab')"><span class="fa fa-home mr-3"></span>Home</a>
                </li>
                <li>
                    <a href="#" onclick="openTab(event, 'reports-tab')"><i class="bx bxs-bar-chart-square mr-3"></i>Reports</a>
                </li>
                <li>
                    <a href="{{route('addcountry')}}"><i class="bx bx-plus-medical mr-3"></i>Add Country</a>
                </li>
                <li>
                    <a href="{{route('register-form')}}"><i class='bx bx-user-plus mr-3' style='color:#ffffff' ></i>Add User</a>
                </li>
                <li>
                    <a href="{{route('logout')}}"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div id="home-tab" class="tab active">
                <h2 class="mb-4">Welcome</h2>
                <script>
                    var countriesData = @json($countries);
                </script>
                @include('table')
            </div>

            <div id="reports-tab" class="tab">
                @include('reports')
            </div>
            @include('editcountry')
        </div>
    </div>

   
    <script>
        function openTab(evt, tabName) {
            // Hide all tabs
            var tabs = document.getElementsByClassName("tab");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].style.display = "none";
            }

            // Remove 'active' class from all buttons
            var tabButtons = document.querySelectorAll(".list-unstyled.components a");
            for (var i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }

            // Show the selected tab and mark its button as active
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.classList.add("active");
        }

        document.addEventListener('DOMContentLoaded', function () {
            var navLinks = document.querySelectorAll('.list-unstyled.components a');
            navLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    openTab(event, this.getAttribute('onclick').split("'")[1]);
                });
            });
        });
    </script>
</body>
</html>
