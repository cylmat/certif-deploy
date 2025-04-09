## Kube

https://blent.ai/blog/a/tutoriel-kubernetes-introduction

- Node: Physical/VM server (resources: processor, memory...)
    - Pod1: Logical isolation (e.g. client 1)
        - Container App
        - Container Database
        - ...
    - Pod2: Logical isolation (e.g. client 2)
        - Container App
        - Container Database
        - ...

**Tutos:**  

```
minikube delete && minikube start

kubectl create deployment hello-minikube --image=kicbase/echo-server:1.0
kubectl expose deployment hello-minikube --type=NodePort --port=8080

kubectl get services hello-minikube
minikube service hello-minikube
kubectl port-forward service/hello-minikube 7080:8080

http://localhost:7080
```

https://kubernetes.io/docs/tutorials/kubernetes-basics/create-cluster/cluster-intro

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

- Tutorials
Kube:  
https://kubernetestraining.io  
https://github.com/rslim087a/kong-api-gateway-kubernetes-tutorial  
SSL:
https://www.digicert.com/kb/csr-ssl-installation/nginx-openssl.htm  