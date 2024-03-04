from cryptography.fernet import Fernet
from flask import Flask, render_template, request

app = Flask(__name__)

# Generer en ny nøkkel ved oppstart
key = Fernet.generate_key()
fernet = Fernet(key)

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/encrypt', methods=['POST'])
def encrypt():
    message = request.form['message']
    enc_message = fernet.encrypt(message.encode()).decode()
    dec_message = fernet.decrypt(enc_message.encode()).decode()

    # Skriv ut meldingene i konsollen
    print("Normal melding:", message)
    print("Kryptert melding:", enc_message)
    print("Dekryptert melding:", dec_message)

    return render_template('index.html',
                           normal_message=message,
                           encrypted_message=enc_message,
                           decrypted_message=dec_message)

if __name__ == '__main__':
    app.run(debug=True)
