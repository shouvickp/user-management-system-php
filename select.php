<?php  
   $connect = mysqli_connect("localhost", "root", "", "assignment1");  
   $output = '';  
   $sql = "select * from user";  
   $result = mysqli_query($connect, $sql);  
   $output .= '  
        <div class="table-responsive">  
             <table class="table table-bordered">  
                  <tr>  
                       <th width="20%">User Email</th>  
                       <th width="10%">Gender</th>  
                       <th width="10%">Profile Pic </th>
                       <th width="10%">City</th>  
                       <th width="10%">Delete</th>  
                  </tr>';  
   $rows = mysqli_num_rows($result);
   if($rows > 0)  
   {  
  	  while($row = mysqli_fetch_array($result))  
        {  
             $output .= '  
                       <tr>  
                       <td>'.$row["email"].'</td>  
                       <td >'.$row["gender"].'</td>  
                       <td align="center"><img src="'.$row["profilepic"].'" width="50"></td>  
                       <td>'.$row["city"].'</td>
                       <td><button type="button" name="delete_btn" data-id="'.$row["email"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                  </tr>  
             ';  
        }
   }    
   $output .= '</table>  
        </div>';  
   echo $output;  
 ?>