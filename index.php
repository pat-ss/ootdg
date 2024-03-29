<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Access user_id from the session
$userId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
    <head>

        <script src="plugins/jquery/jquery.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>Outfit Generator</title>
    
        <!-- Add your existing stylesheets -->
    
        <script src="outfitGenerator.js"></script>
        <script src="https://cdn.logwork.com/widget/text.js"></script>
        <link rel="stylesheet" href="outfitGenerator.css">
    
        
    
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <script src="outfitGenerator.js"></script>
        <script src="https://cdn.logwork.com/widget/text.js"></script>
        <link rel="stylesheet" href="outfitGenerator.css">

    </head>
    <body id="page-top">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const userEmailEncoded = urlParams.get('email');
                
                if (userEmailEncoded) {
                    const userEmail = decodeURIComponent(userEmailEncoded.replace(/\+/g, ' '));  // Decode and replace '+' with space
                    // Proceed with actions for the logged-in user based on userEmail
                } 
            });

        </script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3">Outfit Generator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            

            
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="generate_outfit.html">
                    <span>Generate Outfit</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="saved_outfits.html">
                    <span>Saved Outfits</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <span>Clothing</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_clothes.html">Add Item</a>
                        <a class="collapse-item" href="edit_clothes.html">Edit Items</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    
                    <span>Rules</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_rule.html">Add Rule</a>
                        <a class="collapse-item" href="edit_rules.html">Edit Rules</a>
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            

            

        </ul>
        <!-- End of Sidebar -->

        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                
                

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    
                    <!-- Content Row -->
                    <div class="row">

                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div style="margin-left: auto; margin-right: auto;">
                            <div class="card-body" style="text-align:center;">

                               <p id="txt" style="font-size: 250%; color: black;"></p>
                               <table style="border-collapse: collapse; margin: auto;">
                                    <tr>
                                        <td id="horas" style="font-size: 300%; background-color: rgb(56, 54, 54); color: white; text-align: center; border-radius: 10%; padding: 10px;"></td>
                                        <td style="font-size: 200%; color: black;">:</td>
                                        <td id="minutos" style="font-size: 300%; background-color: rgb(56, 54, 54); color: white; text-align: center; border-radius: 10%; padding: 10px;"></td>
                                        <td style="font-size: 200%; color: black;">:</td>
                                        <td id="segundos" style="font-size: 300%; background-color: rgb(206, 205, 205); color: black; text-align: center; border-radius: 10%; padding: 10px;"></td>
                                    </tr>
                               </table>
                               <iframe src="https://www.meteoblue.com/en/weather/widget/three?geoloc=detect&nocurrent=0&nocurrent=1&noforecast=0&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=image"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 460px; height: 488px; transform: scale(0.75);"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/en/weather/week/index?utm_source=weather_widget&utm_medium=linkus&utm_content=three&utm_campaign=Weather%2BWidget" target="_blank" rel="noopener"></a></div>

                                <!--
                                <script type="text/javascript"> var css_file=document.createElement("link"); css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href","https://s.bookcdn.com//css/cl/bw-cl-c22.css?v=0.0.1"); document.getElementsByTagName("head")[0].appendChild(css_file); </script> <div id="tw_22_1373014472"><div style="width:200px; height:px; margin: 0 auto;"><a href="https://hotelmix.co.uk/time/castelo-sesimbra-318969">Castelo (Sesimbra)</a><br/></div></div> <script type="text/javascript"> function setWidgetData_1373014472(data){ if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = ''; var params = data.results[i]; objMainBlock = document.getElementById('tw_'+params.widget_type+'_'+params.widget_id); if(objMainBlock !== null) objMainBlock.innerHTML = params.html_code; } } } var clock_timer_1373014472 = -1; widgetSrc = "https://widgets.booked.net/time/info?ver=2;domid=579;type=22;id=1373014472;scode=124;city_id=318969;wlangid=1;mode=0;details=0;background=ffffff;border_color=ffffff;color=686868;add_background=ffffff;add_color=333333;head_color=ffffff;border=0;transparent=0"; var widgetUrl = location.href; widgetSrc += '&ref=' + widgetUrl; var wstrackId = ""; if (wstrackId) { widgetSrc += ';wstrackId=' + wstrackId + ';' } var timeBookedScript = document.createElement("script"); timeBookedScript.setAttribute("type", "text/javascript"); timeBookedScript.src = widgetSrc; document.body.appendChild(timeBookedScript); </script>
                                -->


                            </div>
                            
                        </div>
                        
                        
                    </div>

                    
                        

                </div>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

   

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins
    <script src="vendor/chart.js/Chart.min.js"></script>
     -->

    <!-- Page level custom scripts 
        <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
     -->
   
    <script>
        startTime();
    </script>

</body>
</html>