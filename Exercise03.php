<!DOCTYPE html>

<!-- Para elercicio 3 -->

<!-- 
Crea un código php que permita gestionar una lista de la compra. (5 puntos)
a) Permite asignar un nombre, cantidad y precio a un item. (0,5 puntos)
b) Permite añadir un nuevo item. (1 punto) """PASO1"""
c) Permite editar un item en concreto. (1 punto) """PASO4"""UPDATE
d) Permite borrar un item en concreto. (1 punto)"""PASO3"""INDEX
e) Permite almacenar de cada item su coste total (0,5 puntos) """PASO4"""UPDATE
f) Muestra el coste total de la lista. (1 punto)"""PASO2""" -- COMICS
-->

<?php
session_start();

$name = "";
$quantity = 1;
$price = 0;
$index = -1; // Valor -1 cuando no se ha añadido ningún item
$error = "";
$message = "";
$totalValue = 0;

if (!isset($_SESSION['list'])) {
    $_SESSION['list'] = [];
}

//Configuración del formulario para crear la lista de la compra
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //a) Permite asignar un nombre, cantidad y precio a un item.
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        if (empty($name) || $quantity <= 0 || $price < 0) {
            $error = "Please fill in all fields correctly."; // Imprime error si los campos están vacíos al enviar el formulario
        } else {
            $_SESSION['list'][] = [ // Guardamos en la sesión la lista de la compra en un array al pulsar el botón add
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price
            ];
            $message = "Item added successfully."; //Mensaje confirmando añadido ok
        }
    } elseif (isset($_POST['update'])) { // Si pulsamos el botón actualizar:
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $index = $_POST['index'];

        if (empty($name) || $quantity <= 0 || $price < 0) {
            $error = "Please fill in all fields correctly."; // Imprime error si los campos están vacíos al enviar el formulario
        } else {
            $_SESSION['list'][$index] = [ //Al actualizar la lista, tenemos que acceder a la lista existente del array 
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price
            ];
            $message = "Item updated successfully."; //Mensaje confirmando actualizado ok
        }
    } elseif (isset($_POST['delete'])) { // Si pulsamos el botón eliminar:
        $index = $_POST['index'];
        unset($_SESSION['list'][$index]);
        $_SESSION['list'] = array_values($_SESSION['list']);
        $message = "Item deleted successfully.";
    } elseif (isset($_POST['edit'])) { // Si pulsamos el botón editar:
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $index = $_POST['index'];
    } elseif (isset($_POST['reset'])) { // Si pulsamos el botón de reset:
        $_SESSION['list'] = [];
        $message = "List reset successfully.";
    }elseif (isset($_POST['total'])){ // Si pulsamos el botón calcular total:
        $totalValue = 0;
        foreach($_SESSION['list'] as $item){
            $totalValue += $item['quantity'] * $item['price'];
        }
    }
}
?>

<html>
<head>
    <title>Shopping list</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        input[type=submit] {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Shopping list</h1>
    <form method="post">
        <label for="name">name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
        <br>
        <label for="quantity">quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
        <br>
        <label for="price">price:</label>
        <input type="number" name="price" id="price" value="<?php echo $price; ?>">
        <br>
        <input type="hidden" name="index" value="<?php echo $index; ?>">
        <input type="submit" name="add" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="reset" value="Reset">
    </form>
    <p style="color:red;"><?php echo $error; ?></p> <!-- Para imprimir el mensaje de error en un párrafo antes de la tabla en color rojo  -->
    <p style="color:green;"><?php echo $message; ?></p> <!-- Para imprimir el mensaje de confirmación con éxito en un párrafo antes de la tabla en color verde -->
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>quantity</th>
                <th>price</th>
                <th>cost</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['list'] as $index => $item) { ?> <!-- Código para recorrer el Array de la lista de la compra de la sesión -->
                <tr>
                    <td><?php echo $item['name']; ?></td> <!-- Para imprimir en esta celda el nombre -->
                    <td><?php echo $item['quantity']; ?></td> <!-- Para imprimir en esta celda la cantidad -->
                    <td><?php echo $item['price']; ?></td> <!-- Para imprimir en esta celda el precio -->
                    <td><?php echo $item['quantity'] * $item['price']; ?></td> <!-- Para imprimir en esta celda el resultado de la operación -->
                    <td> <!-- Dentro de esta celda veremos los botones del formulario: -->
                        <form method="post"> <!-- Creamos un segundo formulario para recoger los valores del formulario uno y alamacenar el valor de las variables de forma oculta -->
                            <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                            <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">
                            <input type="hidden" name="price" value="<?php echo $item['price']; ?>">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="submit" name="edit" value="Edit"> <!-- Creamos el botón para editar -->
                            <input type="submit" name="delete" value="Delete"> <!-- Creamos el botón para eliminar-->
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" text-align="right"><strong>Total:</strong></td>
                <td><?php echo $totalValue; ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="total" value="Calculate total">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>