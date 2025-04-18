# Ldap

```
/opt/bitnami/scripts/openlda/run.sh
```

**Ref**
- https://hub.docker.com/r/bitnami/openldap

Tuto:
- https://medium.com/@devripper133127/setting-up-openldap-and-phpldapadmin-with-docker-compose-cf2336590989




























--
Open a terminal session to the OpenLDAP container and install Nano: 
 docker exec -it -u root openldap5 /bin/bash
 apt-get update
 apt-get install nano

Verify the SLAPD service is running:
 ps aux | grep slapd

Start OpenLDAP
 /opt/bitnami/scripts/openldap/run.sh

Navigate to the database files folder to view the various database files:
 cd /bitnami/openldap/slapd.d/cn\=config/

OpenLDAP Commands:

View the OpenLDAP database config file to verify your LDAP settings (most will fall under the "/bitnami/openldap/slapd.d/cn=config" directory): 
 
 cat /bitnami/openldap/slapd.d/cn\=config/olcDatabase\=\{2\}mdb.ldif

Verify all entries below your base DN (See groups, users, OUs, etc.):
  ldapsearch -x -H ldap://192.168.0.1:1389 -D "cn=ldap_admin,dc=test,dc=com" -W -b "dc=test,dc=com" -s sub "(objectclass=*)"
 
View users:
  ldapsearch -x -H ldap://192.168.5.3:1389 -D "cn=ldap_admin,dc=techlogic,dc=com" -W -b "dc=techlogic,dc=com" -s sub "(objectclass=inetOrgPerson)"
   
See specifics of a user:
 ldapsearch -x -H ldap://192.168.0.1:1389 -D "cn=ldap_admin,dc=test,dc=com" -W -b "dc=test,dc=com" "(uid=customuser1)"

#Changing a user's password:

 ldappasswd -x -H ldap://192.168.0.1:1389 -D "cn=ldap_admin,dc=test,dc=com" -W -S "cn=portainer_bind.svc,ou=users,dc=test,dc=com"

LDIF File Examples:

Hashing your password to place in password field of your ldif file:
 slappasswd -s yourpassword
Creating OU, groups, and users with .ldif file (SEE BELOW FOR EXAMPLE .ldif File):
 
 ldapadd -x -H ldap://192.168.0.1:1389 -D "cn=ldap_admin,dc=test,dc=com" -W -f add_items.ldif
 
Modifying existing LDAP Configuration:

 ldapmodify -x -H ldap://192.168.0.1:1389 -D "cn=ldap_admin,dc=test,dc=com" -W -f groupmod.ldif

####### LDIF FILE EXAMPLES [Remove fields that you do not need, this includes all sections in video] #######

Create the "groups" Organizational Unit
dn: ou=groups,dc=test,dc=com
objectClass: organizationalUnit
ou: groups
description: Organizational Unit for Groups

Create the "portainer_bind.svc" User
dn: uid=portainer_bind.svc,ou=users,dc=test,dc=com
objectClass: top
objectClass: person
objectClass: organizationalPerson
objectClass: inetOrgPerson
uid: portainer_bind.svc
cn: portainer_bind.svc
sn: portainer_bind.svc
mail: portainer_bind.svc@test.com
userPassword: {SSHA}THIS_IS_SHA_HASHED_PASSWORD

Create the "Bind_Accounts" Group
dn: cn=bind_account,ou=groups,dc=test,dc=com
objectClass: top
objectClass: groupOfNames
cn: bind_account
member: uid=portainer_bind.svc,ou=users,dc=test,dc=com

Add a new user to the "bind_account" group
dn: cn=bind_account,ou=groups,dc=test,dc=com
changetype: modify
add: member
member: uid=customuser1,ou=users,dc=test,dc=com

Delete a user from a group
dn: cn=examplegroup,ou=groups,dc=example,dc=com
changetype: modify
delete: member
member: uid=exampleuser,ou=users,dc=example,dc=com

Delete an object from LDAP: #
 ldapdelete -x -H ldap://192.168.0.1:1389 -D "cn=ldap_admin,dc=test,dc=com" -W "uid=portainer_bind.svc,ou=users,dc=test,dc=com"

Helpful commands:

To see the different options and command formats for ldapsearch
 ldapsearch --help\

#Enter a shell within a container
 docker exec -it container_name_or_id /bin/bash

#Copy files to container:
 docker cp adduser.ldif openldap1:/tmp