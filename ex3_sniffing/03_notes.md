# Sniffing

Ziel ist es, Netzwerkpakete einer unverschlüsselten HTTP website über unverschlüsseltes WLAN zu sniffen.


## Raspberry PI Imager 

Download unter: https://www.raspberrypi.com/software/ 
Operating System: RASPBERRY PI OS LITE (64-BIT)


## Config

Hostname: flomatteo
USername: flo
password: matteo


## Development Netzwerk

Für die Entwicklung wird ein Netzwerk verwendet das
über Ethernet angeschlossen ist. 

Es wird ein Layer 3 Switch verwendet, port gig 1/0/1-12 sind in unserem Netz und gig 


```python
enable
    conf t
        interface range gig 1/0/1-12
            switchport mode access
            switchport access vlan 2
            no shut
            exit
        interface range gig 1/0/13-24
            switchport mode access
            switchport access vlan 3
            no shut
            exit
        interface range gig 1/0/24
            no switchport
            no shut
            ip address dhcp
            exit
        interface vlan 2
            ip address 10.10.1.254 255.255.255.0
            exit
        interface vlan 3
            ip address dhcp
            exit
        ip routing
        ip dhcp pool "2"
            network 10.10.1.0 255.255.255.0
            default-router 10.10.1.254
            dns-server 1.1.1.1
            exit
        

```