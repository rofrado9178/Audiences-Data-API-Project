async function insertData(data, url) {
  const response = await fetch(url, {
    method: "POST",
    body: data,
  });

  const responseData = await response.json();
  alert(responseData);
}

const myTicket = document.querySelector("#add-ticket");

myTicket.addEventListener("submit", function (e) {
  e.preventDefault();

  const ticketUrl = "./form.php";
  const addTicket = new FormData(myTicket);

  insertData(addTicket, ticketUrl);

  myTicket.reset();
});
