<?php
// CRECAION DE LA CLASE PRODUCTO
class Product{
    public int $id;
    public string $name;
    public float $price;
    public int $stock;
  
    public function __construct(float $precio=0.0, int $cantidad=0, int $identificador, string $nombre)
    {
      $this->id = $identificador;
      $this->name = $nombre;
      $this->price = $precio;
      $this->stock = $cantidad;
    }

  }
  ?>