<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>CertiCraft</title>
</head>

<body>
    <div class="header">
        <a href="#" class="link">CertiCraft</a>
        <form class="d-flex search-form" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <div class="profile-container">
            <button class="create-file-btn">
                <img src="img/add-svgrepo-com.svg" alt="Create file">
                <p class="createdoc">Создать документ</p>
            </button>
            <?php
            session_start();
            $avatar = isset($_SESSION['user']['avatar']) ? $_SESSION['user']['avatar'] : 'img/default-avatar.png';
            ?>
            <div id="user-box"></div>
        </div>
    </div>
    <div class="mainnav">

        <aside class="sidebar">
            <button class="create-button"><a href="index.php" style="color:white; text-decoration:none;"> + Создать</a></button>
            <ul>
                <li>Мои документы</li>
                <li>Последнее</li>
                <li>Корзина</li>
            </ul>
        </aside>


        <main class="main-content">
            <h2>Мои документы</h2>
            <div class="documents">
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>

                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>

                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>

                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
                <div class="document-folder">
                    <img src="img/gramota-v-vintagnom-stile 1.png" alt="Gramota">
                    <div class="certi-card-text">Грамоты</div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/userSession.js"></script>
</body>


</html>