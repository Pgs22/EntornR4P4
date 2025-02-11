<?php
// Creamos sesión con el metodo
session_start();

    //Configuramos funcion session para inicilizar el contador a 0 si no hay productos
if(!isset($SESSION['softDrink'])){
    $SESSION['softDrink'] = 0;
}
if(!isset($SESSION['milk'])){
    $SESSION['milk'] = 0;
}

//Cuando enviamos el formulario, se debe enviar a en este mismo fichero
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        //Para guardar en la sesión el nombre del producto seleccionado en el formulario
        $_SESSION["name"] = $name;

            if(isset($_POST["add"])){
            switch ($product) {
                case 'milk':
                    //Para guardar en la sesión el producto
                    //$quantityMilk += $quantity;
                    $SESSION['milk'] += $quantity;
                    break;
                case 'softDrink':
                    //Para guardar en la sesión el producto
                    //$quantitySoftDrink += $quantity;
                    $SESSION['softDrink'] += $quantity;
                    break;
                default:
                    echo "<br> <p> Error. Producto no encontrado </p>";
                    break;
                }
            }else if(isset($_POST['enviarResultado'])){
            $num1 = $_POST['resultado'];
            $num2 = 0;
            $resultado = 0;
        }

    }


// when user click on a button
    // detect button (add or remove)
        // to add products
            // evaluate product
                // add quantity to corresponding product
                // add quantity to corresponding product
               
 
        // to remove products
            // evaluate product
            // check if quantity is not greater than current one
            // substract from quantity to corresponding product
?>
 
<!-- to interact with user -->
<!DOCTYPE html>
<!-- 
Crea un formulario que permita ges􀆟onar la can􀆟dad de refresco o leche que hay en un
supermercado. (3 puntos)
a) Se debe mantener el nombre del trabajador que está u􀆟lizando la aplicación.
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="name">Worker name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($POST['name']) ? $POST['name'] : ''; ?>"><br><br>
        <br>
        <label for="product">Choose product:</label>
        <br>
            <input list="listproduct" id="product" name="product" placeholder="Soft Drink:">
            <datalist id="listproduct">
                <option value="milk">
                <option value="softDrink">
            </datalist>
        <br>
        <label for="quantity">Product quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo isset($_POST['num1']) ? $_POST['num1'] : ''; ?>" required>
        <br>
        <br>
        <button type="submit">add</button>
        <button type="submit">remove</button>
        <button type="submit">reset</button>
    </form>
 

   
    <!-- list values worker, milk, softdrink -->
    <h2>Inventory:</h2>
    <!-- Añadimos codigo php para que se aplique condicion (ternaria) a cada nodo parrafo,
     si esta vacio añadir el valor de worker y si no, añade texto vacío-->
    <p>worker: <?php echo isset($name) ? $name : ''; ?></p>
    <p>units milk: <?php echo isset($quantityMilk) ? $quantityMilk : ''; ?></p>
    <p>units soft drink: <?php echo isset($quantitySoftDrink) ? $quantitySoftDrink : ''; ?></p>

</body>
 
</html>