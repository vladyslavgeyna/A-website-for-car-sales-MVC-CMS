<?php

use core\Core;

Core::getInstance()->pageParams['title'] = 'Помилка 403';

?>
<main class="main main-error main-error-403">
    <div class="container">
        <div class="text-center alert alert-danger pb-4 pt-4 mb-5" role="alert">
            <h1 class="h1"><b>Помилка 403</b></h1>
            <p class="h1">Доступ заборонено</p>
        </div>
        <div class="text-center mt-5">
            <div class="image-wrapper">
                <img src="/themes/images/error_robot.svg" alt="Робот">
            </div>
        </div>
    </div>
</main>