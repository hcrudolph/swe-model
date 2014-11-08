#Erstellung von Trainingsplänen
##actors
Mitglieder, Trainer 
##precondition
Mitglieder ohne Trainingsplan vorhanden 
##main flow		
Trainer gibt Vorschläge für Übungen an
##alternative flow	
Mitglied sucht sich seine Übungen aus und gibt Alternativen als Wunsch an
##postcondition		
Mitglied muss Übungen physisch durchführen können
##exceptional flow 1
Mitglied ist mit dem Trainingsplan (bzw. Vorschläge) nicht einverstanden und muss warten
##exceptional flow 2
Mitglied kann Trainingsplan nicht realisieren und muss stornieren
##postcondition		
Übungen an Geräten müssen als "gebucht" hinterlegt werden
