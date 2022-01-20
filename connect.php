<?php
    $FIRST_NAME = $_POST['FIRST_NAME'];
    $LAST_NAME = $_POST['LAST_NAME'];

    $dateofbirth =$_POST['dateofbirth'];
    $currentDate = date("m/d/Y");
    $calc = date_diff(date_create($dateofbirth),date_create($currentDate));
    $AGE = (int)$calc ->format("%y");

    
    $BLOOD_GROUPr = $_POST['BLOOD_GROUPr'];
    $Gender = $_POST['Gender'];
    $EMAIL = $_POST['EMAIL'];
    $x = $_POST['PASS_WORD'];
    $y = $_POST['confirm_password'];



    if($x == $y){
        $PASS_WORD = $_POST['PASS_WORD'];
    }
    else{
        echo "Passwords did not match";
    }

    $phoneR = $_POST['phoneR'];
    $ADD_RESSr = $_POST['ADD_RESSr'];
    $ZIP_CODE = $_POST['ZIP_CODE'];
    




    //connection to database server
    $con = new mysqli('localhost','root','','organdb');
    $quer2= "SELECT * FROM registration WHERE EMAIL= '$EMAIL'";
    $values = mysqli_query($con, $quer2);
    $ROW= mysqli_num_rows($values);
    if($ROW > 0){
        die ('Email already registered');
    }
    else{
        $stmt = $con->prepare("INSERT INTO registration(FIRST_NAME,LAST_NAME,AGE,BLOOD_GROUPr,Gender,EMAIL,PASS_WORD,phoneR,ADD_RESSr,ZIP_CODE)
        values(?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssissssisi",$FIRST_NAME,$LAST_NAME,$AGE,$BLOOD_GROUPr,$Gender,$EMAIL,$x,$phoneR,$ADD_RESSr,$ZIP_CODE);
        $stmt->execute();
        echo "Registered Succesfull";
        $stmt->close();
        $con->close();
        header("location:login.php");
    }
?>