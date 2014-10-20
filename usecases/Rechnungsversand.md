#Monatlicher Versand der Rechnung als PDF per Email

##actors 
- Mitglied

##precondition 
- Kosten von Kursen bekannt/ Addition aller Kurse des Mitglieds

##main flow 
- Rechnung wird erstellt
- wird in PDF umgewandelt
- Mailserver sendet vorgefertigte E-mail mit PDF an angegebene E-mailadresse des Mitglieds
- Inhalt der PDF E-mail, Kursname, Kurskosten, Gesammtkosten

##alternative flow 
- Rechnung wird ausgedruckt und von Hand an Mitglieder verschickt?

##postcondition 
- Mitglied wird in richtige Kurse eingetragen
- Beträge stimmen für Kurse

##exceptional flow 
- Mitgleid nicht beim richtigen Kurs eingetragen
- Mitglied gibt falsche E-mailadresse an

##exceptional flow 
- Mail "geht verloren"

##postcondition 
- Mitglied bekommt keine Email