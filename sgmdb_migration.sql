-- Crea la tabla de contactos para importarla en SGMDB
CREATE TABLE contacts (
  id SERIAL PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  telefono VARCHAR(50),
  correo VARCHAR(255) NOT NULL,
  mensaje TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Ejemplo de inserción para migrar un registro de la base local a SGMDB
-- INSERT INTO contacts (nombre, telefono, correo, mensaje, created_at)
-- VALUES ('Nombre Ejemplo', '809-000-0000', 'cliente@correo.com', 'Mensaje de prueba', '2026-05-20 12:00:00');
