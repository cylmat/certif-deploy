Tuto

Kube
```
kubectl apply -f tuto/kong-key-kube
kubectl get ns
kubectl get -n grade-demo deploy,svc

kubectl port-forward -n grade-demo svc/grade-submission-api 3000:3000

curl -X POST http://localhost:3000/grades -d '{"name": "Harry", "subject": "Defense Against Dark Arts", "score": 95}'
curl -X GET http://localhost:3000/grades
```

Kong
```
# use https://charts.konghq.com
helm search repo kong
helm repo add kong https://charts.konghq.com
helm repo update && helm repo list

# On install, remove proxy load balancer
helm install kong kong/kong -n kong --create-namespace --version 2.48.0 --set proxy.type=NodePort
kubectl -n kong get pods,svc 

# guide: https://docs.konghq.com/kubernetes-ingress-controller/latest/guides/getting-started/
HOST=$(kubectl get nodes --namespace kong -o jsonpath='{.items[0].status.addresses[0].address}')
PORT=$(kubectl get svc --namespace kong kong-kong-proxy -o jsonpath='{.spec.ports[0].nodePort}')
export PROXY_IP=${HOST}:${PORT}
echo "PROXY_IP: ${PROXY_IP}"
curl "$PROXY_IP"

# set .admin.enabled and .admin.http.enabled or .admin.tls.enabled true
```

**Ref**  
- https://github.com/rslim087a/kong-api-gateway-kubernetes-tutorial  
- https://kubernetestraining.io

Kong
- https://github.com/Kong/charts/tree/main/charts/kong

Tuto:
- Kong: https://www.youtube.com/watch?v=rTcj7znJVZc
- Keycloak: https://www.youtube.com/watch?v=-DQCiaOSlqs