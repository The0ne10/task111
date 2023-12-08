<?php

require_once 'classes/Curl.php';

if (isset($_POST['address'])) {
    $curl = new Curl;
    $response = $curl->forward($_POST['address']);
} elseif (isset($_POST['latitude']) && isset($_POST['longtitude'])) {
    $curl = new Curl;
    $response = $curl->reverse([$_POST['latitude'], $_POST['longtitude']]);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="menu">
            <div class="menu__buttons">
                <button class="menu__button <?php if (isset($_POST['latitude'])) { echo ''; } else { echo 'menu__button--active'; } ?>" id="coords-btn">Получить координаты</button>
                <button class="menu__button <?php if (isset($_POST['latitude'])) { echo 'menu__button--active'; } ?>" id="address-btn">Получить адрес</button>
            </div>
            <form class="menu__form" id="coords-form" method="post" action="/" style="display: <?php if (isset($_POST['latitude'])) { echo 'none'; } else { echo 'block'; } ?>">
                <p class="menu__label">Адрес</p>
                <input class="menu__input" name="address" type="text" placeholder="Введите адрес" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>">
                <button class="menu__submit-btn" type="submit">Получить результат</button>
                <?php if (isset($_POST['address'])) { ?>
                    <div class="menu__result">
                        <p style="font-weight: 700">Координаты:</p>
                        <?php
                            foreach ($response as $item) {
                                echo "<p>{$item['lat']} {$item['lon']}</p>";
                            }
                        ?>
                    </div>
                <?php } ?>
            </form>
            <form class="menu__form" id="address-form" method="post" action="/" style="display: <?php if (isset($_POST['latitude'])) { echo 'block'; } ?>">
                <p class="menu__label">Широта</p>
                <input class="menu__input" name="latitude" type="text" placeholder="Введите широту" value="<?php if(isset($_POST['latitude'])) { echo $_POST['latitude']; } ?>">
                <p class="menu__label">Долгота</p>
                <input class="menu__input" name="longtitude" type="text" placeholder="Введите долготу" value="<?php if(isset($_POST['longtitude'])) { echo $_POST['longtitude']; } ?>">
                <button class="menu__submit-btn" type="submit">Получить результат</button>
                <?php if (isset($_POST['latitude']) && isset($_POST['longtitude'])) { ?>
                    <div class="menu__result">
                        <p style="font-weight: 700">Адрес:</p>
                        <?php
                            echo "<p>{$response}</p>";
                        ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>