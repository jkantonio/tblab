<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CS128.1</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css")?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand fixed-top bg-primary text-center" style="align-items: center;">
        <div class="container"><a class="navbar-brand" href="#">TB LAB</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center"
                id="navcol-1">
                <ul class="nav navbar-nav flex-grow-1 justify-content-between">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="<?php echo base_url('menu');?>">Menu</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Employee ID: <?php echo $userID;?></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="<?php echo base_url('main/logout');?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="margin-top: 81px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-lg-2">
                    <h2 style="margin-left: 90px">Specimen Code</h2>
                </div>
                <form method="POST">
                        <input type="text" name="specimenCode" style="margin-top: 4px;"></input>
                        <input class="btn btn-primary" name="searchSpecimenCode" type="submit" value="Search" style="margin-left: 16px;"></input>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-6 offset-lg-3">
                    <p>Patient ID: <?php echo $patientID;?></p>
                    <p>Specimen Code: <?php echo $specimenCode; ?></p>
                    <?php $patientIDtemp = $patientID; ?>
                </div>
    <form method="POST" action="<?php echo base_url(); ?>EnteringSmear/add">
            <div class="row">
                <div class="col-md-10 offset-md-10">
                    <input class="btn btn-primary" type="radio" name="smear" value="Negative" style="margin: 5px;"required> 0</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="1 AFB/100 fields" style="margin: 5px;">+1</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="2 AFB/100 fields" style="margin: 5px;">+2</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="3 AFB/100 fields" style="margin: 5px;">+3</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="4 AFB/100 fields" style="margin: 5px;">+4</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="5 AFB/100 fields" style="margin: 5px;">+5</input>
                </div>
            </div>
            <input type="hidden" name="patientID" value="<?php echo $patientIDtemp; ?>">
            <input type="hidden" name="specCode" value="<?php echo $specimenCode; ?>">
            <div class="row">
                <div class="col-md-9 offset-md-10">
                    <input class="btn btn-primary" type="radio" name="smear" value="6 AFB/100 fields" style="margin: 5px;">+6</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="7 AFB/100 fields" style="margin: 5px;">+7</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="8 AFB/100 fields" style="margin: 5px;">+8</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="9 AFB/100 fields" style="margin: 5px;">+9</input>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 offset-md-10">
                    <input class="btn btn-primary" type="radio" name="smear" value="Positive (1+)" style="margin: 5px;">1+</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="Positive (2+)" style="margin: 5px;">2+</input>
                    <input class="btn btn-primary" type="radio" name="smear" value="Positive (3+)" style="margin: 5px;">3+</input>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 offset-md-10" style="margin-top: 30px; margin-left: 180px;">
                    <p class="text-right">Smear Result Date:&nbsp;</p>
                </div>

                <div class="col-md-9 offset-md-10">
                    <input type="date" name="dateProc" style="margin-top: 10px; position: absolute; bottom: 15px; right: 10px" required>
                </div>

            </div>

            <div class="row">
                <div class="col-md-9 offset-md-10">
                    <input class="btn btn-primary text-center" type="submit" value="Submit" style="margin-left: 269px; position: absolute; bottom: 10px">
                </div>
    </form>
            </div>
            
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>