let isLoggin = true;
if (isLoggin !== true) {
  location.href = "../documentaion.html";
}

const searchTicket = document.getElementById("search-id");
const editForm = document.querySelector(".editForm");
let bookingId;
//function that create table
async function displayTicket(data) {
  const newSection = document.createElement("article");
  const showData = document.querySelector(".showData");

  showData.appendChild(newSection);
  await data.map((data) => {
    newSection.innerHTML = `
    <table>
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Date</th>
          <th>Adult</th>
          <th>Kids Under 4</th>
          <th>Kids 4 to 18</th>
          <th>Senior 60+ </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='ticketId'>${data.ticket_id}</td>
          <td class='date'>${data.date}</td>
          <td class='adult'>${data.adult}</td>
          <td class='kidsU4'>${data.kids_under_4}</td>
          <td class='kidsTo18'>${data.kids_4_to_18}</td>
          <td class='senior'>${data.senior_over60}</td>
        </tr>
      </tbody>
    </table>
    <button class="edit">Edit</button>
    `;
  });

  //edit selector
  const editBtn = document.querySelector(".edit");
  // const idInput = document.querySelector(".bookingId");
  editBtn.addEventListener("click", function (e) {
    e.preventDefault();
    // idInput.setAttribute("value", `${bookingId}`);
    editForm.style.display = "block";
  });
}
//close selector
const closeBtn = document.querySelector(".closeBtn");
//add evenlistener to close button
closeBtn.addEventListener("click", function (e) {
  e.preventDefault();
  editForm.style.display = "none";
});

//function to show the table.
async function showContent(
  datas,
  classId,
  classDate,
  classAdult,
  classKidsU4,
  classKidsTo18,
  classSenior
) {
  await datas.map((data) => {
    const ticketId = document.querySelector(classId);
    const date = document.querySelector(classDate);
    const adult = document.querySelector(classAdult);
    const kidsU4 = document.querySelector(classKidsU4);
    const kidsTo18 = document.querySelector(classKidsTo18);
    const senior = document.querySelector(classSenior);

    ticketId.innerHTML = data.ticket_id;
    date.innerHTML = data.date;
    adult.innerHTML = data.adult;
    kidsU4.innerHTML = data.kids_under_4;
    kidsTo18.innerHTML = data.kids_4_to_18;
    senior.innerHTML = data.senior_over60;
  });
}

//insert and submit form
async function insertTicketData(data, url) {
  const response = await fetch(url, {
    method: "POST",
    body: data,
  });
  const responseData = await response.json();
  // console.log(responseData);

  //check if parent element already has children or not
  const showData = document.querySelector(".showData");
  if (showData.childElementCount === 0) {
    displayTicket(responseData);
  } else {
    showContent(
      responseData,
      ".ticketId",
      ".date",
      ".adult",
      ".kidsU4",
      ".kidsTo18",
      ".senior"
    );
  }
}

//add event listener to  search ticket by id form
searchTicket.addEventListener("submit", function (e) {
  e.preventDefault();

  const url = "./edit.php";
  const addId = new FormData(searchTicket);

  insertTicketData(addId, url);
  searchTicket.reset();
});

// //function to edit ticket
async function updateTicketForm(data, url) {
  const response = await fetch(url, {
    method: "POST",
    body: data,
  });
  const responseData = await response.json();
  console.log(responseData);
  showContent(
    responseData,
    ".ticketId",
    ".date",
    ".adult",
    ".kidsU4",
    ".kidsTo18",
    ".senior"
  );
}

//add event listener to edit ticket
if (editForm) {
  const updateTicket = document.getElementById("edit-form");

  updateTicket.addEventListener("submit", function (e) {
    e.preventDefault();
    const url = "./update.php";
    const updateTicketData = new FormData(updateTicket);

    updateTicketForm(updateTicketData, url);

    updateTicket.reset();
  });
}
