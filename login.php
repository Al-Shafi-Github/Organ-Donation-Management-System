<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log In</title>

    
</head>
</head>

<body>

<div class="header">

<img class="img-log" src="images/log in.png" alt="new user icon">
<div class="h2">
<h3 CLASS="h3">Log In</h3>
</div>
</div>

<form action="connect_login.php" method="post" name="myform">
            <!-- Imported from -->
    
 <div class="wrapper">
    <div class="title">
      Log In
    </div>
    <div class="form">
      
       <div class="inputfield">
          <label for="exampleInputEmail1">Email Address</label>
          <input type="email" id="exampleInputEmail1" class="input" placeholder="Email" name="EMAIL" required>
       </div> 
       <div class="inputfield">
          <label for="exampleInputEmail1">Password</label>
          <input type="password" class="input" placeholder="Password" name="PASS_WORD" required>
       </div>  
      
      <div class="inputfield">
        <input type="submit" value="LOG IN" class="btn">
      </div>
      <p class="alter" >Not a Member?  <a class= "login"  href="registration.php"> Register now! </a></p>
      
      
    </div> 
    
</div>


</form>
    
    
</body>
</html>

<style>

@import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}
.header {
  
  padding: 25px;
  text-align: center;
  background: #fcc358;
  color: white;
  font-size: 30px;
}
body{
  background: #fff; 
  padding: 0 0px;
}
.header .h3 {
    color: #fff;
    font-size: 30px;
}
.header .img-log{
  position: relative;
  left: 20px;
  width:225px;
  height:200px;
}
.wrapper{
  max-width: 500px;
  width: 100%;
  background: #FFF5EE;
  margin: 50px auto;
  box-shadow: 2px 2px 4px rgba(0,0,0,0.125);
  padding: 30px;
}

.wrapper .title{
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 25px;
  color: #fcc358;
  text-transform: uppercase;
  text-align: center;
}

.wrapper .form{
  width: 100%;
  
}

.wrapper .form .inputfield{
  margin-bottom: 15px;
  display: flex;
  align-items: center;
}

.wrapper .form .inputfield label{
   width: 200px;
   color: #757575;
   margin-right: 10px;
  font-size: 14px;
}

.wrapper .form .inputfield .input {
  width: 100%;
  outline: none;
  border: 1px solid #d5dbd9;
  font-size: 15px;
  padding: 8px 10px;
  border-radius: 3px;
  transition: all 0.3s ease;
}


.wrapper .form .inputfield .input:focus,
.wrapper .form .inputfield .textarea:focus,{
  border: 1px solid #39ace7;
}

.wrapper .form .inputfield p{
   font-size: 14px;
   color: #757575;
}



.wrapper .form .inputfield .btn{
  width: 100%;
   padding: 8px 10px;
  font-size: 15px; 
  border: 0px;
  background: #fcc358;
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
}

.wrapper .form .inputfield .btn:hover{
  background: #ffbb00;
}

.wrapper .form .inputfield:last-child{
  margin-bottom: 0;
}

.wrapper .form .alter{
    text-align: center;
}
.wrapper .form .alter .login{
    text-decoration: none;
    padding: 10px;
    margin: 10px;
    color:#ffbb00;
}

@media (max-width:420px) {
  .wrapper .form .inputfield{
    flex-direction: column;
    align-items: flex-start;
  }
  .wrapper .form .inputfield label{
    margin-bottom: 5px;
  }
  .wrapper .form .inputfield.terms{
    flex-direction: row;
  }
}
</style>