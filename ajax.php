<?php
if (isset($_POST['action'])) {
    if ($_POST['action'] === "display") {
        $gameName = $_POST['gameName'];
        $gameName = str_replace(" ", "-", strtolower($gameName));
        $url = "https://www.coolmathgames.com/0-" . $gameName;

        $response = file_get_contents($url);
        $lines = explode("\n", $response);
        $foundGame = false;
        $gamePath = '';

        for ($i = 0; $i < min(500, count($lines)); $i++) {
            $line = $lines[$i];
            if (strpos($line, '"game":{"u":"') !== false || strpos($line, '"swf_1":{"width":"') !== false) {
                $start_index = strpos($line, '"u":"') + strlen('"u":"');
                $end_index = strpos($line, '"', $start_index);
                $gamePath = substr($line, $start_index, $end_index - $start_index);
                $gamePath = str_replace("\\/", "/", $gamePath);
                $foundGame = true;
                break;
            }
        }

        if ($foundGame) {
            $fullURL = "https://www.coolmathgames.com/$gamePath";
            $headers = get_headers($fullURL, 1);
            $lastModifiedDate = isset($headers['Last-Modified']) ? $headers['Last-Modified'] : 'Not available';
            $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 'Not available';

            function humanReadableFilesize($size) {
                if ($size < 1024) {
                    return $size . ' bytes';
                } elseif ($size < 1048576) {
                    return round($size / 1024, 2) . ' KB';
                } elseif ($size < 1073741824) {
                    return round($size / 1048576, 2) . ' MB';
                } elseif ($size < 1099511627776) {
                    return round($size / 1073741824, 2) . ' GB';
                } else {
                    return round($size / 1099511627776, 2) . ' TB';
                }
            }

            function timeAgo($datetime, $full = false) {
                $now = new DateTime();
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);

                $parts = [];
                if ($diff->y) {
                    $parts[] = $diff->y . ' year' . ($diff->y > 1 ? 's' : '');
                }
                if ($diff->m) {
                    $parts[] = $diff->m . ' month' . ($diff->m > 1 ? 's' : '');
                }
                if ($diff->d) {
                    $parts[] = $diff->d . ' day' . ($diff->d > 1 ? 's' : '');
                }
                if ($diff->h) {
                    $parts[] = $diff->h . ' hour' . ($diff->h > 1 ? 's' : '');
                }
                if ($diff->i) {
                    $parts[] = $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
                }
                if ($diff->s) {
                    $parts[] = $diff->s . ' second' . ($diff->s > 1 ? 's' : '');
                }

                return $parts ? implode(', ', $parts) . ' ago' : 'just now';
            }

            $fileSizeReadable = humanReadableFilesize($fileSize);
            $lastModifiedHumanReadable = timeAgo($lastModifiedDate);

            echo "Game URL: $fullURL<br>";
            echo "Last Modified Date: $lastModifiedDate ($lastModifiedHumanReadable)<br>";
            echo "File Size: $fileSizeReadable<br>";
        } else {
            $error = "❗ Error: The game path could not be retrieved due to a technical issue.";
            echo $error;
        }
    }
}
?>
