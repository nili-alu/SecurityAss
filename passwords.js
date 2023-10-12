function checkPasswordStrength() {
  var password = document.getElementById("password").value;
  var passwordStrengthBar = document.getElementById("password-strength-bar");
  var registrationButton = document.getElementById("registration-button");

  // Define regular expressions for each requirement
  var hasUpperCase = /[A-Z]/.test(password);
  var hasLowerCase = /[a-z]/.test(password);
  var hasNumbers = /\d/.test(password);
  var hasSpecialChars = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password);

  // Calculate password strength based on the requirements
  var strength = 0;
  if (hasUpperCase) strength++;
  if (hasLowerCase) strength++;
  if (hasNumbers) strength++;
  if (hasSpecialChars) strength++;

  // Update the password strength bar
  if (strength == 0) {
    passwordStrengthBar.innerHTML = "Weak";
    passwordStrengthBar.style.color = "red";
    registrationButton.disabled = true;
  } else if (strength < 4) {
    passwordStrengthBar.innerHTML = "Medium";
    passwordStrengthBar.style.color = "orange";
    registrationButton.disabled = true;
  } else {
    passwordStrengthBar.innerHTML = "Strong";
    passwordStrengthBar.style.color = "green";
    registrationButton.disabled = false; // Enable the button
  }
}
