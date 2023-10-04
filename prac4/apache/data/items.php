<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

include_once "api/ItemRepository.php";
$itemRepository = new ItemRepository();
$id = (isset($_GET['id'])) ? intval($_GET['id']) : null;

switch ($method):
    case "GET": {
        if (!empty($id)) {
            $itemRepository->getById($id);
        } else {
            $itemRepository->getAll();
        }
        break;
    }
    case "POST": {
        $itemRepository->create();
        break;
    }
    case "PATCH": {
        if (!empty($id)) {
            $itemRepository->update($id);
        }    
        break;
    }
    case "DELETE": {
        if (!empty($id)) {
            $itemRepository->delete($id);
        }
        break;
    }
endswitch;