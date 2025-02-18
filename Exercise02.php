<!DOCTYPE html>
<!-- 
Crea un php con un array inicial con 3 valores numéricos. (2 puntos)
a) Crea un formulario que permita modificar el valor en una posición en concreto.
b) Consigue que se mantenga las modificaciones en el array.
c) Añade un botón para calcular el valor medio.
-->

<?php
// Creamos sesión con el metodo
//session_start();

// Define initial array first time 10,20,30
$numbers = [10, 20, 30]; // Creo un Array sin session
//if(!isset($SESSION['numbers'])){ // Inicializo un array con estos valores en la session
//    $SESSION['numbers'] = array(10, 20, 30);
//}

// to process the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //detect button modify
    if(isset($_POST['modify'])){
        // Obtener los datos del formulario
        $position = $_POST['position'];
        $value = $_POST['value'];
        //Para modificar la posicion seleccionada en el array con session
        //$_SESSION['NUMBERS'][$position] = $value;

        // Modificar el valor en la posición sin sesión
        $numbers[$position - 1] = $value;
    
    }else if(isset($_POST['average'])){
        // Calcular la media
        //$average = array_sum(array: $_SESSION['numbers']);
        $average = array_sum(array: $_numbers);
        $average = number_format(num: $average,decimals: 2);
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise02</title>
</head>
<body>
<form method="post">
    <h2>Position to modify:</h2>
    <select name=position id="position">
        <option value="0">1</option>
        <option value="1">2</option>
        <option value="2">3</option>
    </select>
    <h2>New value:</h2>
    <input type="number" name="value" id="value"><br><br>        
    <input type="submit" value="modify" name="modify">
    <input type="submit" value="average" name="average">
    <input type="submit" value="reset" name="reset">
</form>


<?php
// Mostrar el array actual
echo "Array actual: ";
print_r($numeros);
?>
<!-- Mostrar el valor medio (solo si se ha calculado)-->
<!--<p>Current array: <?php //echo isset($SESSION['softDrink']) ? $SESSION['softDrink'] : ''; ?></p> -->
<p>Average: <?php echo isset($average) ? $average : ''; ?></p>

</body>
</html>