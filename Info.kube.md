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
kubectl expose deployment hello-minikube --type=NodePort --port=8080

kubectl get deploy,events -n kube-system
```

**Make the node Container accessible from outside: Proxy or service**  

**Proxy**
Pods are running in an isolated, private network. Proxy access to them
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

- A Node may be a virtual or physical machine, depending on the cluster.
- A Pod is a group of one or more Containers, include shared storage and IP address
- A ReplicaSet's purpose is to maintain a stable set of replica Pods running at any given time

- Labels are key/value pairs that are attached to objects such as Pods.
    - Equality-based: =,==,!=
    - Set-based: environment in (production, qa), tier notin (frontend, backend), partition, !partition
- A Service is an abstraction which defines a logical set of Pods and how to access them
    - ClusterIP (default) - Exposes the Service on an internal IP in the cluster (only reachable from within the cluster)
    - NodePort - Exposes the Service on the same port of each selected Node in the cluster using NAT.
    - LoadBalancer - Creates an external load balancer in the current cloud with a fixed, external IP
    - ExternalName - Maps the Service to the contents of the externalName field (e.g. foo.bar.example.com)

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

- kubectl <action> <resource>
- kubectl create/describe/delete/exec/get/logs node/deployment/service

```
kubectl config get-contexts
kubectl exec -ti $POD_NAME -- bash
kubectl get deploy,events,pods -n kube-system
kubectl get nodes 
kubectl get pods -A -l "app=hello-minikube,role=replica" -L app
kubectl get svc  (services)

# Labels and update
kubectl get nodes,pods --show-labels
kubectl get pods -l environment=production,tier=frontend
kubectl get pods -l 'environment in (production, qa),tier in (frontend),tier notin (backend)'
kubectl label pod -l app=nginx tier=fe

# Sample
kubectl create deployment hello-node --image=registry.k8s.io/e2e-test-images/agnhost:2.39 -- /agnhost netexec --http-port=8080
```

**Refs** 
---
Ref:
- https://kubernetes.io/docs/reference/kubectl/quick-reference

Tutorials
- https://kubernetestraining.io
- https://labs.play-with-k8s.com
- https://blent.ai/blog/a/tutoriel-kubernetes-introduction
- https://github.com/rslim087a/kong-api-gateway-kubernetes-tutorial  

Port forward:
- https://kubernetes.io/docs/tasks/access-application-cluster/port-forward-access-application-cluster