// test.js

// Function to handle encryption and decryption
async function runEncryptionDecryption() {
    const taskInput = document.getElementById('task').value;
    const messageInput = document.getElementById('message').value;
    const keyInput = document.getElementById('key').value;

    let result = '';

    if (taskInput.toLowerCase() === 'encrypt') {
        result = await encryptMessage(messageInput, keyInput);
    } else if (taskInput.toLowerCase() === 'decrypt') {
        result = await decryptMessage(messageInput, keyInput);
    } else {
        result = 'Invalid task. Please enter "encrypt" or "decrypt".';
    }

    // Display the result on the webpage
    document.getElementById('result').innerText = result;
}

// Function to encrypt a message
async function encryptMessage(message, key) {
    const encoder = new TextEncoder();
    const encodedMessage = encoder.encode(message);

    const encodedKey = encoder.encode(key);
    const cryptoKey = await window.crypto.subtle.importKey(
        'raw',
        encodedKey,
        { name: 'AES-GCM' },
        false,
        ['encrypt']
    );

    const encryptedBuffer = await window.crypto.subtle.encrypt(
        { name: 'AES-GCM', iv: crypto.getRandomValues(new Uint8Array(12)) },
        cryptoKey,
        encodedMessage
    );

    const encryptedMessage = Array.from(new Uint8Array(encryptedBuffer))
        .map(byte => String.fromCharCode(byte))
        .join('');

    return btoa(encryptedMessage);
}

// Function to decrypt a message
async function decryptMessage(encryptedMessage, key) {
    const decoder = new TextDecoder();
    const encodedMessage = new Uint8Array(atob(encryptedMessage)
        .split('')
        .map(char => char.charCodeAt(0))
    );

    const encodedKey = new TextEncoder().encode(key);
    const cryptoKey = await window.crypto.subtle.importKey(
        'raw',
        encodedKey,
        { name: 'AES-GCM' },
        false,
        ['decrypt']
    );

    const decryptedBuffer = await window.crypto.subtle.decrypt(
        { name: 'AES-GCM', iv: new Uint8Array(12) },
        cryptoKey,
        encodedMessage
    );

    return decoder.decode(decryptedBuffer);
}
