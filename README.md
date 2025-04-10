# Tutorial

Playground for using helm, kubernetes, openssl, etc... 

Run it
```
docker compose -f docker-compose.yml up --build -d
docker compose -f docker-compose.yml down --remove-orphans
```

## Kube (minikube)

Create namespace and metadatas
```
cd kube && kubectl apply .f
```

## Helm

Commands
```
helm repo list
helm search hub <package> (ex: "helm search hub wordpress")
```

## Kong

Installing Kong on Kubernetes
```
helm repo add kong https://charts.konghq.com
helm repo update
```

Ref
---
- Official docs  
https://helm.sh/fr/docs   
https://keycloak.org/documentation   
https://docs.konghq.com  
https://kubernetes.io/docs  
https://openldap.org/doc  

- Utils
https://charts.konghq.com  
https://phpldapadmin.org  
https://simplesamlphp.org  

Tutorials
---
SSL:
https://www.digicert.com/kb/csr-ssl-installation/nginx-openssl.htm  