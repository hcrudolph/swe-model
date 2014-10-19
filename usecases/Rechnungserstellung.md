#Büromitarbeiter erstellt Rechnung Kunden
##actors
Büromitarbeiter, Kunde, Trainer
##precondition
Kunde hat Leistung bestellt in Anspruch genommen
##main flow
Nach eingereichter Teilnahmeliste des Kurses wird die entsprechende Rechnung über ein Billing-System(?) erstellt (Kundenanschrift, Firmenanschrift, besuchter Kurs, Kosten, Zahlungsmodalitäten) 
##alternative flow
Rechnung wird manuell erstellt.
##postcondition
Rechnung ist erstellt und wird zugestellt.
##exceptional flow 1
Kurs ist ausgefallen
##exceptional flow 2
Leistung wurde nicht in Anspruch genommen bzw. abgesagt
##postcondition
Rechnung wird nicht erstellt
