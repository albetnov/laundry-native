<?php
require_once __DIR__ . '/middleware.php';
$title = "Manage Paket";
define('CALLED', true);
require_once __DIR__ . '/controller/paket.php';
require_once __DIR__ . '/header.php';
?>

<?php
$js = <<<'js'
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
js;
require_once __DIR__ . '/footer.php'; ?>