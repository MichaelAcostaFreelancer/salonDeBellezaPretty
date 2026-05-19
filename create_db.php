<?php
/**
 * Script para crear la base de datos SQLite de contactos
 * Ejecutar una sola vez: php create_db.php
 */

$dbPath = __DIR__ . '/data/contacts.db';

// Crear carpeta data si no existe
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0755, true);
}

try {
    if (class_exists('SQLite3')) {
        $db = new SQLite3($dbPath);
        
        // Crear tabla de contactos
        $db->exec("CREATE TABLE IF NOT EXISTS contacts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            telefono TEXT,
            correo TEXT NOT NULL,
            mensaje TEXT,
            created_at TEXT NOT NULL
        )");
        
        // Crear índices
        $db->exec("CREATE INDEX IF NOT EXISTS idx_correo ON contacts(correo)");
        $db->exec("CREATE INDEX IF NOT EXISTS idx_created_at ON contacts(created_at)");
        
        echo "✓ Base de datos creada correctamente en: " . htmlspecialchars($dbPath) . "\n";
        echo "✓ Tabla 'contacts' creada con éxito.\n";
    } else {
        echo "SQLite3 no está disponible. Se usará almacenamiento JSON.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
