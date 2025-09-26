<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;      // <-- Importante
use Spatie\Backup\Tasks\Restore\RestoreJobFactory;
use Ifsnop\Mysqldump as IMysqldump;        // <-- Librería de respaldo en PHP
use Exception;
use ZipArchive;                          // <-- Clase para crear Zips

class AdminController extends Controller
{
    /**
     * Dashboard principal del administrador
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Gestión de usuarios
     */
    public function usuarios()
    {
        return view('admin.usuarios');
    }

    /**
     * Reportes
     */
    public function reportes()
    {
        return view('admin.reportes');
    }

    /**
     * Medicamentos
     */
    public function medicamentos()
    {
        return view('admin.medicamentos');
    }

    public function backup()
    {
        // Este método no cambia
        $diskName = config('backup.backup.destination.disks')[0];
        $disk = Storage::disk($diskName);
        $appName = config('backup.backup.name');
        $files = $disk->files($appName);
        $backups = [];
        foreach ($files as $file) {
            if (str_contains($file, $appName . '/') && str_ends_with($file, '.zip')) {
                $backups[] = [
                    'file_path'     => $file,
                    'file_name'     => basename($file),
                    'file_size'     => $this->formatBytes($disk->size($file)),
                    'last_modified' => date('Y-m-d H:i:s', $disk->lastModified($file)),
                ];
            }
        }
        $backups = array_reverse($backups);
        return view('admin.backup.index', compact('backups'));
    }

    /**
     * Crea un nuevo respaldo de la base de datos usando una librería de PHP pura.
     */
    public function createBackup()
    {
        try {
            Artisan::call('backup:run', ['--only-db' => true]);
            
            return redirect()->back()->with('success', '¡Respaldo de la base de datos creado exitosamente!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el respaldo: ' . $e->getMessage());
        }
    }

    /**
     * Restaura la base de datos llamando a la lógica del paquete directamente.
     */
    public function restoreBackup(Request $request)
    {
        $request->validate(['backup_file' => 'required|string']);

        try {
            $diskName = config('backup.backup.destination.disks')[0];
            $disk = Storage::disk($diskName);
            $appName = config('backup.backup.name');
            $fileName = $request->input('backup_file');
            $filePath = storage_path("app/private/{$appName}/{$fileName}");

            // Abrir el ZIP
            $zip = new \ZipArchive;
            if ($zip->open($filePath) === TRUE) {
                $extractPath = storage_path('app/temp_restore');
                if (!is_dir($extractPath)) {
                    mkdir($extractPath, 0755, true);
                }
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                throw new \Exception("No se pudo abrir el archivo ZIP.");
            }

            // Buscar el .sql dentro de db-dumps
            $sqlFile = glob($extractPath . '/db-dumps/*.sql')[0] ?? null;
            if (!$sqlFile) {
                throw new \Exception("No se encontró el archivo SQL dentro del respaldo.");
            }

            // Configuración de la base de datos
            $dbConfig = config('database.connections.mysql');

            // Ruta exacta a mysql.exe
            $mysqlPath = 'C:\\laragon\\bin\\mysql\\mysql-8.4.3-winx64\\bin\\mysql.exe';

            // Construcción del comando
            $command = sprintf(
                '"%s" --user=%s %s --host=%s %s < "%s"',
                $mysqlPath,
                $dbConfig['username'],
                $dbConfig['password'] ? '--password='.$dbConfig['password'] : '',
                $dbConfig['host'],
                $dbConfig['database'],
                $sqlFile
            );

            // Ejecutar
            exec($command, $output, $resultCode);

            if ($resultCode !== 0) {
                throw new \Exception("Error al ejecutar la restauración. Código: {$resultCode}. Salida: " . implode("\n", $output));
            }

            return redirect()->back()->with('success', '¡Restauración completada exitosamente!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error durante la restauración: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un archivo de respaldo.
     */
    public function deleteBackup(Request $request)
    {
        // Este método no cambia
        $request->validate(['backup_file' => 'required|string']);
        $fileName = $request->input('backup_file');
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $appName = config('backup.backup.name');
        $filePath = $appName . '/' . basename($fileName);

        if ($disk->exists($filePath)) {
            $disk->delete($filePath);
            return redirect()->back()->with('success', 'Respaldo eliminado correctamente.');
        }
        return redirect()->back()->with('error', 'El archivo de respaldo no existe.');
    }


    /**
     * Helper para formatear el tamaño de los archivos.
     */
    private function formatBytes($bytes, $precision = 2) { 
        $units = ['B', 'KB', 'MB', 'GB', 'TB']; 
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        $bytes /= (1 << (10 * $pow)); 
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }
}