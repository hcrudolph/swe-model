#Buchung von Geräten
## actors
Kursleiter, Mitglieder
##precondition
Gerät muss frei/verfügbar sein
##main flow
Mitglied bucht für sich ein Gerät für eine bestimmte Zeit (Höchstzeit muss festgelegt sein), System hält Nutzungszeit und Nutzer fest
##alternative flow
für Kurse, die Geräte benutzen müssen diese automatisch (Anzahl der Mitglieder/Höchstteilnehmerzahl) reserviert werden, System trägt Kursleiter als Nutzer und den Kurszeitraum als Nutzungszeit ein
##postcondition
Gerät ist verbindlich gebucht und kann für diesen Zeitraum nicht erneut gebucht werden
##exceptional flow 1
Gerät ist in Wartung/beschädigt/verloren/allg. nicht verfügbar, Gerät wird als dauerbelegt gebucht, bis Fehler behoben, bei Kursen, die dieses Gerät brauchen muss die Höchstanzahl der Mitgleider angepasst werden, evt. schon zu viel eingetragene Mitglieder müssen aus dem Kurs storniert werden (wer sich zu letzt eingetragen hat, wird aus Kurs ausgetragen und benachrichtigt über Mail)
##exceptional flow 2
Kurs (Geräte benötig) wird angelegt, wenn Geräte schon durch Mitglieder gebucht, Kursmitgliedszahl muss an freie Geräte angepasst werden
##postcondition
Umbuchung von Geräten, Mitgliedszahlanpassung der Kurse
