
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
