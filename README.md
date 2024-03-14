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

[![Interview Video](https://i.imgur.com/skvRlkM.png)](https://screenrec.com/share/6TczmZr8LJ)

### Api Collection

[![All Interview Collection](https://imgs.search.brave.com/3X2XpM3Wxt9t5cLIbec15aCXBLMxijo3a_TTbVVWgDM/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9hc3Nl/dHMuc3RpY2twbmcu/Y29tL3RodW1icy82/MmNjMWI2YjE1MGQ1/ZGU5YTNkYWQ1Zjku/cG5n)](https://www.postman.com/wladiveras/workspace/portal/collection/10368732-51ac5b2b-6d78-47e8-8f74-fbd99df65013?action=share&creator=10368732&active-environment=10368732-8517dacc-80ac-45ae-b0fa-c7ecb4c1f772)
