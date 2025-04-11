# Kube

## Usage

- https://kubernetes.io/docs/tutorials/kubernetes-basics

**Start**
```
minikube delete && minikube start
minikube dashboard (in other terminal) 
(kubectl config get-contexts)

kubectl create deployment hello-node --image=registry.k8s.io/e2e-test-images/agnhost:2.39 -- /agnhost netexec --http-port=8080
kubectl get deploy,pods,events -n kube-system
```

**Setup**
```
kubectl create deployment hello-minikube --image=kicbase/echo-server:1.0
kubectl expose deployment hello-minikube --type=NodePort --port=8080     (or --type=LoadBalancer)

kubectl get services hello-minikube
(kubectl get deploy,pods,events -n kube-system)
```

**Use service (provide IP)**
**Make the node Container accessible from outside**
```
minikube service hello-minikube
kubectl get services     (kubectl get svc)
(kubectl describe services hello-minikube)
(kubectl get pods -A)
(kubectl get pods -l "app=hello-minikube")
```

**Run**
```
kubectl port-forward service/hello-minikube 7080:8080
http://localhost:7080
```

**Setup**
```
kubectl config view
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

- Node: Physical/VM server (resources: processor, memory...)
    - Pod1: Logical isolation (e.g. client 1)
        - Container App
        - Container Database
        - ...
    - Pod2: Logical isolation (e.g. client 2)
        - Container App
        - Container Database
        - ...

**Refs** 
---
- https://kubernetestraining.io
- https://labs.play-with-k8s.com
- https://blent.ai/blog/a/tutoriel-kubernetes-introduction
- https://github.com/rslim087a/kong-api-gateway-kubernetes-tutorial  

Port forward:
- https://kubernetes.io/docs/tasks/access-application-cluster/port-forward-access-application-cluster