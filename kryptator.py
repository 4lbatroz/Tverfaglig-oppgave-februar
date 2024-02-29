from cryptography.fernet import Fernet
from flask import Flask, render_template, request, jsonify

app = Flask(__name__)

# Generer en unik nøkkel for Fernet-kryptering
def generate_key():
    return Fernet.generate_key()

# Krypter en melding med Fernet
def encrypt_message(message, key):
    fernet = Fernet(key)
    encrypted_message = fernet.encrypt(message.encode())
    return encrypted_message

# Dekrypter en melding med Fernet
def decrypt_message(encrypted_message, key):
    fernet = Fernet(key)
    decrypted_message = fernet.decrypt(encrypted_message).decode()
    return decrypted_message

# Hovedside
@app.route('/')
def home():
    return render_template('index.html')

# Krypterings- og dekrypteringsendepunkt
@app.route('/encrypt_decrypt', methods=['POST'])
def encrypt_decrypt():
    task = request.form['task']
    result = {}

    if task == 'enc':
        key = generate_key()
        message = request.form['message']
        encrypted_message = encrypt_message(message, key)
        result['result'] = f'Encrypted message: {encrypted_message}'

    elif task == 'dec':
        encrypted_message = request.form['message']
        key = request.form['key']
        try:
            decrypted_message = decrypt_message(encrypted_message.encode(), key)
            result['result'] = f'Decrypted message: {decrypted_message}'
        except Exception as e:
            result['error'] = f'Decryption failed: {str(e)}'

    return jsonify(result)

if __name__ == '__main__':
    app.run(debug=True)
