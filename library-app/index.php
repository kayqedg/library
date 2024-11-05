<?php
session_start();

if (isset($_POST['submit'])) {
  include_once('pages/config.php');
  $name = $_POST['name'];
  $password = $_POST['password'];

  $sqlSelect = "SELECT * FROM clientes where nome = '$name' AND senha = '$password' ";
  $result = $conexao->query($sqlSelect);

  if ($result->num_rows < 1) {
    // unset($_SESSION['name']);
    // unset($_SESSION['password']);
    // header('location: index.php');
    echo "<script>alert('Usuário ou senha inválidos')</script>";
  } else {
    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
    header('location: pages/system.php');
  }
} else {
}
?>

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
  <link rel="stylesheet" href="css/style.css" />
</head>
<style>
  p {
    margin-left: 1rem;
  }
</style>

<body>
  <form action="index.php" method="post" class="form">
    <!-- TAG: TITLE -->

    <div class="form-legend">
      <h2>Login - Library</h2>
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
          <input type="text" name="name" placeholder="&nbsp;username" id="" required />
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
          <input type="password" name="password" placeholder="&nbsp;password" id="psw--input" required />
        </div>
      </div>
      <!-- Register link -->
      <p>Não é um membro? <a href="pages/register.php">Registre-se!</a></p>
      <!-- Submit -->
      <div class="submit-div">
        <input type="submit" name="submit" id="submit" value="Enter" class="submit" />
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