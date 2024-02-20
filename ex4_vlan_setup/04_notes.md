# VLAN, trunking and L2/L3 Switching setup

This is a simple setup to create the following network and set up inter-vlan routing and trunking using an L2 and an L3 switch:


## ssh access

```bash
ssh -o KexAlgorithms=diffie-hellman-group1-sha1 -o Ciphers=aes256-cbc <user>@<host>
```


## Config

Before configuring, make sure config is mostly empty using

```python
enable
    show running-config
    # If not empty, clear startup config using:
    erase startup-config
    # Then restart the switch
```

After config is clean, apply new configuration.

### L3 switch (here 3750G)

```python
enable
    conf t
        hostname matteol3
        enable password matteol3        # "matteol3" password for "enable" config level
        username matteol3 password matteol3       # enable remote access with user "matteol3" and password "matteol3"
        username matteol3 privilege 15  # make this user the highest 
        ip domain name matteo.local     # domain needed for crypto
        crypto key generate rsa         # generate keys for SSH
            2048                        # key size
        ip ssh version 2                # newest supported SSH version
        ip scp server enable            # enable scp to copy e.g. running-config
        service password-encryption     # encrypt passwords in storage
        line vty 0 15                   # configure all console lines
            login local                 # enable remote authentication with the local user-password combo
            transport input ssh         # allow only ssh remote acccess
            exit
        
        interface range gig 1/0/1-6     # first 6 ports to vlan 16
            switchport mode access
            switchport access vlan 16
            no shutdown
            exit
        
        interface range gig 1/0/7-12     # next 6 ports to vlan 17
            switchport mode access
            switchport access vlan 16
            no shutdown
            exit

        interface gig 1/0/25            # trunk on SFP port
            switchport trunk encapsulation dot1q
            switchport mode trunk
            switchport trunk allowed vlan 16,17
            no shutdown
            exit
        interface gig 1/0/24            # trunk on normal port
            switchport trunk encapsulation dot1q
            switchport mode trunk
            switchport trunk allowed vlan 16,17
            no shutdown
            exit
        
        interface gig 1/0/23            # inter-group networking interface (intranet)
            switchport mode access
            switchport access vlan 1    # arbitrary
            no shutdown
        
        interface vlan 16               # L3 config on vlan16
            ip address 192.168.16.254 255.255.255.0
            no shutdown
            exit
        
        interface vlan 17               # L3 config on vlan17
            ip address 192.168.17.254 255.255.255.0
            no shutdown
            exit
        
        interface vlan 1                # L3 config on intranet
            ip address 192.168.1.16 255.255.255.0
            no shutdown
            exit

        ip dhcp pool vlan16             # enable dhcp for vlan16
            network 192.168.16.0 255.255.255.0
            default-router 192.168.16.254
            dns-server 192.168.16.254   # may not do anything if router does not actually act as dns server
            exit

        ip dhcp pool vlan17             # enable dhcp for vlan17
            network 192.168.17.0 255.255.255.0
            default-router 192.168.17.254
            dns-server 192.168.17.254   # may not do anything if router does not actually act as dns server
            exit
        
        ip routing                      # enable local routing functionality

        router rip                      # rip for intranet config
            version 2
            network 192.168.16.0
            network 192.168.17.0
            network 192.168.1.0
            no auto-summary
        
```

### L2 switch (here 2960G)

```python
enable
    conf t
        hostname matteol2
        enable password matteol2        # "matteol2" password for "enable" config level
        username matteol2 password matteol2       # enable remote access with user "matteol2" and password "matteol2"
        username matteol2 privilege 15  # make this user the highest 
        ip domain name matteo.local     # domain needed for crypto
        crypto key generate rsa         # generate keys for SSH
            2048                        # key size
        ip ssh version 2                # newest supported SSH version
        ip scp server enable            # enable scp to copy e.g. running-config
        service password-encryption     # encrypt passwords in storage
        line vty 0 15                   # configure all console lines
            login local                 # enable remote authentication with the local user-password combo
            transport input ssh         # allow only ssh remote acccess
            exit
        
        interface range gig 1/0/1-6     # first 6 ports to vlan 16
            switchport mode access
            switchport access vlan 16
            no shutdown
            exit
        
        interface range gig 1/0/7-12     # next 6 ports to vlan 17
            switchport mode access
            switchport access vlan 16
            no shutdown
            exit

        interface gig 0/45              # trunk on SFP port
            switchport trunk encapsulation dot1q
            switchport mode trunk
            switchport trunk allowed vlan 16,17
            no shutdown
            exit
        interface gig 0/44              # trunk on normal port
            switchport trunk encapsulation dot1q
            switchport mode trunk
            switchport trunk allowed vlan 16,17
            no shutdown
            exit
        
        interface vlan 16               # L3 config on vlan16
            ip address 192.168.16.253 255.255.255.0
            no shutdown
            exit
        
        interface vlan 17               # L3 config on vlan17
            ip address 192.168.17.253 255.255.255.0
            no shutdown
            exit
        
```
