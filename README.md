# SWE: Fitness-Projekt

Dies ist das Git Repository zum *Fitness*-Projekt im Modul Softwareengineering (DKMI_13). 

## Szenario
Als Mitarbeiter eines Softwarehauses haben Sie den Auftrag erhalten, eine Softwarelösung für ein
Fitness Studio zu erarbeiten. Der Auftraggeber hat bereits Vorstellungen davon, was die Software
unbedingt leisten soll. Leider sind diese Vorstellungen unvollständig.
Der Auftraggeber erwartet, dass Sie ihn beratend bei diesem Projekt unterstützen. Bevor der
Entwicklungsauftrag endgültig vergeben wird, ist dem Auftraggeber ein verbindliches Angebot über
den Funktionsumfang der Lösung zu unterbreiten. Gleichzeitig bildet dieses Angebot inkl.
des Pflichtenheftes die rechtliche Grundlage für den Entwicklungsauftrag. Der Auftraggeber
beschreibt die Funktionen der Software auszugsweise wie folgt:

>„Das Verwaltungssystem des Fitness Studios soll durch Sachbearbeiter bedient werden, welche Kurse
und Räume verwalten. Für einen Kurs sollen der Zeitraum, die max. Teilnehmerzahl und der
durchführende Kursleiter erfasst werden. Kursleiter werden mit einem variablen Stundensatz bezahlt.
Potenzielle Teilnehmer sollen sich elektronisch anmelden, aber auch abmelden können. Unter
besonderen Umständen, z. B. im Krankheitsfall, müssen auch Kurse storniert werden können. Die
Kommunikation zwischen dem System, den Trainern und den Teilnehmern soll elektronisch erfolgen.
Hierzu zählen Informationen, Absagen, Zusagen, Abrechnungen und Erinnerungen. Die Abrechnung
der Kursleiter und Kursteilnehmer erfolgt über ein vorhandenes Fakturierungssystem. Rechnungen,
Teilnehmerzertifikate und sämtlicher Briefverkehr werden über ein Druckereisystem abgewickelt. Die
technische Betreuung aller Softwaresysteme erfolgt über Mitarbeiter im Rechenzentrum.“

## Vorbereitende Aufgaben

1. Wer arbeitet mit dem Softwaresystem?
2. Welcher Benutzer benötigt welche Funktionen?
3. Welche Informationen müssen zu einer Person/Benutzer gespeichert werden, um einen
Geschäftsprozess, z. B. das Planen von Kursen, mit dem System abzuwickeln?
4. Welche im Szenario nicht genannten Funktionen werden von dem Softwaresystem benötigt,
um heutigen Anforderungen zu entsprechen? Nennen Sie beispielhaft fünf Funktionen!
5. Was ist ein Anwendungsfall und welche Beziehungen zwischen Anwendungsfällen beschreibt
der Standard [1]?
6. Beschreiben Sie die Anwendungsfälle „Teilnehmer anmelden“ und „Kurs planen“ nach dem
folgenden Muster:
	- **use case** Teilnehmer anmelden
	- **actors** Liste der Akteure
	- **precondition** Voraussetzungen
	- **main flow** Beschreibung des Anwendungsfalls für den einfachsten bzw. normalen Verlauf
	- **alternative flow** Beschreibung des alternativen Ablaufs des Anwendungsfalls
  	- **postcondition** Ergebnis des Anwendungsfalls
	- **exceptional flow 1** Beschreibung der Ausnahme 1
	- **exceptional flow 2** Beschreibung der Ausnahme 2
	- **postcondition** Ergebnis der Ausnahmesituationen
	- **end** Teilnehmer anmelden