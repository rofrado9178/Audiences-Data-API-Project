const searchTicket = document.getElementById("search-id");
const editForm = document.querySelector(".editForm");

async function displayTicket(data) {
  const newSection = document.createElement("article");
  const showData = document.querySelector(".showData");

  showData.appendChild(newSection);
  await data.map((data) => {
    newSection.innerHTML = `
    <table>
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Adult</th>
          <th>Kids Under 4</th>
          <th>Kids 4 to 18</th>
          <th>Senior 60+ </th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='ticketId'>${data.ticket_id}</td>
          <td class='adult'>${data.adult}</td>
          <td class='kidsU4'>${data.kids_under_4}</td>
          <td class='kidsTo18'>${data.kids_4_to_18}</td>
          <td class='senior'>${data.senior_over60}</td>
          <td class=''> <button class="edit">Edit</button> </td>
        </tr>
      </tbody>
    </table>

    `;
  });

  const editBtn = document.querySelector(".edit");
  editBtn.addEventListener("click", function (e) {
    e.preventDefault();
    editForm.style.display = "block";
  });
}

const closeBtn = document.querySelector(".closeBtn");

closeBtn.addEventListener("click", function (e) {
  e.preventDefault();
  editForm.style.display = "none";
});

//insert and submit form
async function insertTicketData(data, url) {
  const response = await fetch(url, {
    method: "POST",
    body: data,
  });
  const responseData = await response.json();
  console.log(responseData);
  displayTicket(responseData);
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
  // displayTicket(...responseData);
}

//add event listener to edit ticket
if (editForm) {
  const updateTicket = document.getElementById("edit-form");

  updateTicket.addEventListener("submit", function (e) {
    e.preventDefault();
    const url = "./update.php";
    const updateTicketData = new FormData(updateTicket);

    insertTicketData(updateTicketData, url);

    updateTicket.reset();
  });
}
