//data fetching
async function dataFetch(url) {
  const response = await fetch(url);
  const data = await response.json();

  console.log(data);
}

dataFetch("./showData.php");

// async function insertData(data, url) {
//   const response = await fetch(url, {
//     method: "POST",
//     body: data,
//   });

//   const responseData = await response.json();
//   showChart(responseData);
// }

//data insert function

//submit date form
const myForm = document.querySelector("#form-submit");

myForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const url = "./totalAudience.php";
  const formData = new FormData(myForm);

  const chartTitle = document.querySelectorAll(".chart-title");

  insertData(formData, url);

  chartTitle.forEach((item) => (item.style.display = "block"));
});

//submit ticket form

//new try add insert.

let barChart;
let pieChart;
async function insertData(data, url) {
  const response = await fetch(url, {
    method: "POST",
    body: data,
  });

  const responseData = await response.json();
  console.log(responseData);

  if (barChart) {
    barChart.destroy();
  }
  if (pieChart) {
    pieChart.destroy();
  }

  const adult = responseData.map((data) => data["SUM(adult)"]);
  const kidsUnder4 = responseData.map((data) => data["SUM(kids_under_4)"]);
  const kidsOver4 = responseData.map((data) => data["SUM(kids_4_to_18)"]);
  const senior = responseData.map((data) => data["SUM(senior_over60)"]);
  // Sample data for the charts
  let barChartData;
  barChartData = {
    labels: ["Adult", "Kids Under 4 Years", "Kids 4 to 18 Years", "Senior"],
    datasets: [
      {
        backgroundColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(11,156,49,1)",
        ],
        borderColor: "rgba(0, 0, 0, 1)",
        borderWidth: 1,
        data: [adult, kidsUnder4, kidsOver4, senior],
      },
    ],
  };

  // Create the bar chart

  let barChartCanvas = document.getElementById("barChart").getContext("2d");

  barChart = new Chart(barChartCanvas, {
    type: "bar",
    data: barChartData,
    options: {
      indexAxis: "y",
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false, // Hide the legend (labels on top of bars)
        },
      },
    },
  });

  //pie chart
  const pieChartData = {
    labels: ["Adults", "Kids Under 4", "Kids 4 to 18 Years", "Senior"],
    datasets: [
      {
        data: [adult, kidsUnder4, kidsOver4, senior],
        backgroundColor: [
          "rgba(255, 99, 132, 0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(11,156,49,0.4)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(11,156,49,1)",
        ],
        borderWidth: 1,
      },
    ],
  };
  // Create the pie chart

  const pieChartCanvas = document.getElementById("pieChart").getContext("2d");
  pieChart = new Chart(pieChartCanvas, {
    type: "pie",
    data: pieChartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  });
}
