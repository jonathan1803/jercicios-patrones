<?php

// Interface común para todos los personajes
interface Character
{
    public function attack(): void;
    public function speed(): float;
}

// Implementación del personaje Esqueleto
class Skeleton implements Character
{
    public function attack(): void
    {
        echo "Esqueleto ataca con flechas.\n";
    }

    public function speed(): float
    {
        return 1.5; // Velocidad del Esqueleto
    }
}

// Implementación del personaje Zombi
class Zombie implements Character
{
    public function attack(): void
    {
        echo "Zombi ataca con mordiscos.\n";
    }

    public function speed(): float
    {
        return 0.8; // Velocidad del Zombi
    }
}

// Factory para crear personajes según el nivel
class CharacterFactory
{
    public static function createCharacter(string $level): Character
    {
        if ($level === 'fácil') {
            return new Skeleton();
        } elseif ($level === 'difícil') {
            return new Zombie();
        } else {
            throw new Exception("Nivel no soportado: $level");
        }
    }
}

// Ejemplo de uso
try {
    $nivel = 'fácil'; // Cambia a 'difícil' para probar con Zombi
    $personaje = CharacterFactory::createCharacter($nivel);
    $personaje->attack();
    echo "Velocidad del personaje: " . $personaje->speed() . " m/s\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

