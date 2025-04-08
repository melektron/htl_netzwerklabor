
# Vorgaben
smb share

user flo
user melektron
user signitzer

jeder ein privates verzeichnism
1 shared folder
raid


#  Features:

- File sharing (SMB)
- syncthing



# Nixos INstallation (old, did not work)

https://nixos.org/manual/nixos/stable/#sec-installation-manual

- Minimal 24.11 -> Ventoy -> boot
- Terminal
- Network connect to HTL network (switch of A network in netzwerklabor -> allows direct connections between devices)
- ```sudo -i su```
- Change keymap
  - ```loadkeys de```
- Check network from NAS to interne 
  - ```ip a```
    - IP: 10.10.72.106 
  - ```ping 1.1.1.1```
- Check Access from laptop to nas:
  - ```ip a```
    - IP: 10.10.72.107 
  - ```ping 10.10.72.106```
- identify disks
  - ```lsblk```
    - sda: 465.8G -> Data disk 1
    - sdb: 465.8G -> Data disk 2
    - sdc: 232.9G -> System disk
- Check memory
  - ```nix-shell -p htop```
  - ```htop```
  - -> 3.71G (4GB)
- Configure partitions of boot disk
  - sdc
    - GPT table: ```parted /dev/sdc -- mklabel gpt```
    - Create root partition from 512MB the end-8GB: ```parted /dev/sdc -- mkpart root ext4 512MB -8GB```
    - Create swap partition from the end-8GB to the very end: ```parted /dev/sdc -- mkpart swap linux-swap -8GB 100%```
    - Create efi partition in space at start: ```parted /dev/sdc -- mkpart ESP fat32 1MB 512MB```
    - Mark efi partition as such: ```parted /dev/sdc -- set 3 esp on```
- Prepare the filesystems:
  - Root: ```mkfs.ext4 -L nixos /dev/sdc1```
  - Swap: ```mkswap -L swap /dev/sdc2```
  - EFI: ```mkfs.fat -F 32 -n boot /dev/sdc3```
- Prepare storage array (https://www.linuxbabe.com/linux-server/linux-software-raid-1-setup)
  - gpt on both disks
    ```parted /dev/sda -- mklabel gpt```
    ```parted /dev/sdb -- mklabel gpt```
  - create empty partitions
    ```parted /dev/sda -- mkpart storageA 1MiB 128GiB```
    ```parted /dev/sdb -- mkpart storageB 1MiB 128GiB```
  - maybe a raid from previous group detected, disable it: ```mdadm --manage --stop /dev/md127```
  - https://archive.kernel.org/oldwiki/raid.wiki.kernel.org/index.php/A_guide_to_mdadm.html
  - ```mdadm --create /dev/md0 --level=mirror --raid-devices=2 /dev/sda1 /dev/sdb1```
- Install system
  - ```mount /dev/disk/by-label/nixos /mnt```
  - ```mkdir -p /mnt/boot
    mount -o umask=077 /dev/disk/by-label/boot /mnt/boot```
  - ```swapon /dev/sda2``` enable swap
  - ```nixos-generate-config --root /mnt``` 
  - ```nixos-install```
    -> root password: ```password1234```

## Config

loadkeys de

No flakes weil einfacher fürs erste

Installing vim, htop, mdadm

enable ssh + permit root login

user:
```
  # define a user. Don't forget to set a password with ‘passwd’.
  users.users = {
    person = {
      isNormalUser = true;
      description = "person";
      extraGroups = [ 
        "networkmanager"
        "wheel"
        "dialout"
        "docker"
      ];
    };
    markus = {
      isNormalUser = true;
      createHome = false;
      description = "signitzer";
    };
    matteo = {
      isNormalUser = true;
      createHome = false;
      description = "reiter";
    };
    florian = {
      isNormalUser = true;
      createHome = false;
      description = "unterpertinger";
    };
  };
  users.groups = {
    "nasusers" = {
      members = ["markus" "matteo" "florian"];
    };
  };
```

network manager on

timezone europe/vienna

console keymap de

Passwort setzen: ```passwd person``` (Passwort: "person")

permint root login danach wieder auskommentieren

Docker:
```
# enable docker
virtualisation.docker.enable = true;
```

Nochmal:
```mdadm --create /dev/md0 --level=mirror --raid-devices=2 /dev/sda1 /dev/sdb1```

Raid Support:
```
boot.swraid.enable = true;
# we don't want to send logs per email
boot.swraid.mdadmConf = ''
  MAILADDR=nobody@nowhere
'';
```

reboot

jetzt ist bei lsblk sda die boot platte und sdb und sdc das raid, jetzt als ```md128``` bezeichnet

Create Raid file system:
```sudo mkfs.ext4 -L storage /dev/sdc1```

Zum mounten des Raids

```nix
 fileSystems."/mnt/storage" = {
   device = "/dev/disk/by-id/md-uuid-056d1d48:63ca12ff:d38679f1:81f4bd0e";
   fsType = "ext4";
   options = [ # If you don't have this options attribute, it'll default to "defaults" 
     # boot options for fstab. Search up fstab mount options you can use
     "users" # Allows any user to mount and unmount
     "nofail" # Prevent system from failing if this drive doesn't mount
     
   ];
 };
```

Samba:

```nix
  services.samba = {
    enable = true;
    openFirewall = true;
    settings = {
      global = {
        "workgroup" = "WORKGROUP";
        "server string" = "nixos";
        "netbios name" = "nixos";
        security = "user";
        "hosts allow" = "0.0.0.0/0";
        "guest account" = "nobody";
        "map to guest" = "bad user";
      };
      "public" = {
        "path" = "/mnt/storage/public";
        
        "force group" = "nasusers";
        "create mask" = "0664";     # rw-rw-r--
        # execute is needed for traversal of directories
        "directory mask" = "0775";  # rwxrwxr-x

        "browseable" = "yes";
        "read only" = "no";
        "guest ok" = "no";
        "write list" = "markus,matteo,florian";
        "valid users" = "markus,matteo,florian";
      };
      "markus" = { # sudo smbpasswd -a markus -> "markus"
        "path" = "/mnt/storage/markus";
        "browseable" = "yes";
        "read only" = "no";
        "guest ok" = "no";
        "write list" = "markus";
        "valid users" = "markus";
      };
      "matteo" = { # sudo smbpasswd -a matteo -> "matteo"
        "path" = "/mnt/storage/matteo";
        "browseable" = "yes";
        "read only" = "no";
        "guest ok" = "no";
        "write list" = "matteo";
        "valid users" = "matteo";
      };
      "florian" = { # sudo passwd -a florian -> "florian"
        "path" = "/mnt/storage/florian";
        "browseable" = "yes";
        "read only" = "no";
        "guest ok" = "no";
        "write list" = "florian";
        "valid users" = "florian";
      };
    };
  };
  services.samba-wsdd = {
    enable = true;
    openFirewall = true;
  };
```

Ordner erstellen:
```bash
cd /mnt/storage
sudo mkdir public
sudo chown person:nasusers public
sudo chmod 777 public # 777 needed for syncthing
sudo mkdir markus
sudo chown person:nasusers markus
sudo mkdir matteo
sudo chown person:nasusers matteo
sudo mkdir florian
sudo chown person:nasusers florian
```


Extra avahi service to advertise share

```nix
  # https://gist.github.com/vy-let/a030c1079f09ecae4135aebf1e121ea6
  services.avahi = {
    enable = true;
    nssmdns = true;
    publish = {
      enable = true;
      addresses = true;
      domain = true;
      hinfo = true;
      userServices = true;
      workstation = true;
    };
    extraServiceFiles = {
      smb = ''
        <?xml version="1.0" standalone='no'?><!--*-nxml-*-->
        <!DOCTYPE service-group SYSTEM "avahi-service.dtd">
        <service-group>
          <name replace-wildcards="yes">NixIsSuppa</name>
          <service>
            <type>_smb._tcp</type>
            <port>445</port>
          </service>
        </service-group>
      '';
    };
  };
```


Enable Syncthing:
```nix
  services.syncthing = {
    enable = true;
    group = "nasusers";
    #dataDir = "/home/person";
    openDefaultPorts = true;

    guiAddress = "0.0.0.0:8384";  # allow access from local network bc this is a headless server
    # Optional: GUI credentials (can be set in the browser instead if you don't want plaintext credentials in your configuration.nix file)
    # or the password hash can be generated with "syncthing generate --config <path> --gui-password=<password>"
    settings = {
      gui = {
        user = "person";
        password = "person";
      };
      devices = {
        flo = {
            id = "7FOD7EN-HVNYSSD-4CSAXOS-JMXHP43-DW57S6V-J3BKUP7-24QZBHM-M7WK5QW";
        };
        goarnix = {
            id = "OV7VF4Z-JGZN6EN-JYFKQDJ-JTQKS27-CQK5OUU-FUL7LSS-QCGRU35-7KAHYA2";
        };
      };
      folders = {
        "public" = {
          path = "/mnt/storage/public";
          devices = [ "flo" "goarnix" ];
          copyOwnershipFromParent = true;   # make syncthing give new files the permissions of the parent folder (for this we need CAP_CHOWN)
          ignorePerms = true;   # if we do not do this, syncthing always makes files rw-r--r-- and folders rwxr--r-- but we need rwxrwxr-x and rw-rw-r--
        };
      };
    };
  };
  # allow g+w for newly created folders (https://nitinpassa.com/running-syncthing-as-a-system-user-on-nixos/)
  systemd.services.syncthing.serviceConfig.UMask = "0002";

  # give CAP_CHOWN and cap_fowner (which some say is also neede)
  # https://github.com/NixOS/nixpkgs/issues/338485
  # https://search.nixos.org/options?channel=24.11&show=services.syncthing.settings.folders.%3Cname%3E.copyOwnershipFromParent&from=0&size=50&sort=relevance&type=packages&query=services.syncthing.
  security.wrappers.syncthing = {
    owner = "person";
    group = "nasusers";
    capabilities = "cap_chown,cap_fowner=pe";
    source = "${pkgs.syncthing}/bin/syncthing";
  };
```