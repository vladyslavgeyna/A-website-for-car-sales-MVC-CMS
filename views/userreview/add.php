<?php

/** @var array $errors */
/** @var array $data */
/** @var array $auto_complete */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Залишення відгуку про продавця: '. $data["user"]["surname"]." ".$data["user"]["name"]." ".$data["user"]["lastname"];

?>
<main class="main main-userreview-add">
    <div class="container container-userreview-add">
        <h1 class="mb-3">Відгук про продавця:<br><?=$data["user"]["surname"]." ".$data["user"]["name"]." ".$data["user"]["lastname"]?></h1>
        <form action="" method="post" >
            <div class="mb-3">
                <label for="inputTitle" class="form-label">Заголовок відгуку:</label>
                <input required value="<?=$auto_complete['title']?>" name="title" type="text" class="form-control" id="inputTitle" >
                <?php if (!empty($errors['title'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно заголовок відгуку"><?= $errors['title']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="FormControlTextareaText" class="form-label">Текст відгуку:</label>
                <textarea required name="text" class="form-control" id="FormControlTextareaText" style="height: 100px; resize: none;"><?=$auto_complete['text']?></textarea>
                <?php if (!empty($errors['text'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно текст відгуку"><?= $errors['text']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <button id="btn-add-ad" class="btn primary-color-bg primary-color-hover" type="submit">Залишити відгук</button>
        </form>
    </div>
</main>

