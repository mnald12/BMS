<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
    $query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $query1 = "SELECT *,tblofficials.id as id, tblposition.id as pos_id,tblchairmanship.id as chair_id FROM tblofficials JOIN tblposition ON tblposition.id=tblofficials.position JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE `status`='Active' ORDER BY tblposition.order ASC ";

    $result1 = $conn->query($query1);
    $officials = array();
    while($row = $result1->fetch_assoc()){
        $officials[] = $row; 
    }

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Captain'";
    $captain = $conn->query($c)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
    <title>Barangay Certificate -  Barangay Management System</title>
    <style type="text/css">
        .heads h2, .heads h3{
            font-family: "Times New Roman", Times, serif;
        }
        .img-fluids{
            width: 98%;
            height: 98%;
            margin-left: 1%;
            margin-top: 1%;
            transform: translateY(-10px);
        }
        .rows{
            display: flex;
        }
        .left{
            width: 30%;
            background-color: yellowgreen !important;
        }
        .img-box{
            width: 50%;
            margin: 50px auto;
        }
        .img-box img{
            width: 100%;
        }
        .left h4{
            color: white;
            word-spacing: 2px;
            text-align: center;
            margin-bottom: -4px;
            font-size: 22px;
            font-family: "Times New Roman", Times, serif;
        }
        .left h3{
            color: white;
            font-size: 23px;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-weight: 600;
        }
        .left p{
            text-align: center;
            color: white;
            font-family: "Times New Roman", Times, serif;
            font-weight: 600;
        }
        .right{
            border: 4px solid black;
            width: 70%;
        }
        .right h1{
            font-size: 30px;
            text-align: center;
            padding-bottom: 50px;
            padding-top: 30px;
            font-family: "Times New Roman", Times, serif;
        }
        .right .p{
            padding-left: 30px;
            padding-right: 30px;
            text-indent: 50px;
            margin: 0;
            font-size: 17px;
            font-weight: bold;
        }
        .right h3{
            font-size: 17.5px;
            padding-right: 30px;
            padding-left: 30px;
            margin-bottom: 8px;
        }
        .space{
            height: 50px;
        }
        .box1{
            width: 90px;
            height: 100px;
            border: 1px solid black;
            margin-left: 44px;
            margin-top: 12px;
        }
        .box2{
            width: 90px;
            height: 100px;
            border: 1px solid black;
            margin-top: 12px;
        }
        .foots h4{
            text-align: center;
            margin: 0;
            transform: translateY(20px);
        }
        .foots h1{
            text-align: right;
            font-size: 22px;
            text-align: center;
            font-weight: bold;
            margin: 0;
            margin-top: 0;
        }
        .foots h5{
            text-align: center;
            margin: 0;
            transform: translateY(-50px);
        }
        @media print{
            .left{
            background-color: yellowgreen !important;
            -webkit-print-color-adjust: exact; 
            }
            .b2{
                transform: translateX(-30px);
            }
            .card-header{
                display: none;
            }
        }
    </style>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
    <div class="wrapper">
        <!-- Main Header -->
        <?php include 'templates/main-header.php' ?>
        <!-- End Main Header -->

        <!-- Sidebar -->
        <?php include 'templates/sidebar.php' ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">



                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white fw-bold">Generate Certificate</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Barangay Certificate</div>
                                        <div class="card-tools">
                                            <button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
                                                <i class="fa fa-print"></i>
                                                Print Certificate
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="printThis">
                                <div class="card-body">
                                    <div class="row" style="border-bottom: 20px solid steelblue;">
                                        <div class="col-md-3">
                                            <img src="assets/uploads/<?= $city_logo ?>" style="width: 180px; transform: translateY(-10px);" />
                                        </div>
                                        <div class="col-md-6 heads" style="text-align: center;">
                                            <h3 class="mb-0">Republic of the Philippines</h3>
                                            <h3 class="mb-0">MUNICIPALITY OF <?= ucwords($province) ?></h3>
                                            <h3 class="mb-0"><?= ucwords($town) ?></h3>
                                            <h2>OFFICE OF THE PUNONG BARANGAY</h2>
                                            <h2 class="fw-bold mb-0">BARANGAY <?= ucwords($brgy) ?></h2>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="assets/uploads/<?= $brgy_logo ?>" style="width: 180px; transform: translateY(-10px);" />
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="left">
                                                <div class="img-box">
                                                    <img src="kapitan.png" />
                                                </div>
                                                <?php if(!empty($officials)):?>
                                                    <?php foreach($officials as $row): ?>
                                                        <h4><?= ucwords($row['name']) ?></h4>
                                                        <p><?= ucwords($row['title']) ?></p>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </div>
                                            <div class="right">
                                                <h1>BARANGAY CLEARANCE</h1>
                                                   <p class="p" style="text-indent: 0;">To whom it may concern:</p>
                                                   <p class="p">This is to certify that <u><span class="fw-bold" style="font-size:19px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span></u>, <u><span class="fw-bold" style="font-size:19px"><?= ucwords($resident['age']) ?></span></u> years old, <?= ucwords($resident['civilstatus']) ?> a native of <u><?= ucwords($resident['address']) ?></u> and   presently known to be a person of a good moral character, without any criminal record or derogatory information against his/her and enjoy a good reputation in this community.</p>

                                                   <p class="p">This certification is being issued upon his/her request for following purpose/s:</p>
                                                   <div class="space"></div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h3>( ) for Local Employment</h3>
                                                        <h3>( ) Lending Institution/Loan</h3>
                                                        <h3>( ) for Bank Transaction</h3>
                                                        <h3>( ) for Postal I.D.</h3>
                                                        <h3>( ) Securing Police Clearance</h3>
                                                        <h3>( ) other reference </h3>

                                                        <h3 style="margin-top: 30px;">___________________________</h3>
                                                        <h3 style="transform: translateY(-3px); margin-left: 14px;">Applicants Signature</h3>
                                                        <div class="row">
                                                            <div class="col-md-6 b1">
                                                                <div class="box1"></div>
                                                                <p style="font-size: 8px; padding-left: 44px; margin-top: 1px;">LEFT THUMBMARK</p>
                                                            </div>
                                                            <div class="col-md-6 b2">
                                                                <div class="box2"></div>
                                                                <p style="font-size: 8px; padding: 0; margin-top: 1px;">RIGHT THUMBMARK</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3>( ) for School Reference</h3>
                                                        <h3>( ) for Overseas Travel Paper</h3>
                                                        <h3>( ) for Travel/Transfer of Residence</h3>
                                                        <h3>( ) for processing of calamity aid disaster</h3>
                                                        <h3 style="margin-top: 48px;">CTC NO.: ____________</h3>
                                                        <h4 style="margin-left: 30px;">issued at: ________________</h4>
                                                        <h4 style="margin-left: 30px;">issued on: ________________</h4>
                                                        <h4 style="margin-left: 30px;">issued this <span class="fw-bold" style="font-size:19px"> <?= date('F d, Y') ?> </span> <br>at Brgy. Otavi, Bulan, Sorsogon</h4>
                                                    </div>
                                                </div>
                                                <div class="foots">
                                                    <h4>Certified by:</h4>
                                                    <h1><?= ucwords($captain['name']) ?></h1>
                                                    <h5>Punong Barangay</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                           </div>
                       </div>
                    </div>

            

            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->
            
        </div>
        
    </div>
</div>
    <?php include 'templates/footer.php' ?>
    <script>

            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
    </script>
</body>
</html>