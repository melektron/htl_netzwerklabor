## Level 0 
pwd: bandit0

Log in via ssh and cat "readme"

## Level 1 
pwd: NH2SXQwcBdpmTEzi3bvBHMM9H66vVXjL

cat ./-

## Level 2
pwd: rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi

cat spaces\ in\ this\ filename

## Level 3
pwd: aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG

cd inhere
cat .hidden

## Level 4
pwd: 2EW7BBsr6aMMoJ2HjW067dm8EgX26xNe

```
bandit4@bandit:~/inhere$ file ./-file00
./-file00: data
bandit4@bandit:~/inhere$ file ./-file01
./-file01: data
bandit4@bandit:~/inhere$ file ./-file02
./-file02: data
bandit4@bandit:~/inhere$ file ./-file03
./-file03: data
bandit4@bandit:~/inhere$ file ./-file04
./-file04: data
bandit4@bandit:~/inhere$ file ./-file05
./-file05: data
bandit4@bandit:~/inhere$ file ./-file06
./-file06: data
bandit4@bandit:~/inhere$ file ./-file07
./-file07: ASCII text
bandit4@bandit:~/inhere$ file ./-file08
./-file08: data
bandit4@bandit:~/inhere$ file ./-file09
./-file09: data
```

cat ./-file07

## Level 5
pwd: lrIWWI6bB37kxfiCQZqUdOIYfr6eEeqR

find -not -executable -size 1033c
cat ./inhere/maybehere07/.file2

## Level 6
pwd: P4L4vucdmLnm8I7Vl7jG1ApGSfjYKqJU

find / -size 33c -user bandit7 -group bandit6 2> /dev/null
cat /var/lib/dpkg/info/bandit7.password

## Level 7
pwd: TESKZC0XvTetK0S9xNwm25STk5iWrBvP

cat data.txt | grep millionth

## Level 8
pwd: TESKZC0XvTetK0S9xNwm25STk5iWrBvP

sort data.txt | uniq -u

## Level 9
pwd: EN632PlfYiZbn3PhVK3XOGSlNInNE00t

strings data.txt | grep ====

## Level 10
pwd: G7w8LIi6J3kTb8A7j9LgrywtEUlyyp6s

base64 -d data.txt

## Level 11
pwd: 6zPeziLdR2RKNdNYFNb6nVCKzphlXHBM

cat data.txt | tr NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz

## Level 12
pwd: JVNBBFSmZwKKOP0XbFXOoW8chDz5yVRv

xxd -r ~/data.txt | gzip -d - | bzip2 -d - | gzip -d - | tar -Oxf - | tar -Oxf - | bzip2 -d - | tar -Oxf - | gzip -d -

## Level 13
pwd: wbWdlBxEir4CaE8LaPhauuOo6pwRmrDw

ssh bandit14@localhost -p 2220 -i sshkey.private

## Level 14
pwd: (no pwd, but ssh private key):
sshkey.private:
```
----(MANGLING-REMOVE-BEFORE-USE)-BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAxkkOE83W2cOT7IWhFc9aPaaQmQDdgzuXCv+ppZHa++buSkN+
gg0tcr7Fw8NLGa5+Uzec2rEg0WmeevB13AIoYp0MZyETq46t+jk9puNwZwIt9XgB
ZufGtZEwWbFWw/vVLNwOXBe4UWStGRWzgPpEeSv5Tb1VjLZIBdGphTIK22Amz6Zb
ThMsiMnyJafEwJ/T8PQO3myS91vUHEuoOMAzoUID4kN0MEZ3+XahyK0HJVq68KsV
ObefXG1vvA3GAJ29kxJaqvRfgYnqZryWN7w3CHjNU4c/2Jkp+n8L0SnxaNA+WYA7
jiPyTF0is8uzMlYQ4l1Lzh/8/MpvhCQF8r22dwIDAQABAoIBAQC6dWBjhyEOzjeA
J3j/RWmap9M5zfJ/wb2bfidNpwbB8rsJ4sZIDZQ7XuIh4LfygoAQSS+bBw3RXvzE
pvJt3SmU8hIDuLsCjL1VnBY5pY7Bju8g8aR/3FyjyNAqx/TLfzlLYfOu7i9Jet67
xAh0tONG/u8FB5I3LAI2Vp6OviwvdWeC4nOxCthldpuPKNLA8rmMMVRTKQ+7T2VS
nXmwYckKUcUgzoVSpiNZaS0zUDypdpy2+tRH3MQa5kqN1YKjvF8RC47woOYCktsD
o3FFpGNFec9Taa3Msy+DfQQhHKZFKIL3bJDONtmrVvtYK40/yeU4aZ/HA2DQzwhe
ol1AfiEhAoGBAOnVjosBkm7sblK+n4IEwPxs8sOmhPnTDUy5WGrpSCrXOmsVIBUf
laL3ZGLx3xCIwtCnEucB9DvN2HZkupc/h6hTKUYLqXuyLD8njTrbRhLgbC9QrKrS
M1F2fSTxVqPtZDlDMwjNR04xHA/fKh8bXXyTMqOHNJTHHNhbh3McdURjAoGBANkU
1hqfnw7+aXncJ9bjysr1ZWbqOE5Nd8AFgfwaKuGTTVX2NsUQnCMWdOp+wFak40JH
PKWkJNdBG+ex0H9JNQsTK3X5PBMAS8AfX0GrKeuwKWA6erytVTqjOfLYcdp5+z9s
8DtVCxDuVsM+i4X8UqIGOlvGbtKEVokHPFXP1q/dAoGAcHg5YX7WEehCgCYTzpO+
xysX8ScM2qS6xuZ3MqUWAxUWkh7NGZvhe0sGy9iOdANzwKw7mUUFViaCMR/t54W1
GC83sOs3D7n5Mj8x3NdO8xFit7dT9a245TvaoYQ7KgmqpSg/ScKCw4c3eiLava+J
3btnJeSIU+8ZXq9XjPRpKwUCgYA7z6LiOQKxNeXH3qHXcnHok855maUj5fJNpPbY
iDkyZ8ySF8GlcFsky8Yw6fWCqfG3zDrohJ5l9JmEsBh7SadkwsZhvecQcS9t4vby
9/8X4jS0P8ibfcKS4nBP+dT81kkkg5Z5MohXBORA7VWx+ACohcDEkprsQ+w32xeD
qT1EvQKBgQDKm8ws2ByvSUVs9GjTilCajFqLJ0eVYzRPaY6f++Gv/UVfAPV4c+S0
kAWpXbv5tbkkzbS0eaLPTKgLzavXtQoTtKwrjpolHKIHUz6Wu+n4abfAIRFubOdN
/+aLoRQ0yBDRbdXMsZN/jvY44eM+xRLdRVyMmdPtP8belRi2E2aEzA==
-----END RSA PRIVATE KEY-----
```

cat /etc/bandit_pass/bandit14 | nc localhost 30000

## Level 15
pwd: jN2kgmIXJ6fShzhT2avhotn4Zcka6tnt

cat /etc/bandit_pass/bandit15 | openssl s_client -ign_eof localhost:30001

## Level 16
pwd: JQttfApK4SeyHwDlI9SXGR50qclOAil1

nmap localhost -p 31000-32000
```
31046/tcp open  unknown (TCP)       (resp: same)
31518/tcp open  unknown (TCP+SSL)   (resp: same)
31691/tcp open  unknown (TCP)       (resp: same)
31790/tcp open  unknown (TCP+SSL)   (resp: ssh ke)
31960/tcp open  unknown (TCP)       (resp: same)
```
cat /etc/bandit_pass/bandit16 | openssl s_client -ign_eof localhost:31790

returned key:
```
----(MANGLING-REMOVE-BEFORE-USE)-BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAvmOkuifmMg6HL2YPIOjon6iWfbp7c3jx34YkYWqUH57SUdyJ
imZzeyGC0gtZPGujUSxiJSWI/oTqexh+cAMTSMlOJf7+BrJObArnxd9Y7YT2bRPQ
Ja6Lzb558YW3FZl87ORiO+rW4LCDCNd2lUvLE/GL2GWyuKN0K5iCd5TbtJzEkQTu
DSt2mcNn4rhAL+JFr56o4T6z8WWAW18BR6yGrMq7Q/kALHYW3OekePQAzL0VUYbW
JGTi65CxbCnzc/w4+mqQyvmzpWtMAzJTzAzQxNbkR2MBGySxDLrjg0LWN6sK7wNX
x0YVztz/zbIkPjfkU1jHS+9EbVNj+D1XFOJuaQIDAQABAoIBABagpxpM1aoLWfvD
KHcj10nqcoBc4oE11aFYQwik7xfW+24pRNuDE6SFthOar69jp5RlLwD1NhPx3iBl
J9nOM8OJ0VToum43UOS8YxF8WwhXriYGnc1sskbwpXOUDc9uX4+UESzH22P29ovd
d8WErY0gPxun8pbJLmxkAtWNhpMvfe0050vk9TL5wqbu9AlbssgTcCXkMQnPw9nC
YNN6DDP2lbcBrvgT9YCNL6C+ZKufD52yOQ9qOkwFTEQpjtF4uNtJom+asvlpmS8A
vLY9r60wYSvmZhNqBUrj7lyCtXMIu1kkd4w7F77k+DjHoAXyxcUp1DGL51sOmama
+TOWWgECgYEA8JtPxP0GRJ+IQkX262jM3dEIkza8ky5moIwUqYdsx0NxHgRRhORT
8c8hAuRBb2G82so8vUHk/fur85OEfc9TncnCY2crpoqsghifKLxrLgtT+qDpfZnx
SatLdt8GfQ85yA7hnWWJ2MxF3NaeSDm75Lsm+tBbAiyc9P2jGRNtMSkCgYEAypHd
HCctNi/FwjulhttFx/rHYKhLidZDFYeiE/v45bN4yFm8x7R/b0iE7KaszX+Exdvt
SghaTdcG0Knyw1bpJVyusavPzpaJMjdJ6tcFhVAbAjm7enCIvGCSx+X3l5SiWg0A
R57hJglezIiVjv3aGwHwvlZvtszK6zV6oXFAu0ECgYAbjo46T4hyP5tJi93V5HDi
Ttiek7xRVxUl+iU7rWkGAXFpMLFteQEsRr7PJ/lemmEY5eTDAFMLy9FL2m9oQWCg
R8VdwSk8r9FGLS+9aKcV5PI/WEKlwgXinB3OhYimtiG2Cg5JCqIZFHxD6MjEGOiu
L8ktHMPvodBwNsSBULpG0QKBgBAplTfC1HOnWiMGOU3KPwYWt0O6CdTkmJOmL8Ni
blh9elyZ9FsGxsgtRBXRsqXuz7wtsQAgLHxbdLq/ZJQ7YfzOKU4ZxEnabvXnvWkU
YOdjHdSOoKvDQNWu6ucyLRAWFuISeXw9a/9p7ftpxm0TSgyvmfLF2MIAEwyzRqaM
77pBAoGAMmjmIJdjp+Ez8duyn3ieo36yrttF5NSsJLAbxFpdlc1gvtGCWW+9Cq0b
dxviW8+TFVEBl1O4f7HVm6EpTscdDxU+bCXWkfjuRb7Dy9GOtt9JPsX8MBTakzh3
vBgsyi/sN3RqRBcGU40fOoZyfAMT8s1m/uYv52O6IgeuZ/ujbjY=
-----END RSA PRIVATE KEY-----
```

exit
vim bandit17.private
(edit file and paste key)
chmod og-rwx bandit17.private


## Level 17
pwd: (key from before)
connecting:
ssh bandit17@bandit.labs.overthewire.org -p 2220 -i bandit17.private

diff passwords.old passwords.new

## Level 18
pwd: hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg

(on host)
ssh bandit18@bandit.labs.overthewire.org -p 2220 "cat ~/readme"

## Level 19
pwd: awhqfNnAbc1naukrpqDYcF95h7HoMTrC

./bandit20-do cat /etc/bandit_pass/bandit20

## Level 20
pwd: VxCazJaVykI6W36BkBU0mJTCM8rR95XT

(tty1:)
cat /etc/bandit_pass/bandit20 | nc -l 1234

(tty2:)
./suconnect 1234

(nc now outputs the correct password)

## Level 21
pwd: NvEJF7oVjkddltPSrdKEFOllh9V1IBcq


