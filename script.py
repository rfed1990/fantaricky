filename = "karate.php"  # Nome del file PHP
line_number = 4  # Riga da cercare
search_phrase = "include(header.php)"  # Frase da cercare

# Legge il file riga per riga
with open(filename, "r", encoding="utf-8") as file:
    lines = file.readlines()

# Controlla se la riga esiste
if len(lines) >= line_number:
    line_content = lines[line_number - 1].strip()  # Prendi la riga 4
    if search_phrase in line_content:
        print(f"La frase '{search_phrase}' è presente sulla riga {line_number}!")
    else:
        print(f"La frase '{search_phrase}' NON è presente sulla riga {line_number}.")
else:
    print(f"La riga {line_number} non esiste nel file!")
