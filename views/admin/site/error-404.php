<?php

use core\Core;

Core::getInstance()->pageParams['title'] = 'Помилка 404';

?>

<main>
    <div class="content-wrapper">
        <div class="admin-main-error">
            <div class="container">
                <div class="text-center alert alert-danger pb-4 pt-4 mb-5" style="border-radius: 25px" role="alert">
                    <h1 class="h1"><b>Помилка 404</b></h1>
                    <p class="h1">Сторінку не знайдено</p>
                </div>
            </div>
        </div>
    </div>
</main>