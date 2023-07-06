<?php
    if (isset($userData)) {
        echo $userData;
        $userData = Illuminate\Support\Js::from($userData);
    }
?>

<!doctype html>
<html lang="vi">
    <body>
        <script>
            let userData = <?php echo  $userData ?? null ?>;
            window.opener.postMessage({userData: userData}, '*');
            window.close();
        </script>
    </body>
</html>
