<?php
// Creamos sesión con el metodo
session_start();

//Configuramos funcion session para inicilizar el contador a 0 si no hay productos
if (!isset($_SESSION['softDrink'])) {
    $_SESSION['softDrink'] = 0;
}
if (!isset($_SESSION['milk'])) {
    $_SESSION['milk'] = 0;
}

//$quantityMilk = 0;
//$quantitySoftDrink = 0;

// when user click on a button
//Cuando enviamos el formulario, se comprobará si son de tipo POST la solicitud recibida por el servidor, para asegurarse que los datos no han sido manipulados:
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //$_SERVER['REQUEST_METHOD'] : Variable superglobal que contiene metodo POST entre otros, GET, etc.
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $_SESSION['name'] = $name = $_POST['name'];

    //Creamos un if para poder ejecutar un bloque de código distinto si se cunple una condición y si no, ejecutar otro bloque...
    //Tenemos 3 botones y añadiremos una condición para cada una.
    //PRIMERA CONDICIÓN:
    //Si hacemos click en el botón add, verifica si el índice "add" existe dentro del array $_POST, si la condicion es verdadera y ejecutará el switch

    // to add products        
    if (isset($_POST["add"])) {
        // evaluate product
        switch ($product) {
            case 'milk':
                //Para guardar la cantidad de leche
                // add quantity to corresponding product
                $_SESSION['milk'] += $quantity;
                break;
            case 'softDrink':
                //Para guardar la cantidad refresco
                // add quantity to corresponding product
                $_SESSION['softDrink'] += $quantity;
                break;
            default: // Si no es ninguna de las anteriores, imprimirá el mensaje y saldrá del bucle
                echo "<br> <p> Error. Producto no encontrado </p>";
                break;
        }
        //SEGUNDA CONDICIÓN: PENDIENTE DE HACER
        //Si hacemos click en el botón remove, verifica si el índice "remove" existe dentro del array $_POST, si la condicion es verdadera y ejecutará el switch
        // to remove products
    } else if (isset($_POST['remove'])) {
        if ($quantity > 0) {
            switch ($product) {
                case 'milk':
                    //check if quantity is not greater than current one
                    if ($_SESSION['milk'] >= $quantity) { // comprobamos que no sea mayor el valor a eliminar que el producto
                        $_SESSION['milk'] -= $quantity; // Restamos cantidad al valor que tenga
                    } else {
                        echo "Error: Supera la cantidad de leche añadida.";
                    }
                    break;
                case 'softDrink':
                    //check if quantity is not greater than current one
                    if ($_SESSION['softDrink'] >= $quantity) { // comprobamos que no sea mayor el valor a eliminar que el producto
                        $_SESSION['softDrink'] -= $quantity; // Restamos cantidad al valor que tenga
                    } else {
                        echo "Error: Supera la cantidad de refrescos añadidos.";
                    }
                    break;
                default:
                    echo "Este producto no existe";
            }
        } else {
            echo "Error. Introduce un numero positivo mayor que 0";
        }
    }
}
?>

<!-- to interact with user -->
<!DOCTYPE html>
<!-- 
Crea un formulario que permita gestionar la cantidad de refresco o leche que hay en un
supermercado. (3 puntos)
a) Se debe mantener el nombre del trabajador que está utilizando la aplicación.
b) Se debe poder añadir y quitar leche o refresco seleccionando de una lista
c) Se debe controlar que no se pueden quitar mas unidades de las que haya, en ese
caso mostrar error.
-->
<html>

<head>
    <title>Supermarket management</title>
</head>

<body>
    <h1>Supermarket management</h1>
    <!-- form with input fields and 3 buttons -->
    <!-- Creamos un formulario para enviar los datos a en este mismo fichero -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="name">Worker name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($POST['name']) ? $POST['name'] : ''; ?>"><br><br>
        <h2>Choose product:</h2>
        <select name=product id="product">
            <option value="milk">Milk</option>
            <option value="softDrink">Soft Drink</option>
        </select>
        <h2>Product quantity:</h2>
        <input type="number" name="quantity" id="quantity" min="1"><br><br>
        <input type="submit" value="add" name="add">
        <input type="submit" value="remove" name="remove">
        <input type="submit" value="reset">
    </form>


    <!-- list values worker, milk, softdrink -->
    <h2>Inventory:</h2>
    <!-- Añadimos codigo php para que se aplique condicion (ternaria) a cada nodo parrafo,
     si esta vacio añadir el valor de worker y si no, añade texto vacío-->
    <p>worker: <?php echo isset($_SESSION['name']) ? $_SESSION['name']  : ''; ?></p>
    <p>units milk: <?php echo isset($_SESSION['milk']) ? $_SESSION['milk'] : ''; ?></p>
    <p>units soft drink: <?php echo isset($_SESSION['softDrink']) ? $_SESSION['softDrink'] : ''; ?></p>


</body>

</html>