#Kursleiter erstellt neuen Kurs

## actors
Kursleiter
## precondition
Raum muss zur gewünschten Zeit zur Verfügung stehen
## main flow
Kursleiter bucht Raum für eine bestimmte Zeit (feste Zeitslots),
DB speichert Kursname, Raum, Beschreibung, max. Teilnehmerzahl,
Raum wird für diesen Zeitraum als gebucht markiert
## postcondition
Raum und Kursleiter sind verbindlich gebucht und für diesen Zeitraum nicht verfügbar
## exceptional flow 1
Raum zur gewünschten Zeit schon gebucht -> Benachrichtigung auf GUI -> Kurs wird nich angelegt
## exceptional flow 2
Kurs mit gleichem Namen schon vorhanden -> Nachfrage der Aktion auf GUI -> Falls JA: Kurs wird angelegt
## exceptional flow 3
Kursleiter nicht verfügbar -> Benachrichtigung auf GUI -> Kurs wird nich angelegt
## exceptional flow 4
Kursleiter/Raum nicht im System registriert-> Benachrichtigung auf GUI -> Kurs wird nich angelegt
## postcondition
Raum/Kursleiter für diesen Zeitraum als gebucht markiert (nicht verfügbar)
