docker-machine start trashadvisor
eval "$(docker-machine env trashadvisor)"
docker-compose run -e DJANGO_SETTINGS_MODULE=trashadvisor.settings -w /src web bash
