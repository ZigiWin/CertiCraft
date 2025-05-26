<?php

include 'conect.php';

$sql_templates = "SELECT file_path FROM templates";
$result_templates = $conn->query($sql_templates);

$templates = [];
if ($result_templates->num_rows > 0) {
    while ($row = $result_templates->fetch_assoc()) {
        $templates[] = $row['file_path'];
    }
} else {
    echo "No templates found.";
}

$sql_frames = "SELECT file_path FROM frames";
$result_frames = $conn->query($sql_frames);

$frames = [];
if ($result_frames->num_rows > 0) {
    while ($row = $result_frames->fetch_assoc()) {
        $frames[] = $row['file_path'];
    }
} else {
    echo "No frames found.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user_modal.css">
    <title>Document</title>
</head>
<?php include 'user_modal.php'; ?>

<body>

    <div class="header">
        <a href="main.php" class="link">CertiCraft</a>
        <div class="switch-container">
            <button class="switch active" data-side="left">
                <img src="img/text-file_15379419.svg" class="switch-img" alt="Редактор">
                <span>Редактор</span>
            </button>
            <button class="switch" data-side="right">
                <img src="img/layout_16796266.svg" class="switch-img" alt="Таблица">
                <span>Таблица</span>
            </button>
            <div class="underline left"></div>
            <?php
            session_start();
            $avatar = isset($_SESSION['user']['avatar']) ? $_SESSION['user']['avatar'] : 'img/default-avatar.png';
            ?>
            <div id="user-box"></div>
        </div>
    </div>

    <div class="menu-model">
        <p>ШАБЛОНЫ</p>
        <button class="open-menu" data-target="templates">
            <img src="img/split_11613211.svg" alt="Открыть шаблоны">
        </button>
    </div>

    <div class="bottom-buttons">
        <div id="category-menu" class="category-menu">
            <ul id="category-list"></ul>
        </div>

        <canvas id="canvas"></canvas>

        <div class="button-group">
            <button class="icon-btn" data-button-id="button1">
                <img src="img/direct_12796628 1.svg" alt="Icon 1">
            </button>
            <button class="icon-btn" data-button-id="button2">
                <img src="img/copy_16796813 1.svg" alt="Icon 2">
            </button>
            <button class="icon-btn" data-button-id="button3">
                <img src="img/image_12603865 2.svg" alt="Icon 3">
            </button>
            <button class="icon-btn" data-button-id="button4">
                <img src="img/Group.svg" alt="Icon 4">
            </button>
            <button class="icon-btn" data-button-id="button5">
                <img src="img/free-icon-font-text-3914346.svg" alt="Icon 5">
            </button>
            <button class="nav-btn" id="prev-btn">
                <img src="img/left-arrow_12619862 1.svg" alt="Previous">
            </button>
            <button class="nav-btn" id="next-btn">
                <img src="img/left-arrow_12619862 2.svg" alt="Next">
            </button>
        </div>
    </div>

    <button id="knopka">Добавить текст</button>
    <input type="text" id="text-input" placeholder="Введите текст">

    <div class="controls">
        <label for="fontSize">Размер шрифта:</label>
        <input type="number" id="fontSize" value="24" min="10" max="100">

        <label for="fontColor">Цвет текста:</label>
        <input type="color" id="fontColor" value="#000000">
    </div>

    <button id="edit-text-btn">Edit Text</button>


    <div class="sidebar templates">
        <button class="close-menu">
            <img src="img/split_11613211.svg" alt="Закрыть меню">
        </button>
        <p class="shablon-text">ШАБЛОНЫ</p>

        <div class="shablon-container">
            <div class="shablon">
                <?php foreach ($templates as $template): ?>
                    <button class="shablon" onclick="addTemplateToCanvas('<?php echo $template; ?>')">
                        <img src="<?php echo $template; ?>" class="shablon-img" alt="Шаблон">
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="sidebar frames">
        <button class="close-menu">
            <img src="img/split_11613211.svg" alt="Закрыть меню">
        </button>
        <p class="shablon-text">РАМКИ</p>

        <div class="shablon-container">
            <div class="shablon">
                <?php foreach ($frames as $frame): ?>
                    <button class="shablon">
                        <img src="<?php echo $frame; ?>" class="shablon-img" alt="Шаблон">
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="js/user_modal.js"></script>
    <script src="js/userSession.js"></script>
</body>

</html>