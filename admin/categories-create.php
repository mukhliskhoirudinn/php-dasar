<?php
$title = 'Create Category';
require "layout/header.php";

if (isset($_POST['submit'])) {
    if (store_category($_POST) > 0) {
        echo "<script>
        alert('Category has been created');
        document.location.href = 'categories.php';
        </script>";
    } else {
        echo "<script>
        alert('Category has not been created');
        document.location.href = 'categories-create.php';
        </script>";
    }
}

?>

<main class="py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-plus"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" readonly>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary float-end" name="submit">
                                    <i class="bi bi-upload"> </i>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="assets/js/helper.js"></script>

<?php
require "layout/footer.php";
?>