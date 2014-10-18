#Kursleiter meldet Teilnehmer für Kurs an
##actors
Kursleiter, Mitglied des Fitnessstudios, neue Mitglieder (welche sich anmelden möchten)
##precondition
Es müssen Kurse und Kursleiter vorhanden sein; Es muss noch Platz im Kurs sein
##main flow
Mitglied geht zu Kursleiter und möchte sich für Kurs anmelden
##alternative flow
Eine Person möchte sich neu im Fitnessstudio anmelden und gleich als Mitglied in einem Kurs eintragen lassen
##postcondition
Mitglied wird in Kurs eingetragen und ggf. für Fitnessstudio angemeldet
##exceptional flow 1
Wenn die Mitgliedschaft eines Mitgliedes vor Ende des Kurses abläuft, muss die Mitgliedschaft verlängert werden um dem Kurs beitreten zu können
##exceptional flow 2
Der Teilnehmer storniert die Anmeldung am Kurs
##postcondition 1
Für neues Mitglied: Mitglied wird für das Fitnessstudio sowie für den Kurs angemeldet
##postcondition 2
Der Teilnehmer muss aus der Teilnehmerliste gelöscht werden und ein freier Platz muss für den Kurs wieder verfügbar sein
