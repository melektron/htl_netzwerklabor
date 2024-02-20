# Sniffing

Ziel ist es, Netzwerkpakete einer unverschlüsselten HTTP website über unverschlüsseltes WLAN zu sniffen.


## Raspberry PI Imager 

Download unter: https://www.raspberrypi.com/software/ 
Operating System: RASPBERRY PI OS LITE (64-BIT)


Rasperry Pi nummer: 6


## Config

Hostname: flomatteo
USername: flo
password: matteo


## Netzwerk setup

Für development Ethernet an PC verbunden um SSH zugriff zu bekommen.
Dann wird mit networkmanager mit einem WLAN verbunden für updates:

```bash
sudo nmtui # terminal gui for network manager
# Gute info über NetworkManager und nmcli: http://www.intellamech.com/RaspberryPi-projects/rpi_nmcli.html
```

(WPA2 Enterprise konnte nicht zum laufen bringen)


## Software

```bash
sudo apt update
sudo apt install apache2 -y
sudo apt install php -y 
```


## WebServer config

Apache ist jetzt automatisch gestartet. Im ordner "/var/www/html" liegt das Root Verzeichnis des Webservers.
Dort wird unsere index.php Datei und unser flomatteo.php form receiver abgelegt werden. Auch die Bilddatei muss kopiert werden wenn sie angezeigt werden soll.


## HTTPS

Um HTTPS zu konfigurieren, muss ein SSL Zertifikat erstellt und Apatche so konfiguriert werden, dass es verwendet wird.
Solange nur ein lokales Netzwerk verwendet wird der Browser das Zertifikat zwar nicht ohne weiteres verifizieren können und daher eine Warnung ausgeben, aber die Verschlüsselung wird trotzdem funktionieren.

Konfiguration:

```bash
sudo apt update
sudo apt install openssl
sudo mkdir -p /etc/ssl/mycerts

```


## Sniffing

Um sniffing zu betreiben muss der Pi und ein Ziel PC mit einem unverschlüsselten WLAN verbunden werden.
Dann wird am besten Kali Kali Linux gebootet.

Dann kann die Netzwerkkarte in Monitoring mode versetzt werden, falls diese das unterstützt:

```bash

sudo ifconfig <interface> down
sudo airmon-ng check # sehen ob prozesse die netzwerk karte benutzen
sudo airmon-ng check kill # sollte alle diese Prozesse killen (eventuell mehrmals machen)
sudo iwconfig <interface> mode monitoring
sudo iwconfig <interface> channel 1 # auf den WiFi channel anpassen
sudo ifconfig <interface> up
```

Jetzt kann mit Wireshark das Interface überwacht werden.
Filtert man auf die Server IP (IP des Pis) und öffnet dann die Seite bzw gibt das Passwort ein, so sieht man den Post request und den GET request.

Man kann auch nur auf POST request filtern:

```python
ip.addr==<pi ip addr> && http.request.method==POST
```

