#Mitglied kontaktiert Trainer (E-Mail)

##actors 
- Mitglied
- Trainer 

##precondition 
- Trainer bekannt

##main flow 
- Mitglied schreibt Mail
- Wählt den betreffenden Trainer (Name@fitness-studio.de?!)
- Mail zum Server 
- Von da zum Trainer (externer Zugriff auf die Mails -- Oder wenn nicht Weiterleitung)

##alternative flow 
- Im Studio an ein Terminal / Kontakt-Bereich auf der Website
- Mitglied schreibt Mail und schickt sie direkt ab
- Aus der Datenbank wird die Mail-Adresse SEINES Trainers geholt 
- Mail wird dorthin gesendet (und evtl. noch an privat / sonstiges)

##postcondition 
- Trainer erhält die Nachricht vom Mitglied

##exceptional flow 1
- Mitgleid nicht beim richtigen Trainer eingetragen
- Mitglied bei keinem Trainer eingetragen

##exceptional flow 2
- Mail "geht verloren"

##postcondition 
- Trainer erhält keine Nachricht
