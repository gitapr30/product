<?php
header("content-type: application/json");
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS, PUT, DELETE");
header("access-control-allow-headers: Content-Type");

include 'db.php';

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);
        $products = array();
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        echo json_encode($products);
        break;

    case 'GET':
        if(isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM product WHERE id='$id'";
            $result = $conn->query($sql);
            $product = $result->fetch_assoc();
            echo json_encode($product);
        } else {
            echo json_encode(array("message" => "Product ID not provided"));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = mysqli_real_escape_string($conn, $data['name']);
        $price = mysqli_real_escape_string($conn, $data['price']);
        $stock = mysqli_real_escape_string($conn, $data['stock']);
        $sql = "INSERT INTO product (name, price, stock) VALUES ('$name', '$price', '$stock')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("message" => "Product created successfully"));
        } else {
            echo json_encode(array("message" => "Error: " . mysqli_error($conn)));
        }
        break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            $id = mysqli_real_escape_string($conn, $data['id']);
            $name = mysqli_real_escape_string($conn, $data['name']);
            $price = mysqli_real_escape_string($conn, $data['price']);
            $stock = mysqli_real_escape_string($conn, $data['stock']);
            $sql = "UPDATE product SET name='$name', price='$price', stock='$stock' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("message" => "Product updated successfully"));
            } else {
                echo json_encode(array("message" => "Error: " . mysqli_error($conn)));
            }
            break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);                    

        $id = mysqli_real_escape_string($conn, $data['id']);
        $sql = "DELETE FROM product WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("message" => "Product deleted successfully"));
        } else {
            echo json_encode(array("message" => "Error: " . mysqli_error($conn)));
        }
        break;

    default:
        echo json_encode(array("message" => "Method not allowed"));
        break;
}   


?>