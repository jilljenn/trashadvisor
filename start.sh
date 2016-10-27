docker-machine start trashadvisor
eval "$(docker-machine env trashadvisor)"
export URL='http://'$(docker-machine ip trashadvisor)
python -mwebbrowser $URL
docker-compose up
