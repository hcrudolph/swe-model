#Kursleiter meldet Teilnehmer für Kurs an

##actors
- Kursleiter
- Mitglied

##precondition
- Kurs und Kursleiter vorhanden
- max. Teilnehmerzahl des Kurses noch nciht erreicht

##main flow
- Mitglied geht zu Kursleiter und möchte sich für Kurs anmelden
- Kursleiter registriert Mitglied für gewünschten Kurs
- DB inkrementiert aktuelle Teilnehmerzahl des Kurses

##postcondition
- Mitglied hat Kurs verbindlich gebucht
- aktuelle Teilnehmerzahl des Kurses wurde aktualisiert