<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo - ECO BEL�0�7N</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header class="admin-header">
    <h1>�9�4 ECO BEL�0�7N - Panel Administrativo</h1>
    <a href="logout.php" class="btn-logout">Cerrar sesi��n</a>
  </header>

  <main class="dashboard">
    <button class="btn-primary" id="openModalBtn">�7�7 Agregar nuevo peri��dico</button>

    <section class="list-section">
      <h2>Peri��dicos subidos</h2>
      <ul class="periodico-list" id="periodico-list">
        <?php
        $sql = "SELECT id, titulo, director, publicado_en FROM periodicos ORDER BY publicado_en DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li data-id='{$row['id']}'>
                        <div class='info'>
                            <strong>{$row['titulo']}</strong>
                            <span>�9�1 {$row['publicado_en']} | Dir: {$row['director']}</span>
                        </div>
                        <div class='actions'>
                            <button class='btn-action edit-btn'>�7�3�1�5 Editar</button>
                            <button class='btn-action delete-btn'>�9�9�1�5 Eliminar</button>
                        </div>
                      </li>";
            }
        } else {
            echo "<p>No hay peri��dicos subidos a��n.</p>";
        }
        ?>
      </ul>
    </section>
  </main>

  <div id="uploadModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2 id="modal-title">Subir nuevo peri��dico</h2>
      <form id="uploadForm" enctype="multipart/form-data">
        <input type="hidden" name="action" id="form-action" value="add">
        <input type="hidden" name="id" id="periodico-id">
        <div class="form-step" data-step="1">
          <label for="titulo">T��tulo del peri��dico</label>
          <input type="text" id="titulo" name="titulo" required>
        </div>
        <div class="form-step" data-step="2">
          <label for="director">Nombre del director</label>
          <input type="text" id="director" name="director" required>
        </div>
        <div class="form-step" data-step="3">
          <label for="participantes">Nombres de los participantes (separados por coma)</label>
          <textarea id="participantes" name="participantes"></textarea>
        </div>
        <div class="form-step" data-step="4">
          <label for="descripcion">Descripci��n (opcional)</label>
          <textarea id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="form-step" data-step="5">
            <label for="fecha">Fecha de publicaci��n</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-step" data-step="6">
          <label for="archivo">Archivo PDF</label>
          <input type="file" id="archivo" name="archivo" accept="application/pdf">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" id="prevBtn" style="display:none;">�� Anterior</button>
          <button type="button" class="btn-primary" id="nextBtn">Siguiente ��</button>
          <button type="submit" class="btn-primary" id="submitBtn" style="display:none;">Finalizar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>