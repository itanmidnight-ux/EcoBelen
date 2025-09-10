<?php
require_once "../config.php";

// Obtener peri��dicos ordenados por fecha de publicaci��n (m��s reciente primero)
$sql = "SELECT id, titulo, director, publicado_en, archivo_pdf FROM periodicos ORDER BY publicado_en DESC";
$result = $conn->query($sql);
$periodicos_array = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $periodicos_array[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ECO BEL�0�7N - Peri��dicos Escolares</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header class="public-header">
    <h1>�9�4 ECO BEL�0�7N</h1>
    <p class="slogan">"La voz de nuestra comunidad escolar"</p>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="#main-content">Explorar</a>
    </nav>
  </header>

  <main class="public-content" id="main-content">

    <aside class="side-panel periodicos-panel" id="periodicosPanel">
      <button class="toggle-button" id="togglePeriodicosBtn">�7�2</button>
      <h3>�9�2 Ediciones Anteriores</h3>
      <div class="listado">
        <?php
        if (count($periodicos_array) > 0) {
            foreach ($periodicos_array as $row) {
                echo "<div class='list-item'>
                        <a href='view.php?id={$row['id']}' title='Ver {$row['titulo']}'>
                            <strong>{$row['titulo']}</strong>
                            <span>�9�1 {$row['publicado_en']} | Dir: {$row['director']}</span>
                        </a>
                      </div>";
            }
        } else {
            echo "<p>No hay peri��dicos disponibles a��n.</p>";
        }
        ?>
      </div>
    </aside>

    <section class="main-periodico-display">
      <?php
      if (!empty($periodicos_array)) {
          $ultimo = $periodicos_array[0];
          echo "<h2>�7�8 �0�3ltima edici��n</h2>
                <div class='card'>
                  <h3>{$ultimo['titulo']}</h3>
                  <p>�9�1 {$ultimo['publicado_en']} | Dir: {$ultimo['director']}</p>
                  <a href='view.php?id={$ultimo['id']}' class='btn-view'>Ver peri��dico</a>
                </div>";
      } else {
          echo "<p>No hay peri��dicos disponibles a��n.</p>";
      }
      ?>
    </section>

    <aside class="side-panel comments-panel hidden" id="commentsPanel">
        <button class="toggle-button" id="toggleCommentsBtn">�7�4</button>
        <h3>�9�6 Comentarios</h3>
        <p>No hay comentarios en la p��gina principal. Vea un peri��dico para comentar.</p>
    </aside>

  </main>

  <script src="script.js"></script>
</body>
</html>
