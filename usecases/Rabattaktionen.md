#Rabattaktionen
##actors
- Mitarbeiter
##precondition
- betroffene Kurse/Tarife erstellt, Dauer bekannt
##main flow
- Aktion anlegen-evtl. als neuen Tarif?
- Dauer, Preis, betroffene Kurse eintragen, (Vorraussetzungen eintragen Student?, etc.)
Zur Buchung freigeben
##alternative flow
- Kopie einer bestehenden Aktion wird erstellt und abgeändert
##postcondition
- Aktion angelegt, buchbar durch Mitglieder
##exceptional flow 1
- alte Aktion wird durch neue ersetzt
- Aktion wird bei Mitgliedern ersetzt
- Mitglieder werden benachrichtigt
##exceptional flow 2
- Aktion wird nicht fertiggestellt, setzen auf nicht buchbar
- nachträglich anpasspar siehe flow 1
##postcondition
- Rabattaktion buchbar durch Mitglieder
- Mitglieder alter Rabattaktion umgebucht und benachrichtigt
