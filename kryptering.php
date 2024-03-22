<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
        // Hent input fra skjemaet
        $simple_string = $_POST['userInput'];
        $key = $_POST['key'];

        // Sjekk om brukeren valgte å kryptere eller dekryptere
        $action = $_POST['action'];

        if ($action == 'encrypt') {
            // Krypter data
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption = openssl_encrypt($simple_string, $ciphering, $key, $options, $encryption_iv);
            $decryption = ''; // Sett dekryptert streng til tom for krypteringsmodus
        } elseif ($action == 'decrypt') {
            // Dekrypter data
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $decryption_iv = '1234567891011121';
            $decryption = openssl_decrypt($simple_string, $ciphering, $key, $options, $decryption_iv);
            $encryption = ''; // Sett kryptert streng til tom for dekrypteringsmodus
        }

?>

    <div class="kryptering-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="kryp">Velg handling:</label>
            <select id="kryp" name="action">
                <option value="encrypt">Krypter</option>
                <option value="decrypt">Dekrypter</option>
            </select>
            <label for="inputField">Skriv en melding:</label>
            <input type="text" id="inputField" name="userInput">
            <label for="key">Key:</label>
            <input type="text" id="key" name="key">
            <button type="submit" id="myBtn">Utfør handling</button>
        </form>
    </div>
    <div class="output">
        <h2>Resultat</h2>
        <div>
            <p class="resultat"><span><?php print_r("Original String: " . $simple_string . "<br>"); ?></span></p>
        </div>
        <div>
            <p class="resultat"><span><?php print_r("Encrypted String: " . $encryption . "<br>"); ?></span></p>
        </div>
        <div>
            <p class="resultat"><span><?php print_r("Decrypted String: " . $decryption); ?></span></p>
        </div>    
    </div>
</body>
</html>