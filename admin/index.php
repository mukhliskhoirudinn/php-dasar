<?php
$title = "Dashboard";
require "layout/header.php";

// session_start();
// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
   header('Location: login.php');
   exit();
}

?>

<!-- main -->
<main class="p-4">
   <div class="containter">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card shadow-sm">
               <div class="card-header">
                  <i class="bi bi-pie-chart-fill"></i>
                  <?= $title; ?>
               </div>
               <div class="card-body">
                  <h6>Selamat datang, <?= $_SESSION['username']; ?>
                  </h6>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur voluptatum a aut
                  praesentium accusantium quos voluptas quasi voluptatem. Qui eaque dignissimos incidunt sint
                  unde illum doloribus ut magni beatae eveniet?
               </div>

               <div class="card-footer">
                  Footer
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

<?php
require "layout/footer.php";
?>