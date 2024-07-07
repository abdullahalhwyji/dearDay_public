<!doctype html>
<html lang="en">

<head>
  <title>Register</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>

  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-10">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-2">
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-2 mt-3">Sign up</p>
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <form class="mx-1 mx-md-2" action="add.php" method="post" onsubmit="return validateForm()" novalidate>
                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c"><i class="bi bi-person-circle"></i> Your Name</label>
                        <input type="text" id="form3Example1c" class="form-control form-control-lg py-2" name="name" autocomplete="off" placeholder="Enter your name" style="border-radius:25px ;" required />
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c"><i class="bi bi-envelope-at-fill"></i> Your Email</label>
                        <input type="email" id="form3Example3c" class="form-control form-control-lg py-2" name="username" autocomplete="off" placeholder="Enter your email" style="border-radius:25px ;" required />
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-calendar-alt fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example5cd"><i class="bi bi-calendar-event"></i> Birth Date</label>
                        <input type="date" id="form3Example5cd" class="form-control form-control-lg py-2" name="birth_date" autocomplete="off" placeholder="Select your birth date" style="border-radius:25px ;" required />
                      </div>
                    </div>

                    <!-- <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-city fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example6cd"><i class="bi bi-building"></i> City</label>
                        <input type="text" id="form3Example6cd" class="form-control form-control-lg py-2" name="city" autocomplete="off" placeholder="Enter your city" style="border-radius:25px ;" required />
                      </div>
                    </div> -->

                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-city fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example6c"><i class="bi bi-geo-alt-fill"></i> City</label>
                        <select id="form3Example6c" class="form-control form-control-lg py-2" name="city" style="border-radius:25px ;" required>
                          <option value="" disabled selected>Select your city</option>
                          <option value="Jakarta">Jakarta</option>
<option value="Surabaya">Surabaya</option>
<option value="Bandung">Bandung</option>
<option value="Medan">Medan</option>
<option value="Semarang">Semarang</option>
<option value="Makassar">Makassar</option>
<option value="Yogyakarta">Yogyakarta</option>
<option value="Palembang">Palembang</option>
<option value="Denpasar">Denpasar</option>
<option value="Pekanbaru">Pekanbaru</option>
<option value="Banjarmasin">Banjarmasin</option>
<option value="Batam">Batam</option>
<option value="Malang">Malang</option>
<option value="Tasikmalaya">Tasikmalaya</option>
<option value="Pontianak">Pontianak</option>
<option value="Manado">Manado</option>
<option value="Padang">Padang</option>
<option value="Balikpapan">Balikpapan</option>
<option value="Samarinda">Samarinda</option>
<option value="Cirebon">Cirebon</option>
<option value="Mataram">Mataram</option>
<option value="Kupang">Kupang</option>
<option value="Jambi">Jambi</option>
<option value="Surakarta">Surakarta</option>
<option value="Bogor">Bogor</option>
<option value="Tangerang">Tangerang</option>
<option value="Depok">Depok</option>
<option value="Bekasi">Bekasi</option>
<option value="Banda Aceh">Banda Aceh</option>
<option value="Ambon">Ambon</option>
<option value="Jayapura">Jayapura</option>
<option value="Gorontalo">Gorontalo</option>
<option value="Tarakan">Tarakan</option>
<option value="Palu">Palu</option>
<option value="Kendari">Kendari</option>
<option value="Ternate">Ternate</option>
<option value="Sorong">Sorong</option>
<option value="Bengkulu">Bengkulu</option>
<option value="Tanjungpinang">Tanjungpinang</option>
<option value="Pangkalpinang">Pangkalpinang</option>
<option value="Serang">Serang</option>
<option value="Bandar Lampung">Bandar Lampung</option>
<option value="Palangka Raya">Palangka Raya</option>
<option value="Tanjung Selor">Tanjung Selor</option>
<option value="Mamuju">Mamuju</option>
<option value="Manokwari">Manokwari</option>
<option value="Kaimana">Kaimana</option>
<option value="other">Other</option>

                          <!-- Add more cities as needed -->
                        </select>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-venus-mars fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example7cd"><i class="bi bi-gender-ambiguous"></i> Gender</label>
                        <select id="form3Example7cd" class="form-control form-control-lg py-2" name="gender" style="border-radius:25px ;" required>
                          <option value="" disabled selected>Select your gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c"><i class="bi bi-lock-fill"></i> Password</label>
                        <input type="password" id="form3Example4c" class="form-control form-control-lg py-2" name="password" autocomplete="off" placeholder="Enter your password" style="border-radius:25px ;" required />
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4cd"><i class="bi bi-key-fill"></i> Repeat your password</label>
                        <input type="password" id="form3Example4cd" class="form-control form-control-lg py-2" name="repeat_password" autocomplete="off" placeholder="Repeat your password" style="border-radius:25px ;" required />
                      </div>
                    </div>

                    <!-- Display error message -->
                    <?php
                      if (isset($_GET['error'])) {
                        echo '<div class="text-danger mb-3">'.htmlspecialchars($_GET['error']).'</div>';
                      }
                    ?>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <input type="submit" value="Register" name="register" class="btn btn-warning btn-lg text-light my-2 py-3" style="width:100% ; border-radius: 30px; font-weight:600; background-color: #D35F94; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#E490D0'" onmouseout="this.style.backgroundColor='#D35F94'" />
                    </div>

                  </form>
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="img/moodTracker.png" class="img-fluid" alt="Sample image" height="300px" width="500px">

                </div>
              </div>
              <p align="center">Already have an account? <a href="index.php" style="font-weight:600;text-decoration:none; color : #D35F94;">Login Here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
