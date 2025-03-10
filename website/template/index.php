<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "computerdictionary";

// ایجاد اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("اتصال ناموفق: " . $conn->connect_error);
}

$sql = "SELECT * FROM `term` ORDER BY TermInitialLetters;";
$sql2 = "SELECT COUNT(`Term`) AS term_count FROM `term`;";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="../static/node_modules/bootstrap/dist/css/bootstrap.rtl.min.css">
        <link rel="stylesheet" href="../static/css/image.css">
        <link rel="stylesheet" href="../static/css/form.css">
        <script rel="script">
            document.getElementById("search_box").name = "search_" + Math.random();
        </script>
    </head>
    <body>

        <div class="container-fluid position-relative p-0 vh-100 vw-100 overflow-hidden">
            <img src="../static/image/svg/layered-waves-haikei.svg" alt="background" class="position-absolute w-100 h-100 object-fit-cover z-0 background-image-custom">
            <div class="row m-0">
                <div class="col-12 position-absolute z-2">
                    <nav class="navbar navbar-expand-lg" style="background-color: #001220" data-bs-theme="dark">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Computer<br>Dictionary</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            جستجو بر اساس
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">جستجو بر اساس کلمات</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">جستسجو بر اساس دسته بندی</a></li>
                                            <li><a class="dropdown-item" href="#">جستجو بر اساس کلمات مختصر</a></li>
                                            <li><a class="dropdown-item" href="#">جستسجو بر اساس رتبه علمی کلمات</a></li>
                                            <li><a class="dropdown-item" href="#">جستجو بر اساس حروف الفبا</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">سوالات متداول</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">درباره ما</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="timeList" href="#"></a>
                                    </li>
                                </ul>
                                <ul class="d-flex navbar-nav mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">FA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">ثبت نام | ورود</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row m-0 vh-100 text-white text-center">
                <div class="col-12 d-flex flex-column justify-content-center position-absolute z-1 vh-100">
                    <h2>Computer Dictionary</h2>
                    <h2>اولین دیکشنری فارسی حرفه ای کامپیوتر</h2>
                    <form action="" class="custom-width mx-auto">
                        <div class="autocomplete mb-3">
                            <label for="search_box"></label>
                            <input dir="ltr" class="form-control search-box" type="text" id="search_box" placeholder="search, learn, enjoy" onkeyup="filterFunction()" autocomplete="off">
                            <div class="autocomplete-items" id="autocomplete_list">
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $term = strtolower($row["Term"]);
                                        $acronym = isset($row["TermAcronym"]) ? " | " . $row["TermAcronym"] : "";
                                        echo "<div onclick='selectItem(this)' data-term='{$term}'>" . $row["Term"] . $acronym . "</div>";
                                    }
                                } else {
                                    echo "<div style='direction: rtl; text-align: right'>","یک مشکلی پیش اومده لطفا از سایت خارج شده و دوباره وارد شوید اگر درست نشد با پشتیبانی تماس بگیرید","</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                    <p>در حال حاضر دیکشنری شامل <?php
                        // Assuming $result2 is the result of a query like the one above
                        $row = $result2->fetch_assoc();
                        echo $row['term_count']; // This will display the count
                        ?>
                        واژه است و همچنان در حال گسترش می‌باشد.</p>
                </div>
            </div>
        </div>
        <script rel="script" src="../static/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script rel="script" src="../static/js/autocomplete.js"></script>
    </body>
</html>