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
    <div class="kryptering-form">
        <form action="kryptering.php" method="post">
            <label for="inputField">Skriv en melding:</label>
            <input type="text" id="inputField" name="userInput">
            <button type=submit id=myBtn >Krypter og dekrypter</button>
        </form>
    </div> 
    <div class="output">
        <p>Original String: <span class="output"><?php echo $simple_string; ?></span></p>
        <p>Encrypted String: <span class="output"><?php echo $encryption; ?></span></p>
        <p>Decrypted String: <span class="output"><?php echo $decryption; ?></span></p>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Modal Header</h2>
            </div>
            <div class="modal-body">
                <p id="displayInput"></p>
                
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>

    </div>
        
<?php
// Store a string into the variable which
// need to be Encrypted
$simple_string = $_POST['userInput'];

// Store the cipher method
$ciphering = "AES-128-CTR";

// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';

// Store the encryption key
$encryption_key = "GeeksforGeeks";

// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($simple_string, $ciphering,
			$encryption_key, $options, $encryption_iv);

// Non-NULL Initialization Vector for decryption
$decryption_iv = '1234567891011121';

// Store the decryption key
$decryption_key = "GeeksforGeeks";

// Use openssl_decrypt() function to decrypt the data
$decryption=openssl_decrypt ($encryption, $ciphering, 
		$decryption_key, $options, $decryption_iv);

?>
</body>
</html>