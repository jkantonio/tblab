<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CS128.1</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
</head>

<body>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5 offset-lg-1">
                    <h1>Specimen Code: </h1>
                </div>
                <form method="post">
                    <div class="col">
                        <input type="text" name="specimenCode" id="specimenCode" style="margin-top: 12px;"></input>
                        <input class="btn btn-primary btn-sm" type="submit" name="searchSpecimenCode" value="Search" id="searchBtn" style="margin-left: 16px;"></input>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Start Incubation:</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 offset-lg-4">
                    <p>Date:&nbsp;</p>
                </div>
                <div class="col-lg-4 offset-lg-0"><input type="date"></div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-check text-right"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">LJ</label></div>
                </div>
                <div class="col">
                    <div class="form-check text-left"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2">MGIT</label></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 offset-lg-2"><button class="btn btn-primary text-center" type="button" style="margin-left: 235px;margin-right: 0;">Save</button></div>
                <div class="col-lg-2"><button class="btn btn-primary" type="button" style="margin-left: -6px;">Cancel</button></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>