
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset-password</title>
    <style>body {
  background-color: #dcedc8;
  color: #0f0f0f;
  font-family: "Poppins", sans-serif;
  font-size: 1rem;
  line-height: 1.5rem;
  font-weight: 600;
  margin: 30px;
  height: calc(100vh - 60px);
  display: flex;
  align-items: center;
  justify-content: center;
}

main {
  background-color: #ffffff;
  width: 25vw;
  padding: 30px;
  border-radius: 30px;
  box-shadow: 2px 2px 5px #c5e1a5;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: auto auto;
  gap: 30px;
}

.material-symbols-outlined {
  font-variation-settings: "FILL" 0, "wght" 300, "GRAD" 0, "opsz" 40;
}

fieldset {
  position: relative;
  vertical-align: center;
  border: 0;
  padding: 0;
}

label {
  display: block;
}

input {
  border: 1px solid #8c8c8c;
  color: #0f0f0f;
  background-color: #ffffff;
  font-family: "Poppins", sans-serif;
  font-size: 1em;
  font-weight: 300;
  padding: 5px 30px 5px 5px;
  width: calc(100% - 35px);
}

input:focus {
  border-color: #0f0f0f;
  outline: 1px solid #0f0f0f;
}

.visibility {
  position: absolute;
  left: calc(100% - 24px - 2px);
  top: calc(1.5em - 5px);
}

.visibility:hover {
  cursor: pointer;
}

.invalid {
  border-color: red;
}

.invalid:focus {
  border-color: red;
  outline: 1px solid red;
}

.confirm-password-error {
  color: red;
  font-weight: 400;
}
</style>
</head>
<body>
    <link rel="preconnect" href="https://fonts.gstatic.com/" />
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<form action="/reset_employee"  method="post" >
    @csrf
<main>
     	<input type="text" name="email" value="{{$email}}" hidden>
  <fieldset>
    <label for="password">Password</label>
    <input type="password" id="password" name="new_password"required>
    <span class="material-symbols-outlined visibility">visibility_off</span>
  </fieldset>
  <fieldset>
    <label for="password">Confirm password</label>
    <input type="password" id="confirm-password" name="confirm-password" required>
    <span class="material-symbols-outlined visibility">visibility_off</span>
    <span class="confirm-password-error" aria-live="polite"></span>
  </fieldset>
    <fieldset>
  <button type="submit"> Submit</button>
    <fieldset>
</main>

</form>
</body>
</html>
<script>
    //----------------------------//
// Show/hide password buttons //
//----------------------------//

document.querySelectorAll(".visibility").forEach((button) => {
  button.addEventListener("click", togglePasswordVisibility);
});

function togglePasswordVisibility() {
  if (this.previousElementSibling.getAttribute("type") == "password") {
    this.previousElementSibling.setAttribute("type", "text");
    this.innerText = "visibility";
  } else if (this.previousElementSibling.getAttribute("type") == "text") {
    this.previousElementSibling.setAttribute("type", "password");
    this.innerText = "visibility_off";
  }
}

//---------------------//
// Matching the inputs //
//---------------------//

const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");
const confirmPasswordError = document.querySelector(".confirm-password-error");

confirmPassword.addEventListener("change", matchPasswords);
confirmPassword.addEventListener("input", matchPasswords);
confirmPassword.addEventListener("focusout", matchPasswords);
password.addEventListener("change", matchPasswords);
password.addEventListener("input", matchPasswords);
password.addEventListener("focusout", matchPasswords);

function matchPasswords(e) {
  if (
    e.target.id == "confirm-password" ||
    (e.target.id == "password" && confirmPassword.value)
  ) {
    if (
      (e.type == "change" && confirmPassword.value != password.value) ||
      (e.type == "focusout" && confirmPassword.value != password.value)
    ) {
      confirmPasswordError.innerText = "Passwords must match.";
      confirmPassword.classList.add("invalid");
    } else if (confirmPassword.value == password.value) {
      confirmPasswordError.innerText = "";
      confirmPassword.classList.remove("invalid");
    }
  }
}

</script>
