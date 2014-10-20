#Mitarbeiter storniert Kurs

##actors
- Mitarbeiter
- Kursmitglieder
##precondition
- Kursleiter ist verhindert (Krankheit etc.)

##main flow
- Mitarbeiter (evtl. Kursleiter selbst) storniert Kurs im System mit Angabe von Gründen 
- System überprüft welche Mitglieder sich in dem Kurs befinden
- System beanchrichtigt via Mail (?) Kursmitglieder über die Stornierung des Kurses evtl. mit Angabe des Grundes

##alternative flow
- Mitarbeiter storniert Kurs, weil zu viele (bestimmte Prozentzahl) sich vom Kurs abgemeldet haben
- System sucht die restlichen Mitglieder aus dem Kurs
- System schickt restlichen Mitgliedern Mail um über Storniereung des Kurses zu informieren
- System schreibt Kursmitglied eine Trainingsstunde gut

##postcondition
- Kurs ist storniert
- Mitglieder des Kurses sind benachrichtigt
- evtl. Gutschrift der Trainingseinheit
- evtl. Vorschlag für Ersatztermin bzw. anderen/gleichwertigen Kurs

##exceptional flow 1
- Mitarbeiter storniert Kurs zu kurzfristig vor Kursbeginn

##exceptional flow 2
- Kurs fällt aus
- Mitarbeiter hat diesen nicht vorher storniert

##postcondition
- Gutschein/Gutschrift für Trainingseinheit bzw. Freigetränk bzw. Massage etc. soll ausgestellt werden
