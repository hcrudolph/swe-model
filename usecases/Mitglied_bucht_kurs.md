#Mitglied meldet sich für Kurs an

##actors
- Mitglied
##precondition
- Kurs existiert und max. Teilnehmerzahl ist noch nicht erreicht
##main flow
- Mitglied meldet sich erfolgreich an,
- DB aktualisiert/inkrementiert aktuelle Teilnehmerzahl
##exceptional flow 1
- max. Teilnehmerzahl bereits erreicht
- Kurs kann nicht mehr gebucht werden
- Link auf GUI deaktiviert
##exceptional flow 2
- Mitglied hat diesen Kurs bereits gebucht
- Kurs kann nicht mehr gebucht werden
- Benachrichtigung auf GUI
##postcondition
- Mitglied hat Kurs verbindlich gebucht
- Teilnehmerzahl wurde aktualisiert