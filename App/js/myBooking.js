const myBookingLists = document.querySelector(".my-booking");
const welcomeName = document.querySelector(".welcome");
const url = "./userBooking.php";

async function myBooking(url) {
  const response = await fetch(url);
  const datas = await response.json();

  datas.map((data) => {
    welcomeName.innerHTML = `Welcome ${data.username}`;
    myBookingLists.innerHTML += `
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
    `;
  });
}

myBooking(url);
