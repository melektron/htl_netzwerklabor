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


## Development Netzwerk

Für die Entwicklung wird ein Netzwerk verwendet das
über Ethernet angeschlossen ist. 

Es wird ein L2 Switch mit mehreren VLANs verwendet, der dann mit einem Router über einen Trunk verbunden wird welcher mittels NAT wlan zugriff gibt


L2 switch: 

```python
enable
    conf t
        interface range fast 0/1-6
            switchport mode access
            switchport access vlan 10
            no shut
            exit
        interface fast 0/48
            switchport mode trunk
            switchport trunk encapsulation dot1q
            switchport trunk allowed vlan 10,20,30,40,50
            exit
        # repeat the last two blocks for every vlan
```

Am Router:

```python
enable
    conf t
        interface gigabitEthernet 0/1.10
            encapsulation dot1Q 10
            ip address 10.10.1.254 255.255.255.0
            exit
        ip dhcp pool "10"
            network 10.10.1.0 255.255.255.0
            default-router 10.10.1.254
            dns-server 1.1.1.1
            exit
        # repeat the last two blocks for every vlan

```

## Webserver 
Xampp root folder: C:\xampp\htdocs 
