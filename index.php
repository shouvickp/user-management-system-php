<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
body{
  background-color: lightgrey;
  width: 100%;
  float: left;
}
#container{
  width: 35%;
  float: left;
  margin: 30px 30%;
  padding: 30px 30px;
  text-align: center;
  float: left;
  border-radius: 4px;
  background-color: white;
}
button{
  margin: 10px 0;
  width: 90%;
}
#output{
  border-radius: 50%;
}
</style>
<script>
  function register(){
    var email = $('#email').val();                    //To save file with this name
    var pass = $('#pass').val();
    var conf_pass = $('#conf_pass').val();
    var city = $('#city').val();
    var gender = $('input[name=gender]').val();
    var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
    var form_data = new FormData();
    form_data.append("file",file_data);
    form_data.append("email",email);
    form_data.append("pass",pass);
    form_data.append("city",city);
    form_data.append("gender",gender);
    var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*~]).*$/;
    if(!pattern.test(pass)) {
      alert('Password must contain at least one number and one uppercase and lowercase letter and one special characters, and at least 8 or more characters.');
    }
    else if(pass != conf_pass) {
      alert("Password doesnot matched.");
    }
    else{
      //Ajax to send file to upload
      $.ajax({
        url: "load.php",                      //Server api to receive the file
               type: "POST",
               dataType: 'script',
               cache: false,
               contentType: false,
               processData: false,
               data: form_data,
            success:function(data){
              if(data!=0) {
                if(data != -1) {
                  alert(data);
                  window.location.href = "login.html";
                }
                else {
                  alert('user acount already exists.');
                }
              }
              else 
                alert("Unable to register");
            }
      });
    }
    
  }
  
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#output')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<body>
  <div id="container">
    <p><img id="output" src="./profilepic/avatar.png" width="150"/></p>
    <input type="file" accept="image/*" onchange="readURL(this);" class="fileToUpload form-control" ></input><br>
    <input type="email" placeholder="Your email" id="email" class="form-control" required /><br>
    <input type="password" placeholder="Your password" id="pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*~])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special characters, and at least 8 or more characters" required /><br>
    <input type="password" placeholder="Confirm your password" id="conf_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*~])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special characters, and at least 8 or more characters" required /><br>
    <label for="gender" class="form-control-label"><b>Gender</b></label> <br>
    <input type="radio" id="male" name="gender" checked="checked" value="male">
    <label for="male" class="radio-inline">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female" class="radio-inline">Female</label>
    <input type="radio" id="other" name="gender" value="other">
    <label for="other" class="radio-inline">Other</label>
    <br><br>
    <label for="city"><b>Choose a city: </b></label>
    <select name="city" id="city">
      <option value="Kolkata">Kolkata</option>
      <option value="Howrah">Howrah</option>
      <option value="Chennai">Chennai</option>
      <option value="Mumbai">Mumbai</option>
      <option value="Delhi">Delhi</option>
    </select>
    <button class="btn btn-success" onclick="register()">Register</button>
    <label>
      <input type="checkbox" name="terms_and_conditions" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a>
    </label>
    <br><br>
    <label >Already have an account login <a href="login.html"> here.</a></label>
  </div>
</body>
</html>