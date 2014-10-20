#Erstellen  von Tarif durch Mitarbeiter
##actors
- Mitarbeiter
##precondition
- Leistungsumfang bekannt, gewünschte inklusiv-Kurse erstellt
##main flow
- Neuer Tarif wird angelegt (noch nicht in DB?!),
- monatlicher Preis wird eingetragen,
- Kurse werden zugeordnet
- Gültigkeitsdauer eingetragen
- (Vorraussetzungen eintragen)
- zur Buchung freigeben
##alternative flow
- Kopie eines bestehenden Tarifs wird erstellt und abgeändert
##postcondition
- Tarif angelegt, buchbar durch Mitglieder
##exceptional flow 1
- alter Tarif wird durch neuen Tarif ersetzt
- Tarif wird bei Mitgliedern ersetzt
- Mitglieder werden benachrichtigt
##exceptional flow 2
- Neuer Tarif wird nicht fertiggestellt, setzen auf nicht buchbar
- nachträglich anpassbar
##postcondition
- Tarif angelegt, buchbar durch Mitglieder
- Mitglieder die alten Tarif hatten sind umgebucht und benachrichtigt