<?php

// Interfaz para las estrategias de salida
interface MessageStrategy
{
    public function output(string $message): void;
}

// Estrategia de salida por consola
class ConsoleOutput implements MessageStrategy
{
    public function output(string $message): void
    {
        echo "Consola: " . $message . "\n";
    }
}

// Estrategia de salida en formato JSON
class JsonOutput implements MessageStrategy
{
    public function output(string $message): void
    {
        echo json_encode(['message' => $message], JSON_PRETTY_PRINT) . "\n";
    }
}

// Estrategia de salida en archivo TXT
class TxtFileOutput implements MessageStrategy
{
    private string $filePath;

    public function __construct(string $filePath = "output.txt")
    {
        $this->filePath = $filePath;
    }

    public function output(string $message): void
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
        echo "Mensaje guardado en archivo TXT: {$this->filePath}\n";
    }
}

// Contexto que utiliza las estrategias
class MessageContext
{
    private MessageStrategy $strategy;

    public function setStrategy(MessageStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function display(string $message): void
    {
        $this->strategy->output($message);
    }
}

// Ejemplo de uso
$message = "Hola, este es un mensaje.";

// Configurar y usar diferentes estrategias
$context = new MessageContext();

echo "Salida por consola:\n";
$context->setStrategy(new ConsoleOutput());
$context->display($message);

echo "\nSalida en JSON:\n";
$context->setStrategy(new JsonOutput());
$context->display($message);

echo "\nSalida en archivo TXT:\n";
$context->setStrategy(new TxtFileOutput());
$context->display($message);
