<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

include_once "../entity/category.php";
$category = new Category();
$id = (isset($_GET['id'])) ? intval($_GET['id']) : '';

switch ($method):
    case "GET": {
        if (!empty($id)) {
            $category->getById($id);
        } else {
            $category->getAll();
        }
        break;
    }
    case "POST": {
        $category->create();
        break;
    }
    case "PUT": {
        if (!empty($id)) {
            $category->update($id);
        }
        break;
    }
    case "DELETE": {
        if (!empty($id)) {
            $category->delete($id);
        }
        break;
    }
endswitch;