# Kube adv

**Addons**
```
minikube addons list
minikube addons enable metrics-server
```

**Replicas**
```
kubectl scale deploy/hello-node --replicas=4
kubectl get deploy
kubectl get pods -o wide   (see all replicas)
```

**ConfigMap**
```
(https://kubernetes.io/docs/tutorials/configuration/updating-configuration-via-a-configmap)

kubectl create configmap sport --from-literal=sport=football
(use tuto/deployment-with-configmap-as-volume.yaml)
```