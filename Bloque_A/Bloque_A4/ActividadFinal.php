<?php 
// Crear una clase Vehicle
class Vehicle {
    public string $make;
    public string $model;
    public string $licensePlate;
    public bool $available;

    public function __construct(string $marca, string $modelo, string $matricula, bool $disponible) {
        $this->make = $marca;
        $this->model = $modelo;
        $this->licensePlate = $matricula;
        $this->available = $disponible;
    }

    public function getDetails() {
        return "Marca: {$this->make}, Modelo: {$this->model}, Matrícula: {$this->licensePlate}, Disponible: " . ($this->available ? 'Yes' : 'No');
    }

    public function isAvailable() {
        return $this->available;
    }
}

// Crear una clase Fleet
class Fleet {
    public string $name;
    public array $vehicles;

    public function __construct(string $nombre, array $vehiculos = []) {
        $this->name = $nombre;
        $this->vehicles = $vehiculos;
    }

    public function addVehicle(Vehicle $vehicle) {
        $this->vehicles[] = $vehicle;
    }

    public function listVehicles() {
        return $this->vehicles;
    }

    public function listAvailableVehicles() {
        $availableVehicles = array_filter($this->vehicles, function($vehicle) {
            return $vehicle->isAvailable();
        });
        return $availableVehicles;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad Final</title>
</head>
<link rel="stylesheet" href="./Recursos/css/estilo.css">

<body>
    <?php 
        // Crear vehículos
        $fleet = new Fleet('Fleet 1');
        $vehicle1 = new Vehicle('Mercedes', 'C-Class', 'ABC123', true);
        $vehicle2 = new Vehicle('BMW', 'X5', 'DEF456', false);
        $vehicle3 = new Vehicle('Audi', 'A4', 'GHI789', true);
        
        // Agregar vehículos
        $fleet->addVehicle($vehicle1);
        $fleet->addVehicle($vehicle2);
        $fleet->addVehicle($vehicle3);

        // Comprobar la disponibilidad de un vehículo específico
        $isVehicle1Available = $vehicle1->isAvailable();
    ?>

    <h2><?= htmlspecialchars($fleet->name) ?></h2>
    <p>Todos los Vehiculos:</p>
    <ul>
        <?php foreach ($fleet->listVehicles() as $vehicle): ?>
            <li><?= htmlspecialchars($vehicle->getDetails()) ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Vehiculos disponibles:</p>
    <ul>
        <?php foreach ($fleet->listAvailableVehicles() as $vehicle): ?>
            <li><?= htmlspecialchars($vehicle->getDetails()) ?></li>
        <?php endforeach; ?>
    </ul>

    <p>
        
¿Está disponible el primer vehículo?:  
        <?= $isVehicle1Available ? 'Yes' : 'No'; ?>
    </p>
</body>
</html>
