<!DOCTYPE html> 
<html>
<head> 
<title> jQuery :reset selector </title>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

</head>
<body>

    <div style = "background: d279a6;">
	<form id = "myForm" style = "font-size: 20px;" >
	<p> First Name: <input type = "text" id = "fname" /> </p>
	<p> Last Name: <input type = "text" id = "lname" /> </p>
	<p> E-mail Id:   <input type = "email" id = "email" /> </p>
	<input type = "submit">
	<button type = "reset" class="btn btn-success"> Reset </button>
	</form>
    </div>
<script>
   $(document).ready(function() { 
            $("button:reset").css({"background-color": "#f2d9e6", "font-size": "20px", "border": "black"}); 
        });  
</script>

</body>
</html>

 
