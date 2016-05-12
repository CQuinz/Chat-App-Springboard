

<head>  <meta charset="utf-8">  
<title>Compustore Tech Support</title>  

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <style type="text/css">
  
      #wrapper{
		  width:960;
		  margin:auto;
		  height:800;
	  }
     #questionBox{
		 width:300;
		 height:300;
		 margin:auto;
		 border:1px solid black;
		 padding:5px;
	 }
  
  </style>


</head>

<body>

<script>
     
    function sendToDatabase(){

     $.get( "https://api.xmltime.com/timeservice?accesskey=f5UdeHdeHd&expires=2016-05-12T20%3A22%3A38%2B00%3A00&signature=62xwag1rjXHlFEtFAaFKLZx7gtg%3D&version=2&out=xml&placeid=norway%2Foslo", function( data ) {
        xml = new XMLSerializer().serializeToString(data.documentElement);
        xmlDoc = $.parseXML( xml ),
        $xml = $( xmlDoc ),
        $title = $xml.find("time");
		
        $( "#someElement" ).append( $title.text() );
             
     });


}
     
        </script>
	 
	<div id="wrapper">
	
		
		
		<button onclick="sendToDatabase()">Query Service</button>
		
		
		
		  <p id="someElement"></p>
            <p id="anotherElement"></p>

       
		
		

		<script>
		var currentId = 0;

		function checkForAnswer(){
			
			 $.post( "ajax.php", { type: "checkstatus", id:currentId })      
			.done(function( data ) {   
			
					 if(data == '0'){
					  alert('no answer yet')
					 } else {
						getAnswer();
					 }       
				});
			}
			
		  function getAnswer(){
			
			 $.post( "ajax.php", { type: "getAnswer", id:currentId })      
			.done(function( data ) {   
			
					 $("#answerBox").html(data);       
				});  
			}

		function askQuestion(){

			var var1 = document.getElementById('app_name').value;
			var var2 = document.getElementById('app_ques').value; 
			
			
			$.post( "ajax.php", { type: "submitquestion", app_name: var1, app_ques: var2 })      
			.done(function( data ) {        
				 
				  currentId = data;
				  // pop up a box to the user
				  $( "#sampledialog" ).dialog();
				   $( "#hiddendiv" ).show();
			});
			
			
			// start the timer to check for an answer
			setInterval(function(){ checkForAnswer(); }, 10000);
                

		}




		</script>

		<div id="questionBox">
   
			<!--
			<form> 
			BUG! app stops working when you include the form tag?-->

			Name: <input type="text" name="app_name" id="app_name"></input><br>   


			Question: <input type="text" name="app_ques" id="app_ques"> </input><br>
			
			<button onclick="askQuestion();">Ask Question</button> 
			
			<!--
			</form> 
			Removing tag for now
			-->
			
			<div id="sampledialog" title="Basic dialog">
			  <p>Thank you for asking a question, please wait for an answer!</p>
			</div>
		
		</div><!--end of questionBox-->

		<div id ="answerBox">

		</div><!--End of answerBox-->
    
	<script>
      $( "#sampledialog" ).hide();
      $( "#hiddendiv" ).hide();
      
	</script>
  
	</div><!--End of Wrapper div-->
	
</body>	

    
