const loginForm = document.getElementById("login");

async function login(data, url) {
  try {
    const response = await fetch(url, {
      method: "POST",
      body: data,
    });

    if (!response.ok) {
      throw new Error(`Error ${response}`);
      // console.log(response);
    }

    window.location.href = "./mybooking.html";
    const responseData = await response.json();
    // console.log(JSON.parse(responseData));
  } catch (error) {
    console.error("Error oocurred", error);
  }
}

loginForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const url = "./login.php";
  const credential = new FormData(loginForm);

  login(credential, url);
});
