# Wladi Veras: Interview

A simple project but a big idea.

## Steps to Interview Project

1. Install [Docker](https://docs.docker.com/engine/install/) and [Docker Compose](https://docs.docker.com/compose/) if you haven't already.

2. Open a terminal and navigate to the directory where `docker-compose.yml` file is located, ins this case, in root dir.

3. Run the following command to start the containers:

    ```bash
     docker-compose up -d
    ```

    This command will build the necessary images and start the containers in the background.

4. Open your browser and go to [localhost:8000](http://localhost:8000) to use the project.

5. If you want to remove the containers, networks, and volumes as well as the images, use the following command:

    ```bash
    docker-compose down --volumes --rmi all
    ```

    This command will remove everything created by `docker-compose`.
