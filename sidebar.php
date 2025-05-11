<?php
// Verifica la connessione al database
require_once 'config.php';

?>
<div class="sidebar">
    <button id="sidebar-toggle" class="sidebar-toggle-btn">
        <i class="fas fa-chevron-up"></i> Nascondi
    </button>
    <div class="sidebar-content">
        <div class="sidebar-section">
        <h3>Database SQL</h3>
        <div class="database-list">
            <?php
            try {
                // Lista dei database MySQL
                $sql = "SHOW DATABASES";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='database-item'>";
                        echo "<i class='fas fa-database'></i> ";
                        echo htmlspecialchars($row['Database']);
                        echo "</div>";
                    }
                }
            } catch (Exception $e) {
                echo "<p class='error'>Errore nella connessione SQL</p>";
            }
            ?>
        </div>
    </div>
    
    <div class="sidebar-section">
        <h3>Estensioni</h3>
        <div class="extension-list">
            <?php
            // Lista delle estensioni PHP installate
            $extensions = get_loaded_extensions();
            foreach($extensions as $extension) {
                echo "<div class='extension-item'>";
                echo "<i class='fas fa-puzzle-piece'></i> ";
                echo htmlspecialchars($extension);
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<style>
.sidebar {
    width: 250px;
    background-color: #f8f9fa;
    border-right: 1px solid #dee2e6;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
    padding: 20px;
}

.sidebar-section {
    margin-bottom: 20px;
}

.sidebar-section h3 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.1em;
}

.database-list, .extension-list {
    font-size: 0.9em;
}

.database-item, .extension-item {
    padding: 8px;
    border-bottom: 1px solid #eee;
    color: #666;
    cursor: pointer;
    transition: background-color 0.2s;
}

.database-item:hover, .extension-item:hover {
    background-color: #e9ecef;
    color: #333;
}

.error {
    color: #dc3545;
    font-size: 0.9em;
    padding: 10px;
}
</style>