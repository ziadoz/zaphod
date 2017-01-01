# Arthur
A web development environment built with Docker.

## Todos
- Install Nginx (PPA), PHP7-FPM (PPA), MySQL 5.7 (PPA) or PostgreSQL, Redis, Elixir, Node JS and Phantom JS.
- Revise virtual host Ruby script: https://gist.github.com/ziadoz/63efdb096123ec88271f
- Use Docker containers when on a supported machine. Look at Ansible Containers.
- Install XDebug and allow it to be toggled on and off.

## Commands
```
docker-compose up
docker-compose up -d
docker-compose up --build
docker-compose down
docker ps
docker images
docker rmi <hash|tag>
docker rmi -f <hash|tag>
docker-machine ls
docker exec -it <container> bash
```

## Links
- http://geekyplatypus.com/dockerise-your-php-application-with-nginx-and-php7-fpm/
- https://wouterdeschuyter.be/blog/quick-guide-setting-up-php-71-nginx-110-mysql-57-with-docker-1327640418
- https://sentinelstand.com/article/composer-install-in-dockerfile-without-breaking-cache
- https://shippingdocker.com/blog/what-is-docker/
- https://shippingdocker.com/docker-in-development/
- https://shippingdocker.com/dockerized-app/
- https://tech.napsty.com/2016/06/using-ansible-to-build-and-orchestrate-clean-docker-images.html
