<?php

// Interfaz común para archivos
interface File
{
    public function open(): void;
}

// Implementación de archivos en Windows 7
class Windows7File
{
    public function openInWindows7(): void
    {
        echo "Abriendo archivo en formato Windows 7.\n";
    }
}

// Adaptador para hacer compatible Windows7File con la interfaz File
class Windows7FileAdapter implements File
{
    private Windows7File $windows7File;

    public function __construct(Windows7File $windows7File)
    {
        $this->windows7File = $windows7File;
    }

    public function open(): void
    {
        // Usa la lógica de Windows7File pero a través de la interfaz File
        $this->windows7File->openInWindows7();
    }
}

// Implementación de Windows 10 que acepta archivos usando la interfaz File
class Windows10
{
    public function openFile(File $file): void
    {
        echo "Windows 10: ";
        $file->open();
    }
}

// Ejemplo de uso
$archivoWindows7 = new Windows7File();
$adaptador = new Windows7FileAdapter($archivoWindows7);

$windows10 = new Windows10();
$windows10->openFile($adaptador);
