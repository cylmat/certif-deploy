# Kube

## Create realm

Go to http://localhost:8080/admin/master/console/

* Add Realm 
Manage realms => Create Realm (myrealm)

* Create user
Users => Create (myuser)  
Credentials => Set password (pass)  

Go to http://localhost:8080/realms/myrealm/account   myuser/pass  

* Create Client
Clients => Create client - OpenID Connect (myclient)  
Valid redirect url (after success login) => https://www.keycloak.org/app/*   
Web origin (CORS) => https://www.keycloak.org  

Go to https://www.keycloak.org/app/   (keycloak testing site)  
Save  
-> redirected to https://www.keycloak.org/app/#url=http://localhost:8080&realm=myrealm&client=myclient  

[App OK]  

## Ref
- https://www.keycloak.org/getting-started/getting-started-docker
- https://devsoap.com/setting-up-keycloak-with-docker-a-step-by-step-guide/