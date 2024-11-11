<?php
// CREAMOS LOS 2 ARRAYS
$Datos_Personales=[
    "nombre",
    "fechaNacimiento",
    "residencia",
    "teledono",
    "correo",
    "repetidor"
];

$Calificaciones=[
    "matematicas",
    "lengua",
    "ingles",
    "tecnologia"
];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!--Estudiante 1-->
    <h1>Datos de Evaluación para Cada Estudiante</h1>
    <h2>Estudíante 1:<?php echo $Datos_Personales[0]=" Alex García"; ?>(Aprobado)  </h2>
    <p>Fecha de Fecha de Nacimiento: <?php echo $Datos_Personales[1]=" 14-03-2005"; ?></p>   
    <p>Lugar de Residencia: <?php echo $Datos_Personales[2]=" Madrid"; ?></p>   
    <p>Teléfono: <?php echo $Datos_Personales[3]=" 698997763"; ?></p>
    <p>Correo Elecpónico: <?php echo $Datos_Personales[4]=" alex.garcia@example.com"; ?></p> 
    <p>Estado de Repetidor: <?php echo $Datos_Personales[5]=" No"; ?></p>
    <h3>Evaluaciones: </h3>
    <h4>Matemáticas: <?php echo $Calificaciones[0]=(6+7+8+6+7)/5; ?> </h4>
    <p>Examen 1: 6 </p>   
    <p>Examen 2: 7 </p> 
    <p>Examen 3: 8 </p>
    <p>Examen 4: 6 </p>  
    <p>Examen 5: 7 </p>
    <h4>Lengua: <?php echo $Calificaciones[1]=(((5+6)/2)*0.4)+(7*0.6); ?> </h4>
    <p>Examen 1: 5 </p>   
    <p>Examen 2: 6 </p> 
    <p>Comentario de Texto: 7</p>
    <h4>Inglés: <?php echo $Calificaciones[2]=(6+7+6+6)/4; ?> </h4>
    <p>Lectura: 6 </p>   
    <p>Compresión auditiva: 7</p> 
    <p>Expresión Oral: 6</p>
    <p>Escritura: 6</p>
    <h4>Tecnología: <?php echo $Calificaciones[3]=(8*0.8)+(6*0.2); ?> </h4>
    <p>Proyecto: 8 </p>   
    <p>Participación: 6 </p> 
    <hr>

   

    <!--Estudiante 2-->
    <h1>Datos de Evaluación para Cada Estudiante</h1>
    <h2>Estudíante 2:<?php echo $Datos_Personales[0]=" María Lopez"; ?>  (Aprobado)</h2>
    <p>Fecha de Fecha de Nacimiento: <?php echo $Datos_Personales[1]=" 20-05-2005"; ?></p>   
    <p>Lugar de Residencia: <?php echo $Datos_Personales[2]=" Barcelona"; ?></p>   
    <p>Teléfono: <?php echo $Datos_Personales[3]=" 612321147"; ?></p>
    <p>Correo Elecpónico: <?php echo $Datos_Personales[4]=" : maria.lopez@example.com"; ?></p> 
    <p>Estado de Repetidor: <?php echo $Datos_Personales[5]=" Sí"; ?></p>
    <h3>Evaluaciones: </h3>
    <h4>Matemáticas: <?php echo $Calificaciones[0]=(5+6+7+6+6)/5; ?> </h4>
    <p>Examen 1: 5 </p>   
    <p>Examen 2: 6 </p> 
    <p>Examen 3: 7 </p>
    <p>Examen 4: 6 </p>  
    <p>Examen 5: 6 </p>
    <h4>Lengua: <?php echo $Calificaciones[1]=(((5+6)/2)*0.4)+(7*0.6); ?> </h4>
    <p>Examen 1: 6 </p>   
    <p>Examen 2: 6 </p> 
    <p>Comentario de Texto: 7</p>
    <h4>Inglés: <?php echo $Calificaciones[2]=(6+6+5+6)/4; ?> </h4>
    <p>Lectura: 6 </p>   
    <p>Compresión auditiva: 6</p> 
    <p>Expresión Oral: 5</p>
    <p>Escritura: 6</p>
    <h4>Tecnología: <?php echo $Calificaciones[3]=(6*0.8)+(7*0.2); ?> </h4>
    <p>Proyecto: 6 </p>   
    <p>Participación: 7 </p> 
    <hr>

    <!--Estudiante 3-->
    <h1>Datos de Evaluación para Cada Estudiante</h1>
    <h2>Estudíante 3:<?php echo $Datos_Personales[0]=" Juan Pérez"; ?>  (Aprobado)</h2>
    <p>Fecha de Fecha de Nacimiento: <?php echo $Datos_Personales[1]=" 08-11-2004"; ?></p>   
    <p>Lugar de Residencia: <?php echo $Datos_Personales[2]=" Sevilla"; ?></p>   
    <p>Teléfono: <?php echo $Datos_Personales[3]=" 677998844"; ?></p>
    <p>Correo Elecpónico: <?php echo $Datos_Personales[4]=" : juan.perez@example.com"; ?></p> 
    <p>Estado de Repetidor: <?php echo $Datos_Personales[5]=" No"; ?></p>
    <h3>Evaluaciones: </h3>
    <h4>Matemáticas: <?php echo $Calificaciones[0]=(7+6+8+7+7)/5; ?> </h4>
    <p>Examen 1: 7 </p>   
    <p>Examen 2: 6 </p> 
    <p>Examen 3: 8 </p>
    <p>Examen 4: 7 </p>  
    <p>Examen 5: 7 </p>
    <h4>Lengua: <?php echo $Calificaciones[1]=(((6+7)/2)*0.4)+(6*0.6); ?> </h4>
    <p>Examen 1: 6 </p>   
    <p>Examen 2: 7 </p> 
    <p>Comentario de Texto: 6</p>
    <h4>Inglés: <?php echo $Calificaciones[2]=(6+7+6+7)/4; ?> </h4>
    <p>Lectura: 7 </p>   
    <p>Compresión auditiva: 6</p> 
    <p>Expresión Oral: 7 </p>
    <p>Escritura: 6</p>
    <h4>Tecnología: <?php echo $Calificaciones[3]=(8*0.8)+(6*0.2); ?> </h4>
    <p>Proyecto: 8 </p>   
    <p>Participación: 6 </p> 
    <hr>

    <!--Estudiante 4-->
    <h1>Datos de Evaluación para Cada Estudiante</h1>
    <h2>Estudíante 4:<?php echo $Datos_Personales[0]=" Lucía Sánchez"; ?>  (Suspenso)</h2>
    <p>Fecha de Fecha de Nacimiento: <?php echo $Datos_Personales[1]=" 22-09-2005"; ?></p>   
    <p>Lugar de Residencia: <?php echo $Datos_Personales[2]=" Valencia"; ?></p>   
    <p>Teléfono: <?php echo $Datos_Personales[3]=" 66488977"; ?></p>
    <p>Correo Elecpónico: <?php echo $Datos_Personales[4]=" lucia.sanchez@example.com"; ?></p> 
    <p>Estado de Repetidor: <?php echo $Datos_Personales[5]=" Si"; ?></p>
    <h3>Evaluaciones: </h3>
    <h4>Matemáticas: <?php echo $Calificaciones[0]=(5+5+5+4+4)/5; ?> </h4>
    <p>Examen 1: 5 </p>   
    <p>Examen 2: 4 </p> 
    <p>Examen 3: 5 </p>
    <p>Examen 4: 4 </p>  
    <p>Examen 5: 5 </p>
    <h4>Lengua: <?php echo $Calificaciones[1]=(((4+4)/2)*0.4)+(5*0.6); ?> </h4>
    <p>Examen 1: 4 </p>   
    <p>Examen 2: 4 </p> 
    <p>Comentario de Texto: 5</p>
    <h4>Inglés: <?php echo $Calificaciones[2]=(5+4+4+4)/4; ?> </h4>
    <p>Lectura: 5 </p>   
    <p>Compresión auditiva: 4</p> 
    <p>Expresión Oral: 4</p>
    <p>Escritura: 4</p>
    <h4>Tecnología: <?php echo $Calificaciones[3]=(4*0.8)+(5*0.2); ?> </h4>
    <p>Proyecto: 4</p>   
    <p>Participación: 5 </p> 
    <hr>




 



</body>
</html>