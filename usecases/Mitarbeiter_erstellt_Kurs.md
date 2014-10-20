#Kursleiter erstellt neuen Kurs

## actors
- Mitarbeiter
## precondition
- Raum muss zur gewünschten Zeit zur Verfügung stehen
- beteiligte Trainer und Kursleiter muss existieren
## main flow
- Mitarbiter bucht Raum für eine bestimmte Zeit (feste Zeitslots)
- Angabe von Kursleiter (Pflichtfeld) und Trainern
- DB speichert Kursname, Beschreibung, Kursleiter, Raum und max. Teilnehmerzahl
- Raum wird für diesen Zeitraum als gebucht markiert
## postcondition
- Raum und Kursleiter sind verbindlich gebucht und für diesen Zeitraum nicht verfügbar
## exceptional flow 1
- Raum zur gewünschten Zeit schon gebucht 
- Benachrichtigung auf GUI 
- Kurs wird nich angelegt
## exceptional flow 2
- Kurs mit gleichem Namen schon vorhanden 
- Nachfrage der Aktion auf GUI 
- Falls JA: Kurs wird angelegt
## exceptional flow 3
- Kursleiter nicht verfügbar
- Benachrichtigung auf GUI 
- Kurs wird nich angelegt
## exceptional flow 4
- Kursleiter/Raum nicht im System registriert
- Benachrichtigung auf GUI
- Kurs wird nich angelegt
## postcondition
- Raum/Kursleiter für diesen Zeitraum als gebucht markiert (nicht verfügbar)
