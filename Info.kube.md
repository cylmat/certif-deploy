# Kube

https://kubernetes.io/docs/tutorials/kubernetes-basics

## Start
```
minikube delete && minikube start
minikube dashboard

kubectl create deployment hello-node --image=registry.k8s.io/e2e-test-images/agnhost:2.39 -- /agnhost netexec --http-port=8080
kubectl get deploy,pods,events -n kube-system
```

## Make the node Container accessible from outside with service
```
kubectl expose deployment hello-node --type=LoadBalancer --port=8080
kubectl get services (k get svc)
```
Access http://127.0.0.1:<port>

## Setup
```
kubectl config view
minikube addons list
minikube addons enable metrics-server
```

## Clean
```
kubectl delete service hello-node
kubectl delete deployment hello-node
minikube stop (minikube delete)
```

**Infos**  
---
- A Pod is a group of one or more Containers.