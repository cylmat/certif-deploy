# Kube

## Usage

- https://kubernetes.io/docs/tutorials/kubernetes-basics

**Start**
```
minikube delete && minikube start
minikube dashboard (in other terminal) 
kubectl config view
```

**Deploy**
```
kubectl create deployment hello-minikube --image=kicbase/echo-server:1.0
kubectl expose deployment hello-minikube --type=NodePort --port=8080     (or --type=LoadBalancer)

kubectl get deploy,events -n kube-system
```

**Make the node Container accessible from outside: Proxy or service**  

**Proxy**
```
kubectl proxy -p 8050 (in other terminal) 
curl http://127.0.0.1:8050/version

kubectl get pods -o json | jq '.items[0].metadata.name'
export POD_NAME=$(kubectl get pods -o go-template --template '{{range .items}}{{.metadata.name}}{{"\n"}}{{end}}')
curl http://localhost:8050/api/v1/namespaces/default/pods/$POD_NAME:8080/proxy/
```

**Use service (provide IP)**
```
minikube service hello-minikube
kubectl get services hello-minikube
kubectl describe services hello-minikube
```

**Port-forward on local**
```
kubectl port-forward service/hello-minikube 7080:8080
http://localhost:7080
```

**Addons**
```
minikube addons list
minikube addons enable metrics-server
```

**Clean**
```
kubectl delete service hello-minikube
kubectl delete deployment hello-minikube
minikube stop    (minikube delete)
```

## Infos

- A Pod is a group of one or more Containers.
- kubectl <action> <resource>
- kubectl create/describe/delete node/deployment/service

- Node: Physical/VM server (resources: processor, memory...)
    - Pod1: Logical isolation (e.g. client 1)
        - Container App
        - Container Database
        - ...
    - Pod2: Logical isolation (e.g. client 2)
        - Container App
        - Container Database
        - ...

**Actions**
```
kubectl config get-contexts
kubectl get nodes
kubectl get pods -A
kubectl get pods -l "app=hello-minikube"
kubectl get svc  (services)
kubectl get deploy,pods,events -n kube-system

Sample
kubectl create deployment hello-node --image=registry.k8s.io/e2e-test-images/agnhost:2.39 -- /agnhost netexec --http-port=8080
```

**Refs** 
---
- https://kubernetestraining.io
- https://labs.play-with-k8s.com
- https://blent.ai/blog/a/tutoriel-kubernetes-introduction
- https://github.com/rslim087a/kong-api-gateway-kubernetes-tutorial  

Port forward:
- https://kubernetes.io/docs/tasks/access-application-cluster/port-forward-access-application-cluster