<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Library</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<style>
  p {
    margin-left: 1rem;
  }
</style>

<body>
  <form action="register.php" method="post" class="form">
    <!-- TAG: TITLE -->

    <div class="form-legend">
      <h2>Register - Library</h2>
    </div>
    <!-- TAG: FORM -->
    <div class="form-div">
      <!-- TAG: Name -->
      <div class="input-div">
        <div class="input-svg">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill"
            viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
          </svg>
        </div>
        <!-- TAG: Name Input -->
        <div class="input">
          <input type="text" name="name" placeholder="&nbsp;name" id="" />
        </div>
      </div>
      <!-- TAG: Email -->
      <div class="input-div">
        <div class="input-svg">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
            <path
              d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671" />
            <path
              d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791" />
          </svg>
        </div>
        <!-- TAG: Email Input -->
        <div class="input">
          <input type="Email" name="email" placeholder="&nbsp;Email" id="" />
        </div>
      </div>
      <!-- TAG: Password -->
      <div class="input-div">
        <div class="input-svg input-password-svg">
          <!-- ///// EYE SVG ///// -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-eye-fill eye-btn hidden" viewBox="0 0 16 16" id="eye--open">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-eye-slash-fill eye-btn" viewBox="0 0 16 16" id="eye--closed">
            <path
              d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z" />
            <path
              d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
          </svg>
        </div>
        <!-- TAG: Password Input -->
        <div class="input">
          <input type="password" name="password" placeholder="&nbsp;password" id="psw--input" />
        </div>
      </div>
      <!-- Register link -->
      <p>Already a member? <a href="../index.php">Login now!</a></p>
      <!-- Submit -->
      <div class="submit-div">
        <input type="submit" value="Enter" class="submit" />
      </div>
    </div>
  </form>
</body>
<script>
  const pswInput = document.getElementById('psw--input');
  const eyeOpen = document.getElementById('eye--open');
  const eyeClosed = document.getElementById('eye--closed');

  eyeOpen.addEventListener('click', function () {
    eyeOpen.classList.add('hidden');
    eyeClosed.classList.remove('hidden');

    if (pswInput.type === 'password') {
      pswInput.type = 'text';
    } else {
      pswInput.type = 'password';
    }
  });
  eyeClosed.addEventListener('click', function () {
    eyeClosed.classList.add('hidden');
    eyeOpen.classList.remove('hidden');

    if (pswInput.type === 'password') {
      pswInput.type = 'text';
    } else {
      pswInput.type = 'password';
    }
  });
</script>

</html>