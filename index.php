<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Coolmath Games Downloader - Download your favorite games from Coolmath Games.">
    <title>Coolmath Games Downloader</title>
    <style>
        body {
            font-family: 'Londrina Outline', monospace;
            background-color: #333; 
            color: #ccc; 
            text-align: center;
            margin: 0;
        }

        #container {
            background-color: #444; 
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0px 0px 10px 0px #000;
                        font-family: 'Londrina Outline', monospace;

        }

        h1 {
            color: #fff; 
                        font-family: 'Londrina Outline', monospace;

        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #555; 
            border-radius: 5px;
            width: 300px;
            font-size: 16px;
            color: #333; 
            background-color: #555; 
                        font-family: 'Londrina Outline', monospace;

        }

        button {
            padding: 10px 20px;
            background-color: #777; 
            color: #ccc;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
                        font-family: 'Londrina Outline', monospace;

        }

        button:hover {
            background-color: #666; 
                        font-family: 'Londrina Outline', monospace;

        }

        #result {
            margin: 20px;
                        font-family: 'Londrina Outline', monospace;

        }

        #loading {
            display: none;
            color: #ff6600; 
                        font-family: 'Londrina Outline', monospace;

        }

        #update-log {
            background-color: #555; 
            padding: 20px;
            border-radius: 5px;
            text-align: left;
            color: #fff; 
                        font-family: 'Londrina Outline', monospace;

        }

        #how-to-download {
            background-color: #555; 
            padding: 20px;
            border-radius: 5px;
            text-align: left;
                        font-family: 'Londrina Outline', monospace;

            color: #fff; 
        }

        #faq {
            background-color: #555; 
            padding: 20px;
            border-radius: 5px;
            text-align: left;
            color: #fff; 
                        font-family: 'Londrina Outline', monospace;

        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Welcome to the Coolmath Games Downloader</h1>
        <p>Enter the name of the game you want to download from Coolmath Games below:</p>
        
        <input type="text" id="game_name" placeholder="Enter the game name" required>
        <button id="display_game">Display Game Path</button>
        <div id="loading">Loading...</div>
        
        <div id="result"></div>
        
                <div id="update-log">
            <h2>Update Log:</h2>
            <p>Now you can download games from Coolmath Games that are in SWF format and have not been ported over to HTML5. Enjoy playing your favorite classic games!</p>
        </div>

        <div id="how-to-download">
            <h2>How to Download</h2>
            <p>Follow these steps to download a game from Coolmath Games:</p>
            <ol>
                <li>Find the game name from the Coolmath Games URL. For example, in the URL <code>https://www.coolmathgames.com/0-run-3</code>, the game name is <em>run-3</em>.</li>
                <li>Enter the game name in the input field above.</li>
                <li>Click the "Display Game Path" button to find the game path.</li>
                <li>Once the game path is displayed, you can access and download game source assets.</li>
            </ol>
        </div>

        <div id="faq">
            <h2>Frequently Asked Questions (FAQ)</h2>
            <p><strong>Q: What is Coolmath Games?</strong></p>
            <p>A: Coolmath Games is a popular website offering educational and fun online games.</p>
            
            <p><strong>Q: Is this website affiliated with Coolmath Games?</strong></p>
            <p>A: No, this website is not affiliated with Coolmath Games. It's a tool to help you find and download games from Coolmath Games.</p>

            <p><strong>Q: Can I download game source assets using this tool?</strong></p>
            <p>A: Yes, once you've found the game path, you can access and download game source assets for your chosen game.</p>

            <p><strong>Q: Is this tool legal to use?</strong></p>
            <p>A: This tool is intended for educational purposes and assumes that you have the necessary rights to download game source assets. Please make sure to respect copyright and licensing agreements when using this tool.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#display_game").click(function() {
                $("#loading").show();
                setTimeout(function() {
                    var gameName = $("#game_name").val();
                    $.post("ajax.php", { action: "display", gameName: gameName }, function(data) {
                        setTimeout(function() {
                            $("#loading").hide();
                            $("#result").html(data);
                        }, 0);
                    });
                }, 0);
            });
        });
    </script>
</body>
</html>
