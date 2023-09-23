async function registerUser(data, url) {
  try {
    const response = await fetch(url, {
      method: "POST",
      body: data,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const responseData = await response.json();
    register.reset();
    // console.log(JSON.parse(responseData));
  } catch (error) {
    console.error("Error oocurred", error);
  }
}

const register = document.querySelector("#register");

register.addEventListener("submit", function (e) {
  e.preventDefault();
  const registerUrl = "./register.php";

  const userRegistration = new FormData(register);
  // console.log(userRegistration);
  registerUser(userRegistration, registerUrl);
});
