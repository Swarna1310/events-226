<html>
<head><title></title></head>
<body>
   <h1>Search Results</h1>
<?php

  	 $searchtype = filter_input(INPUT_POST, "searchtype");
      try {
      
      //add connection to database here $con =

            if ($searchtype == "all") {
            $query = "SELECT * FROM events";  
            echo $query;
      //add call to function that displays query results in table  
            }
            else if ($searchtype == "byfield") {
              $field = filter_input(INPUT_POST, "field");
                switch ($field) {
                    case "eventname":
                    	$name = filter_input(INPUT_POST, "name");
                   		$query = "SELECT * FROM events where event_name like '%" . $name . "%'";                                           
      //add table results call here                       
                        break;

                    case "location":
                    	$location = filter_input(INPUT_POST, "location");
                    	$query = "SELECT * FROM events where event_address like '%" . $location . "%'";                                      
      //add table results call here        
                        break;

                    case "month":
                    	$month = filter_input(INPUT_POST, "month");
                    	$query = "SELECT * FROM events where MONTH(event_date) = " . $month;
                        //$monthname = date("F", mktime(0, 0, 0, $month, 10));
      //add table results call here  
                        break;

		                case "charge":
                        if(filter_has_var(INPUT_POST, "free") && filter_has_var(INPUT_POST, "paid"))
                        {
                           $query = "SELECT * FROM events";
                        }
                        else if(filter_has_var(INPUT_POST, "free")){
                           $query = "SELECT * FROM events where event_free = 1";
                        }
                        else if(filter_has_var(INPUT_POST, "paid")){
                            $query = "SELECT * FROM events where event_free = 0";
                        }
      //add table results call here      
                        break;

                    case "category":
                        $category = filter_input(INPUT_POST, "category");
                        $query = "SELECT * FROM events where event_category = '" . $category . "'";                     
      //add table results call here     
                        break;
                }
                echo $query;


            }
            else {                
                $event = filter_input(INPUT_POST, "name");
                $loc = filter_input(INPUT_POST, "location");
                $mon = filter_input(INPUT_POST, "month");
                $cat = filter_input(INPUT_POST, "category");
                $query = "SELECT * FROM events where event_name like '%" . $event . "%' and event_address like '%" . $loc . "%' and MONTH(event_date) = " . $mon . " and event_category = '" . $cat . "'";
                       if(filter_has_var(INPUT_POST, "free") && filter_has_var(INPUT_POST, "paid")){
                            $query = $query . "";
                        }
                        else if(filter_has_var(INPUT_POST, "free")){
                           $query = $query . " and event_free = 1";
                        }
                        else if(filter_has_var(INPUT_POST, "paid")){
                            $query = $query . " and event_free = 0";
                        }
                      echo $query;
      // add call to function that displays query results in table     

            }
        }
         catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }  
?>

</body>
</html>