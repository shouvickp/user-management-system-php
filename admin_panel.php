<html>  
    <head>  
        <title>Admin Panel</title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    </head>  
    <body>  
        <div class="container">  
            <br />  
            <br />
            <p style="float: right"><button onclick="logout()" class="btn btn-sm btn-danger">Logout</button></p>
			<div class="table-responsive">  
				<h3 align="center">Welcome to admin Panel</h3><br />

				<div id="live_data"></div>                 
			</div>  
		</div>
    </body>  
</html>  
<script> 
    function logout() {
            $.ajax({
                url: 'logout.php',
                type: 'get',
                data:{action:'logout'},
                success: function(data){
                    alert(data);
                    window.location.href = "login.html";
                }
              });
    } 
    $(document).ready(function(){  
        function fetch_data()  
        {  
            $.ajax({  
                url:"select.php",  
                method:"POST",  
                success:function(data){  
    				$('#live_data').html(data);  
                }  
            });  
        }  
         fetch_data();   
        $(document).on('click', '.btn_delete', function(){  
            var id=$(this).data("id");  
            if(confirm("Are you sure you want to delete this?"))  
            {  
                $.ajax({  
                    url:"delete.php",  
                    method:"POST",  
                    data:{id:id},  
                    dataType:"text",  
                    success:function(data){  
                        alert(data);  
                        fetch_data();  
                    }  
                });  
            }  
        });  
    });  
</script>