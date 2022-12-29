<?php
/** @var array $data */
use core\Core;
use models\Favoritead;
use models\User;

Core::getInstance()->pageParams['title'] = 'Профіль';

?>

<main  class="main main-user-profile">
    <div class="container container-user-profile">
        <div class="title-block mb-4 pb-2">
            <h1 class="m-0">Ваш профіль</h1>
            <div class="user-data-wrapper p-2 mt-4 flex-column flex-lg-row align-items-lg-center d-flex  gap-2 gap-lg-5 me-lg-5">
                <div class="user-data-wrapper-content d-flex flex-column flex-md-row gap-3">
                    <div style="width: 150px; margin: 0 auto" class="user-data-image-wrapper">
                        <?php if (User::hasUserByIdImage($data["user"]["id"])): ?>
                            <img class="w-100" style="border-radius: 50%"  src="<?=User::getUserByIdImagePath($data["user"]["id"])?>" alt="Аватар продавця">
                        <?php else: ?>
                            <img class="w-100" src="/themes/images/default_avatar.svg" alt="Аватар продавця">
                        <?php endif; ?>
                    </div>
                    <div class="user-data">
                        <table class="table mb-1 w-100">
                            <tbody >
                            <tr>
                                <th scope="row">Ім'я:</th>
                                <td class="ps-md-5 ps-0"><?=$data["user"]["name"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Прізвище:</th>
                                <td class="ps-md-5 ps-0"><?=$data["user"]["surname"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">По-батькові:</th>
                                <td class="ps-md-5 ps-0"><?=$data["user"]["lastname"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Логін:</th>
                                <td class="ps-md-5 ps-0"><?=$data["user"]["login"]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Телефон:</th>
                                <td class="ps-md-5 ps-0"><?=$data["user"]["phone"]?></td>
                            </tr>
                            <tr >
                                <td colspan="2" class="p-0 pt-3" >
                                    <a style="border-radius: 25px" href="/user/edit" class="link-edit-profile btn btn-success w-100"><i class="fa-solid fa-pen-to-square pe-2 py-1"></i>Редагувати профіль</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="user-data-links d-flex flex-column gap-2 ms-xl-5 mt-lg-0 mt-4">
                    <a href="/carad/myads" class="btn primary-color-bg primary-color-hover px-4 "><i class="fa-solid fa-pager pe-2 "></i>Мої оголошення</a>
                    <a href="/favoritead" class="btn primary-color-bg primary-color-hover px-4 "><i class="fa-solid fa-heart pe-2 "></i>Моє обране</a>
                    <a href="/carcomparison" class="btn primary-color-bg primary-color-hover px-4"><i class="fa-solid fa-scale-balanced pe-2 "></i>Мої порівняння</a>
                    <a href="/userreview/view/<?=$data["user"]["id"]?>" class="btn primary-color-bg primary-color-hover px-4"><i class="fa-regular fa-comments pe-2"></i>Відгуки про мене</a>
                </div>
            </div>
        </div>
    </div>
</main>