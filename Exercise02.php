<!-- 
Crea un php con un array inicial con 3 valores numéricos. (2 puntos)
a) Crea un formulario que permita modificar el valor en una posición en concreto.
b) Consigue que se mantenga las modificaciones en el array.
c) Añade un botón para calcular el valor medio.
-->
<?php
// Creamos sesión con el metodo
session_start();
// Para iniciar el array si no existe en la sesión
if (!isset($_SESSION['numbers'])) {
    $_SESSION['numbers'] = [10, 20, 30];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Detectar si está inicializada el array
    if(isset($_POST['modify'])) {
        // Obtener los datos del formulario
        $position = $_POST['position'];
        $value = $_POST['value'];
        
        //Para modificar la posicion seleccionada en el array con session
        $_SESSION['numbers'][$position] = $value;

        // Modificar el valor en la posición sin sesión
    }else if(isset($_POST['average'])){
        // Calcular la media
        //La funcion array_sum, suma todos los valores, que usaremos como dividendo
        //Usamos count para poder contar el número de posiciones del Array y obtener el divisor para hacer la division
        //$average = array_sum($_SESSION['numbers']) / count($_SESSION['numbers']);
        //si lo queremos solo con 2 decimales usamos la funcion round para redondear con 2 digitos
        $average = round(array_sum($_SESSION['numbers']) / count($_SESSION['numbers']), 2);

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise02</title>
</head>
<body>
    <!-- Creamos un formulario, seleccionamos una opción del listado y escribimos el valor a modificar -->
<form method="post">
    <h2>Position to modify:</h2>
    <select name=position id="position">
        <option value="0">1</option>
        <option value="1">2</option>
        <option value="2">3</option>
    </select>
    <!-- Añadimos el tipo number para escribir el valor, y los botones modificar, media y reset -->
    <h2>New value:</h2>
    <input type="number" name="value" id="value"><br><br>        
    <input type="submit" value="modify" name="modify">
    <input type="submit" value="average" name="average">
    <input type="submit" value="reset" name="reset">
</form>


<?php
// Mostrar el array actual, solo los valores separados por una coma y sin imprimir las posiciones
echo "Current Array: ";
if (isset($_SESSION['numbers'])) {
    echo implode(", ", $_SESSION['numbers']);
}
?>
<!-- Mostrar el valor medio si se ha calculado la media -->
<p>Average: <?php echo isset($average) ? $average : ''; ?></p>
</body>
</html>