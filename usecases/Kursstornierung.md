#Kursleiter storniert Kurs
##actors
Kursleiter, Kursmitglieder
##precondition
Kursleiter ist verhindert (Krankheit etc.)
##main flow
Kursleiter storniert Kurs im System mit Angabe von Gründen, System überprüft welche Mitglieder sich in dem Kurs befinden, System beanchrichtigt (via Mail) Kursmitglieder über die Stornierung des Kurses (evt. mit Angabe des Grundes)
##alternative flow
Kursleiter storniert Kurs, weil zu viele (Prozentangabe erforderlich) sich vom Kurs abgemeldet haben, System sucht die restlichen Mitglieder aus dem Kurs, System schickt restlichen Mitgliedern Mail um über Storniereung des Kurses zu informieren, System schreibt Kursmitglied eine Trainingsstunde gut
##postcondition
Kurs ist storniert, Mitglieder des Kurses sind benachrichtigt, evt. Gutschrift der Trainingseinheit, evt. Vorschlag für Ersatztermin bzw. anderen/gleichwertigen Kurs
##exceptional flow 1
Kursleiter storniert Kurs zu kurzfristig vor Kursbeginn
##exceptional flow 2
Kurs fällt aus, Kursleiter hat diesen aber nicht vorher storniert
##postcondition
Gutschein/Gutschrift für Trainingseinheit bzw. Freigetränk bzw. Massage etc. soll ausgestellt werden
