<?php
if (isset($_POST['action'])) {
    if ($_POST['action'] === "display") {
        // Handle displaying the game path
        $gameName = $_POST['gameName'];
        $gameName = str_replace(" ", "-", strtolower($gameName));
        $url = "https://www.coolmathgames.com/0-" . $gameName;
        $response = file_get_contents($url);
        $lines = explode("\n", $response);
        $foundGame = false;
        $u = '';

        for ($i = 0; $i < min(500, count($lines)); $i++) {
            $line = $lines[$i];
            if (strpos($line, '"game":{"u":"') !== false || strpos($line, '"swf_1":{"width":"') !== false) {
                $start_index = strpos($line, '"u":"') + strlen('"u":"');
                $end_index = strpos($line, '"', $start_index);
                $u = substr($line, $start_index, $end_index - $start_index);
                $u = str_replace("\\/", "/", $u);
                $foundGame = true;
                break;
            }
        }

        if ($foundGame) {
            // Construct the full URL and print it
            $fullURL = "https://www.coolmathgames.com/$u";
            echo $fullURL;
        } else {
            $error = "❗ Error: The game path could not be retrieved due to a technical issue.";
            echo $error;
        }
    }
}
?>