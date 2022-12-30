<?php

namespace controllers;

use core\Core;
use models\Carad;
use models\Carcomparison;
use models\User;
use models\Userreview;

class UserreviewController extends \core\Controller
{

    public function indexAction()
    {
        if (!User::isUserAdmin())
        {
            return $this->error(404);
        }
        else
        {
            $data["reviews"] = Userreview::getAllUserReviews();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
    }

    public function addAction($params)
    {
        if (User::isUserAdmin())
        {
            return $this->error(404);
        }
        else
        {
            if (!User::isUserAuthenticated())
            {
                $this->redirect("/");
            }
            $id = intval($params[0]);
            if (!User::isUserByIdExist($id))
            {
                $this->redirect("/");
            }
            if (User::getCurrentUserId() == $id)
            {
                $this->redirect("/");
            }
            $data = [];
            $data["user"] = User::getUserById($id);
            if(Core::getInstance()->requestMethod === "POST")
            {
                $errors = [];
                if (empty($_POST["title"]) || strlen($_POST["title"]) <= 5)
                {
                    $errors["title"] = "Занадто короткий заголовок";
                }
                if (empty($_POST["text"]) || strlen($_POST["text"]) <= 10)
                {
                    $errors["text"] = "Занадто короткий текст";
                }
                if(count($errors) > 0)
                {
                    $auto_complete = $_POST;
                    return $this->render(null, [
                        "data" => $data,
                        "auto_complete" => $auto_complete,
                        "errors" => $errors
                    ]);
                }
                else
                {
                    Userreview::addUserReview(trim($_POST["title"]), nl2br($_POST["text"]), $id, User::getCurrentUserId());
                    $_SESSION["success_review_added"] = "Відгук успішно додано";
                    $this->redirect("/userreview/view/{$id}");
                }
            }
            else
            {
                return $this->render(null, [
                    "data" => $data
                ]);
            }
        }
    }

    public function viewAction($params)
    {
        if (!User::isUserAdmin())
        {
            $id = intval($params[0]);
            if (!User::isUserByIdExist($id))
            {
                $this->redirect("/");
            }
            $data = [];
            $data["reviews"] = Userreview::getAllUserReviewsByUserIdInnered($id);
            if (empty($data["reviews"]))
            {
                $data["reviews"]["user"] = User::getUserById($id);
            }
            return $this->render(null, [
                "data" => $data
            ]);
        }
        else
        {
            return $this->error(404);
        }
    }



    public function deleteAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Userreview::isUserReviewByIdExist($id))
        {
            $this->redirect("/");
        }
        $review = Userreview::getUserReviewById($id);
        if (User::getCurrentUserId() == $review["user_id"] && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        if (User::getCurrentUserId() != $review["user_id_from"] && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        Userreview::deleteUserReviewById($id);
        $_SESSION["success_review_deleted"] = "Відгук успішно видалено";
        if (!User::isUserAdmin())
        {
            $this->redirect("/userreview/view/{$review["user_id"]}");
        }
        else
        {
            $this->redirect("/userreview");
        }
    }



}