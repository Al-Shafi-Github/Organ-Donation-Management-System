<?php
    $user = $_REQUEST['EMAIL'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Donor Registration</title>
    

</head>

<body>
<div style="font-family: 'Poppins', sans-serif; font-weight:400">
        <header class="sticky-top">
            <nav class="navbar navbar-expand-sm  justify-content-between" style="background-color: #212529;">
                <a href="logged_in.php?EMAIL=<?php echo $user?>" class="navbar-brand" style="font-weight:700; color:White;">
                   Home
                </a>
                <a  class="navbar-brand" style="font-weight:700;color:White;">
                   ORGAN DONATION
                </a>
                <a class="btn btn-warning" href="index.php" role="button">Log out</a>

            </nav>
        </header>

        <div  <div class="header">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-sm-6 col-lg-5 col-xl-4 m-auto">
                        <h3 class="text-left" style="font-size:30px;font-family: 'Poppins', sans-serif; font-weight:700; color:azure;"> BE A DONOR</h3>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-5 col-xl-4 m-auto pt-4 pt-sm-0">
                        <div class="su-inner-banner-img"><img alt="image" class="img-fluid" style="padding: 25px 0px 25px;" src="images/female.png"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner -->

        <section class="container-fluid">
            <section class="row jumbotron justify-content-center">
                <section class="col-l4 col-sm-6">
                <?php
                    $con = new mysqli('localhost', 'root', '', 'organdb');
                    $user = $_REQUEST['EMAIL'];
                    $req = $_REQUEST['blodr'];
                    $qu1 = "SELECT * FROM registration WHERE EMAIL = '$user'";
                    $qu_req = "SELECT * FROM organ_requests WHERE REQUEST_ID = $req";
                   
                    $values = mysqli_query($con, $qu1);
                    $values2 = mysqli_query($con, $qu_req);
                    $height = "";
                    $quantity = "";
                    while ($row = mysqli_fetch_assoc($values)) {
                        
                        $REGISTRATION_ID = $row['REGISTRATION_ID'];
                        $AGE = $row['AGE'];
                    }
                    while ($row = mysqli_fetch_assoc($values2)) {
                        $quantity = $row['QUANTITY'];
                    }
                    if (isset($_POST['submit'])) {
                        $Weight = $_POST['WEIGHT'];
                        
                        $b = $_POST['feet'];
                        $c = $_POST['inches'];
                        $d = ($b*12) + $c;
                        $last = $d/39.3701;
                        $height  = number_format($last,2);
                        $Curmonth = date('m');
                        $Curyear = date('Y');
                        $Day = $_POST['Day'];
                        $Month = $_POST['month'];
                        $Year = $_POST['year'];
                        $Accident_Type = $_POST['ACCIDENT_TYPE'];
                        $Disease_Type = $_POST['DISEASE_TYPE'];
                        $Operation_Type = $_POST['OPERATION_TYPE'];
                        $Accident_Desc = $_POST['ACCIDENT_DESC'];
                        $Disease_Desc = $_POST['DISEASE_DESC'];
                        $Operation_Desc = $_POST['OPERATION_DESC'];
                        $pregnant = $_POST['pregnant'];
                        $menstruation = $_POST['menstruation'];
                      

                        $cur_dur = ($Curyear - $Year) * 12 + ($Curmonth - $Month);


                        $Bmi = $Weight / ($height  * $height );
                        if($pregnant == 'yes'){
                            ?>
                                    <div class="alert alert-danger" role="alert">
                                        You can't donate Organ during pregnancy period.
                                    </div>
                            <?php
                        }
                        else if($menstruation == 'yes'){
                            ?>
                                    <div class="alert alert-danger" role="alert">
                                        You can't donate Organ during menstruation period.
                                    </div>
                            <?php
                        }

                            else if ($AGE > 17) {
                                if ($Weight >= 50) {
                                    if ($cur_dur >= 5) {
                                        if ($Accident_Type != 'Critical' && $Disease_Type != 'Chronic' && $Operation_Type != 'Major') {
                                            $quantity = $quantity- 1;
                                            if ($quantity == 0) {
                                                $del_qu = "DELETE FROM organ_requests WHERE REQUEST_ID = $req";
                                                mysqli_query($con, $del_qu);
                                            } else {
                                                $update_quer = "UPDATE organ_requests SET QUANTITY = $quantity WHERE  REQUEST_ID = $req";
                                                mysqli_query($con, $update_quer);
                                            }
    
                                            $stmt = $con->prepare("INSERT INTO donor(REGISTRATION_ID,WEIGHT,BMI,OPERATION_TYPE,OPERATION_DESC,DISEASE_TYPE,DISEASE_DESC,ACCIDENT_TYPE,ACCIDENT_DESC)
                                                values(?,?,?,?,?,?,?,?,?)");
                                            $stmt->bind_param("iiissssss", $REGISTRATION_ID,$Weight,$Bmi,$Operation_Type, $Operation_Desc,$Disease_Type,$Disease_Desc,$Accident_Type,$Accident_Desc);
                                            $stmt->execute();
                                            $stmt->close();
                                            $con->close();
    
                                        ?>
                                            <div class="alert alert-success" role="alert">
                                                Organ Donation Apply Successful
                                            </div>
                                        <?php
    
                                        } else {
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                You can't Donate Organ
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Donation Gap must be at least 5 months or Higher
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        You must be weight at least 50kgs
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    You must be at least 18 years Old
                                </div>
                        <?php
                            }
                        }
                        ?>
                    <form action="" method="post" name="myform">

                       <div class="mb-4 ">
                            <label for="exampleInputEmail1" class="form-label">Height</label>
                            <input type="text" class="form-control" placeholder="Feet eg(01)" name="feet" required>
                            <input type="text" class="form-control" placeholder="inches eg(01)" name="inches" required>
                        </div>

                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label">Weight</label>
                            <input type="text" class="form-control" placeholder="weight(kg's) eg(01)" name="WEIGHT" required>
                        </div>
                        <div class="mb-4" required>
                            <label for="exampleInputEmail1" class="form-label">Are you Pregnant?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pregnant" id="exampleRadios1" value="yes" >
                                <label class="form-check-label" for="exampleRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pregnant" id="exampleRadios2" value="no">
                                <label class="form-check-label" for="exampleRadios2">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="mb-4" required>
                            <label for="exampleInputEmail1" class="form-label">Are you in Menstruation?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="menstruation" id="exampleRadios1" value="yes">
                                <label class="form-check-label" for="exampleRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="menstruation" id="exampleRadios2" value="no">
                                <label class="form-check-label" for="exampleRadios2">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label">Last Donation</label>
                            <input type="text" class="form-control mb-1" placeholder="Day eg(01)" name="Day" required>
                            <input type="text" class="form-control mb-1" placeholder="Month eg(01)" name="month" required>
                            <input type="text" class="form-control mb-1" placeholder="year eg(2021)" name="year" required>
                        </div>
                        <div class="mb-4" required>
                            <label for="exampleInputEmail1" class="form-label" >Any Recent Accident?</label>
                            <div class="form-check" >
                                <input class="form-check-input" type="radio" name="ACCIDENT_TYPE" id="exampleRadios1" value="None">
                                <label class="form-check-label" for="exampleRadios1">
                                    None
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ACCIDENT_TYPE" id="exampleRadios2" value="Critical">
                                <label class="form-check-label" for="exampleRadios2">
                                Critical
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ACCIDENT_TYPE" id="exampleRadios3" value="Minor">
                                <label class="form-check-label" for="exampleRadios2">
                                    Minor
                                </label>
                            </div>
                            <input type="text" class="form-control mb-1" placeholder="What kind of accident?(if yes) (optional)" name="ACCIDENT_DESC">
                        </div>

                        <div class="mb-4" required>
                            <label for="exampleInputEmail1" class="form-label">Any Disease?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="DISEASE_TYPE" id="exampleRadios1" value="None">
                                <label class="form-check-label" for="exampleRadios1">
                                    None
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="DISEASE_TYPE" id="exampleRadios2" value="Chronic">
                                <label class="form-check-label" for="exampleRadios2">
                                  Chronic
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="DISEASE_TYPE" id="exampleRadios3" value="Minor">
                                <label class="form-check-label" for="exampleRadios2">
                                    Minor
                                </label>
                            </div>
                            <input type="text" class="form-control mb-1" placeholder="What kind of Disease?(if yes) (optional)" name="DISEASE_DESC">
                        </div>
                        <div class="mb-4" required>
                            <label for="exampleInputEmail1" class="form-label">Any Recent Operation?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="OPERATION_TYPE" id="exampleRadios1" value="None">
                                <label class="form-check-label" for="exampleRadios1">
                                    None
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="OPERATION_TYPE" id="exampleRadios2" value="Major">
                                <label class="form-check-label" for="exampleRadios2">
                                    Major
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="OPERATION_TYPE" id="exampleRadios3" value="Bloodless">
                                <label class="form-check-label" for="exampleRadios2">
                                Bloodless
                                </label>
                            </div>
                            <input type="text" class="form-control mb-1" placeholder="What kind of Operation?(if yes) (optional)" name="OPERATION_DESC">
                        </div>
                        <button class="w-100 btn btn-lg btnc" type="submit" name="submit">Submit</button>
                    </form>
                </section>
            </section>

    </div>
    <script src="js/bootstrap.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>

</html>

<style>
    .header{
        background-color: #fcc358;
    }
    .btnc{
        background: #fcc358
    }
    .btnc:hover{
    background: #ffbb00;
    </style>

    