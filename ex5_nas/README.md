

Features:
- File sharing (SMB)
- 




Nextcloud SMB Minecraft Inventree 
       Docker
       NixOS




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

# NixOS install new

