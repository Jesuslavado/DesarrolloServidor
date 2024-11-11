<?php 
$semana=[
["nombre"=>"Lunes","primera"=>"DIW","segunda"=>"DIW","tercera"=> "EIE","cuarta"=>"EIE","quinta"=>"DWEC","sexta"=>"DWEC",],
["nombre"=>"Martes","primera"=>"DIW","segunda"=>"DIW","tercera"=> "EIE","cuarta"=>"EIE","quinta"=>"DWEC","sexta"=>"DWEC",],
["nombre"=>"Miercole","primera"=>"DIW","segunda"=>"DIW","tercera"=> "EIE","cuarta"=>"EIE","quinta"=>"DWEC","sexta"=>"DWEC",],
["nombre"=>"Jueves","primera"=>"DIW","segunda"=>"DIW","tercera"=> "EIE","cuarta"=>"EIE","quinta"=>"DWEC","sexta"=>"DWEC",],
["nombre"=>"Viernes","primera"=>"DIW","segunda"=>"DIW","tercera"=> "EIE","cuarta"=>"EIE","quinta"=>"DWEC","sexta"=>"DWEC",],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
table {
border-collapse: collapse;
width: 100%;
text-align: center;
}
th, td {
border: 1px solid black;
padding: 10px;
}
th {
background-color: #f2f2f2;
}
</style>
<body>
    <table>
        <th>HORA</th>
        <th>Lunes
        </th>
        <td><?php echo $semana["Nombre"]; ?></td>
        <td><?php echo $semana[0]["primera"]; ?></td>
        <td><?php echo $semana[0]["segunda"]; ?></td>
        <td><?php echo $semana[0]["tercera"]; ?></td>
        <td><?php echo $semana[0]["cuarta"]; ?></td>
        <td><?php echo $semana[0]["quinta"]; ?></td>
        <td><?php echo $semana[0]["sexta"]; ?></td>

        <th>Martes</th>
        <td><?php echo $semana["Nombre"]; ?></td>
        <td><?php echo $semana[1]["primera"]; ?></td>
        <td><?php echo $semana[1]["segunda"]; ?></td>
        <td><?php echo $semana[1]["tercera"]; ?></td>
        <td><?php echo $semana[1]["cuarta"]; ?></td>
        <td><?php echo $semana[1]["quinta"]; ?></td>
        <td><?php echo $semana[1]["sexta"]; ?></td>
        <th>Miercoles</th>
        <td><?php echo $semana["Nombre"]; ?></td>
        <td><?php echo $semana[2]["primera"]; ?></td>
        <td><?php echo $semana[2]["segunda"]; ?></td>
        <td><?php echo $semana[2]["tercera"]; ?></td>
        <td><?php echo $semana[2]["cuarta"]; ?></td>
        <td><?php echo $semana[2]["quinta"]; ?></td>
        <td><?php echo $semana[2]["sexta"]; ?></td>

        <th>Jueves</th>
        <td><?php echo $semana["Nombre"]; ?></td>
        <td><?php echo $semana[3]["primera"]; ?></td>
        <td><?php echo $semana[3]["segunda"]; ?></td>
        <td><?php echo $semana[3]["tercera"]; ?></td>
        <td><?php echo $semana[3]["cuarta"]; ?></td>
        <td><?php echo $semana[3]["quinta"]; ?></td>
        <td><?php echo $semana[3]["sexta"]; ?></td>
        <th>Viernes</th>
        <td><?php echo $semana["Nombre"]; ?></td>
        <td><?php echo $semana[4]["primera"]; ?></td>
        <td><?php echo $semana[4]["segunda"]; ?></td>
        <td><?php echo $semana[4]["tercera"]; ?></td>
        <td><?php echo $semana[4]["cuarta"]; ?></td>
        <td><?php echo $semana[4]["quinta"]; ?></td>
        <td><?php echo $semana[4]["sexta"]; ?></td>
    </table>
</body>
</html>