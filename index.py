from cryptography.fernet import Fernet

# vi vil kryptere denne meldingen
message = "hello world"

# Genererer en ny nøkkel
key = Fernet.generate_key()

#koble fernet klassen opp til key'en
fernet = Fernet(key)

#krypter meldingen
encMessage = fernet.encrypt(message.encode())

#printer ut meldingen, og kryptert melding
print("normal meldign", message)
print("krypter melding", encMessage)

#dekrypterer meldingen
decMessage = fernet.decrypt(encMessage).decode()

#printer ut dekryptert melding
print("dekrypter melding", decMessage)