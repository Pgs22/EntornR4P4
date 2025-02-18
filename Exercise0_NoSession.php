<?php
// Sin sesion
$quantityMilk = 0;
$quantitySoftDrink = 0;

// when user click on a button
//Cuando enviamos el formulario, se comprobará si son de tipo POST la solicitud recibida por el servidor, para asegurarse que los datos no han sido manipulados:
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){ //$_SERVER['REQUEST_METHOD'] : Variable superglobal que contiene metodo POST entre otros, GET, etc.
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];        
        $name = $_POST['name'];
        // to add products        
        if(isset($_POST["add"])){
            // evaluate product
            switch ($product) {
                case 'milk':
                    //Para guardar la cantidad de leche
                    // add quantity to corresponding product
                    $quantityMilk += $quantity;
                    break;
                case 'softDrink':
                    //Para guardar la cantidad refresco
                    // add quantity to corresponding product
                    $quantitySoftDrink += $quantity;
                    break;
                default: // Si no es ninguna de las anteriores, imprimirá el mensaje y saldrá del bucle
                    echo "<br> <p> Error. Producto no encontrado </p>";
                    break;
                }
            //SEGUNDA CONDICIÓN: PENDIENTE DE HACER
            //Si hacemos click en el botón remove, verifica si el índice "remove" existe dentro del array $_POST, si la condicion es verdadera y ejecutará el switch
            // to remove products
            }else if(isset($_POST['remove'])){ 
                $productToRemove = $_POST['product'];
                $quantityToRemove = $_POST['quantity'];
                //check if quantity is not greater than current one
                if ($quantityToRemove > 0) {
                    // evaluate product
                    if ($productToRemove === 'milk') {
                        // substract from quantity to corresponding product
                        $quantityMilk -= $quantityToRemove;
                    } else if ($productToRemove === 'softDrink') {
                        $quantitySoftDrink -= $quantityToRemove;
                    } else {
                        echo "Producto no válido";
                    }
                } else {
                    echo "La cantidad a eliminar debe ser mayor que cero";
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
        <input type="number" name="quantity" id="quantity"><br><br>
        <input type="submit" value="add" name="add">
        <input type="submit" value="remove" name="remove">
        <input type="submit" value="reset">
    </form>
 
   
    <!-- list values worker, milk, softdrink -->
    <h2>Inventory:</h2>
    <!-- Añadimos codigo php para que se aplique condicion (ternaria) a cada nodo parrafo,
     si esta vacio añadir el valor de worker y si no, añade texto vacío-->
    <p>worker: <?php echo isset($name) ? $name  : ''; ?></p>
    <p>units milk: <?php echo isset($quantityMilk) ? $quantityMilk : ''; ?></p>
    <p>units soft drink: <?php echo isset($quantitySoftDrink) ? $quantitySoftDrink : ''; ?></p>


</body>
 
</html>