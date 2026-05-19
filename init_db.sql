-- Crear tabla de contactos para Salón de Belleza Pretty
CREATE TABLE IF NOT EXISTS contacts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    telefono TEXT,
    correo TEXT NOT NULL,
    mensaje TEXT,
    created_at TEXT NOT NULL
);

-- Índices para mejorar búsquedas
CREATE INDEX IF NOT EXISTS idx_correo ON contacts(correo);
CREATE INDEX IF NOT EXISTS idx_created_at ON contacts(created_at);
