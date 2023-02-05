<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		Office Hours Sign Up
	</title>
<link rel="stylesheet" type="text/css" href="sup.css">
</head>
	<body>
		<h1> Office Hours Signup Form</h1>
		<?php
         date_default_timezone_set('America/New_York');           
         $d = mktime(0,0,0,date("m"),1,date("Y"));  //Current month and year are passes as building the date 
         $f= date("w",$d);                          //'w' will Find the numeric rep of first day of month
         //echo $f;                                   //$f is first day of month in numerics
         echo "<br/>";
         $n = date("t");                              //number of days of the month
         ?>

         
		  <form method = "post" action = "calender.php">
            <label for="name">Student name:</label>
			<input type = "text" name = "name" center>
            <label for="name">Email:</label>
			<input type = "text" name = "email" center>
			<br/><br/>
			<input type = "submit" value = "submit">
		 
		 <br/>
        <?php
        function cal($input){
        switch($input)
                 	{
                      case 1:
                       
                         $officehour = "mon_time"; 
                         break;
                       
                      case 2:
                        $officehour = "tue_time"; 
                         break;
                      case 3:
                        $officehour = "wed_time"; 
                         break;
                      case 4:
                        $officehour = "thur_time"; 
                         break;
                      case 5:
                        $officehour= "fri_time"; 
                         break;
                      default:
                        $officehour = " ";                
                    }
                    return $officehour;
                }

        ?>
        
	    <?php
	        if(!empty($_POST['time']))
	        	$time = $_POST['time'];
	        if(!empty($_POST['name']))
	        	$name = $_POST['name'];
		    if (!empty($_POST['email']))
		    $email = "Email successfully sent from " . $_POST['email'];
		    if (!empty($email))
			echo $email;
            echo "<div><h1><b>" .date("F",$d)."&nbsp".date("Y",$d)."</h1></b></div>" ; //Prints the month and year in blocks
        ?>
        
		                
            
	    <table width ="100%" bgcolor="#E0E0E0">
         <tr>
         
         <?php
          for($d=1;$d<=7;$d++)
          {
          	echo"<th>".date("l",mktime(0,0,0,05,$d,2022))."</th>";              // Printing the first row with names of days
          }
         ?>
         
         </tr> 	
             <!-- Implementation for first row seperately --> 
             <tr>
         	<?php
         	 $startdate = 1;
         	function numofblanks($f)
            {
             switch($f)
             {
             	case 0:
             	{
             		$blanks = 0;
             		break;
             	}
             	case 1:
             	{
             		$blanks = 1;
             		break;
             	}
             	case 2:
             	{
             		$blanks = 2;
             		break;
             	}
             	case 3:
             	{
             		$blanks = 3;
             		break;
             	}
             	case 4:
             	{
             		$blanks = 4;
             		break;
             	}
             	case 5:
             	{
             		$blanks = 5; 
             		break;
             	}
             	case 6:
             	{
             		$blanks = 6;
             		break;
             	}
             	default:
             	 $blanks = 0;
             }
             return $blanks;
         }
            $blanks = numofblanks($f); 
            //echo $blanks;
            $remstart = (7-$blanks);
            echo "<br/>";
            //echo $remstart;
            //Printing the first row which differs based on the number of blanks
            for($i=0;$i<$blanks;$i++){
              echo "<td>&nbsp</td>";                //Printing the number of blanks
            }
            for($j=1;$j<=$remstart;$j++)            //Printing the numbers after the blanks
            {
                                      //(0,0,0,10,01,2018)
                 $input= date("w",mktime(0,0,0,date("m"),$startdate,date("Y"))); //Day of the week
                 
                 echo "<td valign = top >".($startdate)."<br/>"; //Printing of dates start here
                 $officehour = cal($input);         //getting the array of time submitted

                if (!empty($_POST["$officehour"]))
                {
                foreach ($_POST["$officehour"]  as $x)
                {
                  //print_r($officehour);
                  //print_r($x);
                  //echo $startdate.$x;


                 /* if (isset(($startdate-1).time) &&(($startdate-1).time)==$x)
                    {echo ($startdate-1).time;
                    echo "$x --". $name. "<br />";}
                  printer_draw_elipse(printer_handle, ul_x, ul_y, lr_x, lr_y)
                    {echo "<input type= radio multiple name =($startdate-1).time value= $x />". $x. "<br />"; }
                  echo "<input type= hidden name=  $officehour"."[]"." value= $x />";*/
                  //echo magic;
                 // echo ($startdate-1).time;
                
                if (isset($time) && ("$startdate".$x == $time))
                    {//echo ($startdate-1).time;
                    echo "$x --". $name. "<br />";}
                  else
                    //The value for time variable is stored as $startdate.radio clicked  
                    {echo '<input type= radio multiple name = time value= "'."$startdate".$x.'" />'. $x. '<br />'; }
                  echo "<input type= hidden name=  $officehour"."[]"." value= $x />";

                 }
               }
                  // $(($startdate-1).time)
               echo "</td>";
               $startdate++;
            }  
            ?> 
             </tr>

             <!--Printing of remaining rows-->
             <?php
             for($row=1;$row<=5;$row++)
            {
              echo "<tr>";

              for($col=1;$col<=7;$col++)
              {
              	 $input= date("w",mktime(0,0,0,date("m"),$startdate,date("Y")));
               echo "<td valign = top>".($startdate)."<br/>";
               $officehour= cal($input);
                if (!empty($_POST["$officehour"]))
                {
                foreach ($_POST["$officehour"]  as $x){
                  if (isset($time) &&("$startdate".$x == $time) )
                    echo "$x --".$name."<br />";
                  else
                    echo '<input type= radio multiple name = time value= "'."$startdate".$x.'" />'. $x. '<br />';
                 }
               }

               echo"</td>";
               $startdate++;
               if($startdate==$n)
              	break;
              }
              echo "</tr>";
              if($startdate==$n)
              	break;
            }
         	?>
         
	    </table> 
         </form>
	</body>

</html>
