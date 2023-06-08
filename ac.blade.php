<!doctype html>
<html>
<head>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>  
<script>
   $(document).ready(function() {

    $( "#runani" ).click(function() {
    for ( var i = 0; i < 1; i++ ) {        
      $( "#divanimation" ).animate({
        opacity: 0.6,
        width: "toggle",
        height: "toggle"
      }, {
        duration: 10000,
        specialEasing: {
          width: "easeInOutSine",
          height: "easeInOutSine",
        },
        complete: function() {
          //alert( "Animation complete!" );
        }
    });
     for ( var j = 0; j < 5; j++ ) {
    $( "#divanimation2" ).animate({
        opacity: 0.75,
        width: "toggle",
        height: "toggle"
      }, {
        duration: 1200,
        specialEasing: {
          width: "easeInOutCirc",
          height: "easeInOutCirc",
          minWidth:"50px",
          minHeight:"50px"
        },
        complete: function() {
          //alert( "Animation complete!" );
        }
    });
    }
    
    //for loop ends
    
   } 
    });
});

</script>
  <style>
#divanimation {
	padding: 8px;
    background:#E9F273;
	width: 500px;
    min-width:150px;
    min-height:100px;
    height:200px;
	box-shadow: 0 0 5px #aaa;
    font-size: 18px;
    text-align:center;
    border-radius: 200px;

}
#divanimation2 {
	padding: 4px;
    background:#005300;
	width: 100px;
    height:100px;
	box-shadow: 0 0 5px #aaa;
    font-size: 14px;
    text-align:center;
    border-radius: 200px;
    vertical-align:top;
}
button{
   margin: 50px; 
}
  </style>
</head>
<body>

<div id="divanimation">animation example
<div id="divanimation2">animate 2</div>
</div>
<button id="runani">Run animation</button>

</body>
</html>

