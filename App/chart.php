
<?php 

//require db connection from db_connect
require_once "./_includes/db_connect.php";

//(`ticket_id`, `adult`, `kids_under_4`, `kids_4_to_18`, `senior_over60`, `date`)


if(isset($_REQUEST["date"])){
  $selectedDate = $_REQUEST["date"];

  //statement to display only total of each audience to that day.
  $statement = mysqli_prepare($link, "SELECT ticket_id, SUM(adult), SUM(kids_under_4), SUM(kids_4_to_18), SUM(senior_over60) FROM audiences WHERE date='$selectedDate'");

  //statement to display all data
  // $statement = mysqli_prepare($link, "SELECT ticket_id, adult, kids_under_4, kids_4_to_18, senior_over60, date FROM audiences WHERE date='$selectedDate'");
  // echo $selectedDate;

// $statement = mysqli_prepare($link, "SELECT * FROM audiences WHERE date = $selectedDate");

//execute the query statement
  mysqli_stmt_execute($statement);

//get the result
  $result = mysqli_stmt_get_result($statement);

//loop through the row and give back the result as a json format
  
  

  while($row = mysqli_fetch_assoc($result)){

    $results[] = $row;
  }

  //add the result into variable;
  $adult = (int)$results[0]["SUM(adult)"];
  $kidsUnder4 = (int)$results[0]["SUM(kids_under_4)"];
  $kidsOver4 = (int)$results[0]["SUM(kids_4_to_18)"];
  $senior = $results[0]["SUM(senior_over60)"];

  // $adult = $results[0]["SUM(adult)"];
  // $kidsUnder4 = $results[0]["SUM(kids_under_4)"];
  // $kidsOver4 = $results[0]["SUM(kids_4_to_18)"];
  // $senior = $results[0]["SUM(senior_over60)"];

  // echo json_encode($results);
  // echo $results[0]["ticket_id"];
  // echo gettype($adult);
  // echo $adult;
  // header("Location: chart.php");

  mysqli_close($link);

  

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Charts Example</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<section>
    <form action="chart.php" method="POST">
        <input type="date" name="date">
        <input type="submit" value="Submit">
    </form>
</section>
    <div style="width: 50%; margin: auto;">
        <canvas id="barChart"></canvas>
        <canvas id="pieChart"></canvas>
    </div>

    <script>
      const adult = <?php echo $adult ?>;
      const kidsUnder4 = <?php echo $kidsUnder4 ?>;
      const kidsOver4 = <?php echo $kidsOver4 ?>;
      const senior = <?php echo $senior ?>;
     
      
        // Sample data for the charts
        const barChartData = {
            labels: ['Adult', 'Kids Under 4 Years', 'Kids 4 to 18 Years', 'Senior'],
            datasets: [{
                label: 'Bar Chart',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: [adult, kidsUnder4, kidsOver4, senior],
            }]
        };

        // Create the bar chart
        const barChartCanvas = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

      
    </script>
</body>
</html>

