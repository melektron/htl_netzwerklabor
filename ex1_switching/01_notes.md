Name: Florian Unterpertinger, Matteo Reiter <br>
Jahrgang: 2023/24 <br>
Gruppe: 4AHEL/H <br>
Betreuer: Markus Signitzer <br>

# 01 Switching

## Grundwissen

> ## 1. Vorwissen
>
> Um die Übung erfolgreich zu absolvieren, müssen folgende Fragen zu Beginn der
> Übung beantwortet werden und ebenfalls im Laborbericht (auch die Fragen zu den
> einzelnen Übungen unten) behandelt werden:
> 
> - Was ist ein Switch? Wie funktioniert er? In welchem OSI-Layer arbeitet er?
>   Wie erlernt er die MAC-Table?
> - Wie kann man auf den Switch zugreifen?
> - Was ist ein Switch virtual interface (SVI)? 
> - Was ist ein VLAN? Wofür sind sie gut?
> - Was ist ein Trunk?
> - Was bedeutet encapsulation?
> 
> Grundlegenden Informationen findet man im CISCO CCNA R&S Routing and
> Switching Essentials Kurs in den Kapiteln 2 und 3 (dies gilt für die Kursversion 5.0 – vom Jahr 2016)

### Antworten

1. Ein Switch ist ein Verteiler für Ethernet Frames und arbeitet auf Layer 2. Er verteilt Frames gezielt an notwendigen Empfänger. In dem Frames mit einer bestimmten Source-MAC an einem Port ankommen, merkt er sich mittels MAC-Address-Table dass der entsprechende Host mit diesem Port verbunden ist und sendet frames für diesen Host zukünftig nur noch an diesen Port. Wenn Zielport noch nicht bekannt ist, wird ein frame an alle Ports (außer source port) "gefloodet".

2. Über die Console, SSH oder Telnet
3. Ein Virtuelles Netzwerk Interface um mittels SSH/Telnet eine Verbindung mit dem Switch aufzubauen
4. Virtuelles Netzwerk; Unterteilung der Ports eines Switches 
5. Verbindung zur gleichzeitigen Übertragung von mehreren Signalen 
6. Das verpacken von higher-layer-PDUs in die der niedrigeren Layer.

## Übungen


> ## 2.1 Plug and Play Switch
> 
> Zwei PCs (Achtung IP-Config - selbes Netzwerk!) sollen mit >einem Switch verbunden
> werden. Connectivity mit pings überprüfen.
> 
> - Funktioniert die Verbindung? 
> - Warum geht der erste ping eventuell verloren?
>

### Antworten

PCs werden auf gleichen switch verbunden (andere PCs sind auch schon drauf, stören aber nicht):

// bilder

Beide PCs werden auf dem gleichen subnetz konfiguriert:

```
PC1: 10.11.12.13/24
PC2: 10.11.12.14/24
```

Pings Funktionieren:

PC1 -> PC2:
![](ping_1_to_2.png)

PC2 -> PC1:
![](ping_2_to_1.png)

Anfangs kann es sein dass die ersten ping versuche Fehlschlagen da die MAC Adresse des anderen Hosts erst mittels ARP Protokoll ermittelt werden muss.


> ## 2.2 Switch Configuration
>
> Auf das Switch IOs mit Hilfe des Console-Kabels zugreifen und folgende Konfigurationen vornehmen: Hostname, Passwörter für Fernzugriff und Konfiguratiosebenen sowie ein Banner-MOTD setzen. Denn Switch für Telnetzugriff konfigurieren (SVI) und den Telnet-Zugang testen.
> - Wo bzw. wie kann man sich die aktuelle Switch Konfiguration ansehen?
> - Wie kann man die Passwörter in der Konfiguration verschlüsseln?
> - Warum soll man Telnet nicht verwenden? Mit Wireshark das Telnet-PW mithören. Wie konfiguriert man einen sicheren Fernzugriff (SSH)? Wieder mit Wireshark „mithören“. 