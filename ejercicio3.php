<?php

// Interfaz común para todos los personajes
interface Character
{
    public function attack(): void;
}

// Clase base de los personajes
class BaseCharacter implements Character
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function attack(): void
    {
        echo "{$this->name} ataca con las manos.\n";
    }
}

// Clase concreta: Guerrero
class Warrior extends BaseCharacter
{
    public function attack(): void
    {
        echo "{$this->name} ataca con fuerza bruta.\n";
    }
}

// Clase concreta: Mago
class Mage extends BaseCharacter
{
    public function attack(): void
    {
        echo "{$this->name} lanza un hechizo mágico.\n";
    }
}

// Decorador base para armas
abstract class WeaponDecorator implements Character
{
    protected Character $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function attack(): void
    {
        $this->character->attack();
    }
}

// Decorador concreto: Espada
class Sword extends WeaponDecorator
{
    public function attack(): void
    {
        $this->character->attack();
        echo "Con una espada afilada.\n";
    }
}

// Decorador concreto: Arco
class Bow extends WeaponDecorator
{
    public function attack(): void
    {
        $this->character->attack();
        echo "Con un arco de largo alcance.\n";
    }
}

// Ejemplo de uso
$warrior = new Warrior("Guerrero");
$mage = new Mage("Mago");

// Añadir armas
$warriorWithSword = new Sword($warrior);
$mageWithBow = new Bow($mage);

// Ataques
echo "Ataques de los personajes:\n";
$warriorWithSword->attack();
$mageWithBow->attack();
