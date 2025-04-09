# Kong API Gateway Kubernetes Tutorial

## Part 1: Basic Setup (Without Kong)

### 1. Apply the starter manifests:
```bash
kubectl apply -f starter-manifests.yaml
```

### 2. Test the API (Basic Setup):
```bash
# Add grades
curl -X POST http://localhost:3000/grades \
  -H "Content-Type: application/json" \
  -d '{"name": "Harry", "subject": "Defense Against Dark Arts", "score": 95}'

curl -X POST http://localhost:3000/grades \
  -H "Content-Type: application/json" \
  -d '{"name": "Ron", "subject": "Charms", "score": 82}'

curl -X POST http://localhost:3000/grades \
  -H "Content-Type: application/json" \
  -d '{"name": "Hermione", "subject": "Potions", "score": 98}'

# Get all grades
curl http://localhost:3000/grades
```


### Test API with Kong Security:
```bash
# Replace <node-port> with Kong proxy port and your-secret-key with the key from kong-secret.yaml

curl -X POST http://localhost:<port>/grades \
  -H "apikey: your-secret-key" \
  -H "Content-Type: application/json" \
  -d '{"name": "Harry", "subject": "Defense Against Dark Arts", "score": 95}'

curl http://localhost:<port>/grades -H "apikey: your-secret-key"
```
