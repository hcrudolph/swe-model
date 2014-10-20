#Zahlungsreminder

##actors 
- Mitglied

##precondition 
- Kosten von Kursen bekannt/ Addition aller Kurse des Mitglieds
- Zahlungsdatum von Mitglied bekannt

##main flow 
- Vorgefertigte E-Mail wird erstellt
- Gesammtkosten werden eingetragen
- Mailserver sendet vorgefertigte E-mail an angegebene E-mailadresse des Mitglieds
- Inhalt E-mail, Kursname, Kurskosten, Gesammtkosten, Zahlungstermin

##postcondition 
- Mitglied wird in richtige Kurse eingetragen
- Beträge stimmen für Kurse
- Datum für Zahlung stimmt

##exceptional flow 1
- Mitgleid nicht beim richtigen Kurs eingetragen
- Mitglied gibt falsche E-mailadresse an
- Falsches Mitglied

##exceptional flow 2 
- Mail "geht verloren"

##postcondition 
- Richtiges Mitglied